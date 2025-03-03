<?php
require_once('api/AgentApiClient.php');

$action = $_GET['action'] ?? '';

$agentApi = new AgentApiClient(getenv('SPACETRADERS_API_URL'), [
    'Content-Type: application/json',
    'Authorization: Bearer ' . getenv('SPACETRADERS_ACCESS_TOKEN')
]);

if ($action == 'register' || isset($_GET['error'])) {
    $factionsOptions = '';
    // Gets the factions
    try {
        $factionsRes = $agentApi->getFactions();

        if ($factionsRes['status'] == 'error') {
            echo getAlert('alert-danger', $factionsRes['message']);
        } else {
            $factions = $factionsRes['data'];
            for ($i = 0; $i < count($factions); $i++) {
                $factionsOptions .= '<option value="' . $factions[$i]['symbol'] . '">' . $factions[$i]['name'] . '</option>';
            }
        }
    } catch (Exception $e) {
        throw new Exception($e->getMessage());
    }
}

// Handle form submission
if (isset($_POST['action']) ? $_POST['action'] == 'register_agent' : false) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $symbol = $_POST['symbol'] ?? '';
        $faction = $_POST['faction'] ?? '';

        if (!empty($symbol) && !empty($faction)) {
            $newAgent = ['symbol' => $symbol, 'faction' => $faction];
            $response = $agentApi->createNewAgent($newAgent);

            if ($response['status'] == 'success') {
                $_SESSION['AGENT_TOKEN'] = $response['data']['token'];
                header('Location: ?page=cockpit');
            } else {
                echo getAlert('alert-danger', $response['message']);
                header('Location: ?page=agent&error=1');
            }
        } else {
            echo getAlert('alert-danger', 'Agent Name and Faction should not be empty!');
        }
    }
}

if ($action == 'load_agent_data' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $agentToken = trim($_GET['agent_token']) ?? '';
    if (!empty($agentToken)) {
        $response = $agentApi->getAgent($agentToken);

        if ($response['status'] == 'error') {
            echo getAlert('alert-danger', 'Token is not valid!');
        } elseif ($response['status'] == 'success' && !empty($response['data']['accountId'])) {
            $_SESSION['AGENT_TOKEN'] = $agentToken;
        }
    } else {
        echo getAlert('alert-danger', 'Token is not valid!');
    }
}

// Loads the View
switch ($action) {
    case 'load_agent_data':
    case 'load':
        if (isset($_SESSION['AGENT_TOKEN'])) {
            header('Location: ?page=cockpit');
        } else {
            require_once 'views/agent/LoadAgentView.php';
        }
        break;
    case 'register_agent':
    case 'register':
        require_once 'views/agent/RegisterAgentView.php';
        break;
    default:
        require_once 'views/agent/RegisterAgentView.php';
        break;
}
