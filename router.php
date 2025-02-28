<?php
//starting session
session_start();
//TODO: Wenn Agent Token gesetzt wuzde dann cockpit starten

$isAgentRegistered = isset($_SESSION["AGENT_TOKEN"]);

$page = $_GET['page'] ?? (!$isAgentRegistered ? 'home' : 'cockpit');

switch ($page) {
    case 'home':
        require_once 'controllers/HomeController.php';
        break;
    case 'agent':
        require_once 'controllers/AgentController.php';
        break;
    case 'cockpit':
        // require_once 'controllers/CockpitController.php';
        // break;
    default:
        echo 'Page not found!';
        exit;
}
