<?php
require_once('api/AgentApiClient.php');

$action = $_GET['form_action'] ?? '';

$agentApi = new AgentApiClient(getenv('SPACETRADERS_API_URL'), [
    'Content-Type: application/json',
    'Authorization: Bearer ' . getenv('SPACETRADERS_ACCESS_TOKEN')
]);

// Gets the fractions
$factions = $agentApi->getFactions();
$factionsOptions = '';

for ($i = 0; $i < count($factions); $i++) {
    $factionsOptions .= '<option value="' . $factions[$i]['symbol'] . '">' . $factions[$i]['name'] . '</option>';
}

// Handle form submission

if ($action == 'register_agent') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $symbol = $_POST['symbol'] ?? '';
        $faction = $_POST['faction'] ?? '';

        if (!empty($symbol) && !empty($faction)) {
            $newAgent = ['symbol' => $symbol, 'faction' => $faction];
            $response = $agentApi->createNewAgent($newAgent);
            if ($response['data']['token']) {
                $_SESSION['AGENT_TOKEN'] = $response['data']['token'];

                header('Location: ?page=cockpit');
            } else {
                header('Location: ?page=agent&success=0');
            }
        }
    }
}

if ($action == 'load_agent_data' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $agentToken = trim($_GET['agent_token']) ?? '';

    if (!empty($agentToken)) {
        $response = $agentApi->getAgent($agentToken);

        if (!empty($response['accountId'])) {
            $_SESSION['AGENT_TOKEN'] = $agentToken;
        }
    } else {
        // TODO: add error handling
    }
}

// Loads the View
switch ($action) {
    case 'load_agent_data':
        if (isset($_SESSION['AGENT_TOKEN'])) {
            header('Location: ?page=cockpit');
        } else {
            require_once 'views/agent/LoadAgentView.php';
        }
    case 'register_agent':
        require_once 'views/agent/RegisterAgentView.php';
    default:
        require_once 'views/agent/RegisterAgentView.php';
        break;
}
