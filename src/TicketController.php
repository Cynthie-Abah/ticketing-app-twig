<?php
namespace App;
require_once 'src/SupabaseClient.php';

class TicketController {
  private $db;
  public function __construct() {
    $this->db = new SupabaseClient();
  }

  public function index($twig) {
    $tickets = $this->db->getTickets();
    echo $twig->render('tickets.twig', ['tickets' => $tickets]);
  }

  public function create($twig) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $this->db->createTicket([
        'title' => $_POST['title'],
        'description' => $_POST['description'],
        'status' => 'open'
      ]);
      header('Location: /');
    } else {
      echo $twig->render('new_ticket.twig');
    }
  }

  public function edit($twig, $id) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $this->db->updateTicket($id, [
        'title' => $_POST['title'],
        'description' => $_POST['description'],
        'status' => $_POST['status']
      ]);
      header('Location: /');
    } else {
      // Fetch current ticket for editing
    }
  }

  public function delete($id) {
    $this->db->deleteTicket($id);
    header('Location: /');
  }
}
