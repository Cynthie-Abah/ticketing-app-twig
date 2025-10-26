<?php
require_once __DIR__ . '/vendor/autoload.php';

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

// Initialize Twig
$loader = new FilesystemLoader(__DIR__ . '/template');
$twig = new Environment($loader);

// Simple router
$page = $_GET['page'] ?? 'landingPage';

$validPages = ['landingPage', 'tickets', 'contact', 'dashboard'];
$template = in_array($page, $validPages) ? "pages/{$page}.twig" : "pages/landingPage.twig";

switch ($page) {
    case 'dashboard':
        echo $twig->render('pages/dashboard.twig', [
            'title' => 'Dashboard',
            'loading' => false,
            'totalTickets' => 42,
            'openTickets' => 10,
            'inProgressTickets' => 5,
            'closedTickets' => 27,
            'recentTickets' => [
                ['title' => 'API Error', 'status' => 'open', 'created_at' => '2025-10-26'],
                ['title' => 'UI Bug Fix', 'status' => 'in_progress', 'created_at' => '2025-10-25'],
                ['title' => 'Email issue', 'status' => 'closed', 'created_at' => '2025-10-23']
            ]
        ]);
        exit; // ⬅ Stop here after rendering dashboard

    default:
        echo $twig->render('pages/landingPage.twig', ['title' => 'Home']);
        exit; // ⬅ Stop here after rendering landing page
}
