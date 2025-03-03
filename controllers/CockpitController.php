<?php
require_once 'api/AgentApiClient.php';
require_once 'models/Agent.php';
require_once 'models/Contract.php';

$action = $_GET['action'] ?? isset($_POST['action']) ? $_POST['action'] : '';

if (!isset($_SESSION['AGENT_TOKEN'])) {
    header('Location: ?page=home&auth_error=1');

    echo getAlert('alert-danger', 'No Agent registered');
}

$agentApi = new AgentApiClient(getenv('SPACETRADERS_API_URL'), [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $_SESSION['AGENT_TOKEN']
]);

$agent = null;

try {
    $agentRes = $agentApi->getAgent();

    if ($agentRes['status'] == 'success') {
        $agent = new Agent($agentRes['data']);
    } else {
        echo getAlert('alert-danger', $agentRes['message']);
    }
} catch (Exception $e) {
    throw new Exception($e->getMessage());
}

if ($action == "accept_contract") {
    try {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contract_id'])) {
            $contactAcceptRes = $agentApi->acceptContract($_POST['contract_id']);

            if ($contactAcceptRes['status'] == 'success') {
                echo getAlert('alert-warning', "Contract accepted.");
            } else {
                echo getAlert('alert-danger', $contactAcceptRes['message']);
            }
        }
    } catch (Exception $e) {
        throw new Exception("Contract Accept Error: {$e->getMessage()}");
    }
}


try {
    if ($agent !== null) {
        $startingLocationRes = $agentApi->getStartingLocation($agent->getSystemSymbol(), $agent->getWaypointSystem());

        if ($startingLocationRes['status'] == 'success') {
            $startingLocationSymbol = $startingLocationRes['data']['symbol'];
            //TODO: use Data of startingLocation to show a cool ui
            //TODO: Traits might be important later, even without UI, so make a way to show it
        } else {
            echo getAlert('alert-danger', $startingLocationRes['message']);
        }
    }
} catch (Exception $e) {
    throw new Exception($e->getMessage());
}

if ($agent !== null) {
    $contractRes = $agentApi->getContracts();

    if ($contractRes['status'] == 'success') {
        $agentContracts = [];

        foreach ($contractRes['data'] as $contract) {
            $contract = new Contract($contract);
            $agentContracts[] = $contract;
        }

        $agent->setContracts($agentContracts);
    }
}

$contractsHTML = '';

if ($agent->getContracts() != null) {
    for ($i = 0; $i < count($agent->getContracts()); $i++) {
        $contract = $agent->getContracts()[$i];
        $contractsHTML = $contract->renderContractHTML($i + 1);
    }
}

require_once 'views/cockpit/CockpitView.php';
