<?php
require_once __DIR__ . '/vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates');
$twig = new \Twig\Environment($loader);

$data = [
  'title' => 'Ticket Dashboard',
  'tickets' => [
    ['title' => 'Login Issue', 'status' => 'Open'],
    ['title' => 'Payment Bug', 'status' => 'Closed']
  ]
];

echo $twig->render('index.html.twig', $data);
