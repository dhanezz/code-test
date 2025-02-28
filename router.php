<?php
//starting session
session_start();

$page = $_GET['page'] ?? 'agent';

switch ($page) {
    case 'agent':
        require_once 'controllers/AgentController.php';
        break;
    default:
        echo 'Page not found!';
        exit;
}
