<?php
namespace App;

use GuzzleHttp\Client;

class SupabaseClient {
  private $client;
  private $url;
  private $key;

  public function __construct() {
    $this->url = $_ENV['SUPABASE_URL'];
    $this->key = $_ENV['SUPABASE_KEY'];
    $this->client = new Client([
      'base_uri' => $this->url . '/rest/v1/',
      'headers' => [
        'apikey' => $this->key,
        'Authorization' => 'Bearer ' . $this->key,
        'Content-Type' => 'application/json'
      ]
    ]);
  }

  public function getTickets() {
    $res = $this->client->get('tickets');
    return json_decode($res->getBody(), true);
  }

  public function createTicket($data) {
    $this->client->post('tickets', ['json' => $data]);
  }

  public function updateTicket($id, $data) {
    $this->client->patch("tickets?id=eq.$id", ['json' => $data]);
  }

  public function deleteTicket($id) {
    $this->client->delete("tickets?id=eq.$id");
  }
}

$client = new Client([
  'base_uri' => $_ENV['SUPABASE_URL'] . '/auth/v1/',
  'headers' => ['apikey' => $_ENV['SUPABASE_KEY'], 'Content-Type' => 'application/json']
]);

$response = $client->post('signup', [
  'json' => ['email' => $email, 'password' => $password]
]);

$response = $client->post('token?grant_type=password', [
  'json' => ['email' => $email, 'password' => $password]
]);
$data = json_decode($response->getBody(), true);
$_SESSION['user'] = $data; // store token for later requests
