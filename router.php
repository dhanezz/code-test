<?php
require_once 'api/AgentApiClient.php';

//starting session
session_start();

$action = $_GET['logout'] ?? '';

if ($action == 'logout') {
    unset($_SESSION['AGENT_TOKEN']);
}

$isAgentRegistered = isset($_SESSION["AGENT_TOKEN"]);
if ($isAgentRegistered) {
    $agentApi = new AgentApiClient(getenv('SPACETRADERS_API_URL'), [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $_SESSION['AGENT_TOKEN']
    ]);

    try {
        $response = $agentApi->getAgent();
        if ($response['status'] == 'error' && $response['code'] == 401) {
            // Because of the server reset, I have to check if the dates still matches or else the token won't work anymore
            if ($response['data']['actual'] != date('Y-m-d')) {
                echo getAlert('alert-warning', 'Session expired!');
                unset($_SESSION['AGENT_TOKEN']);
            }
        }
    } catch (Exception $e) {
        throw new Exception($e->getMessage(), $e->getCode());
    }
}

$page = $_GET['page'] ?? (!$isAgentRegistered ? 'home' : 'cockpit');

switch ($page) {
    case 'home':
        require_once 'controllers/HomeController.php';
        break;
    case 'agent':
        require_once 'controllers/AgentController.php';
        break;
    case 'cockpit':
        require_once 'controllers/CockpitController.php';
        break;
    default:
        echo 'Page not found!';
        exit;
}
