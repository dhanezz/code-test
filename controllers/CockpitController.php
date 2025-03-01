<?php
require_once 'api/AgentApiClient.php';
require_once 'models/Agent.php';


if (!isset($_SESSION['AGENT_TOKEN'])) {
    header('Location: ?page=home&auth_error=1');

    echo getAlert('alert-danger', 'No Agent registered');
}

$agentApi = new AgentApiClient(getenv('SPACETRADERS_API_URL'), [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $_SESSION['AGENT_TOKEN']
]);

//$agentData = $agentApi->getAgent();

//$agent = new Agent($agentData);

//$startingLocation = $agentApi->getStartingLocation($agent->getSystemSymbol(), $agent->getWaypointSystem());

if (!empty($startingLocation)) {
    //TODO: show starting location and other orbits in map.
}
require_once 'views/cockpit/CockpitView.php';
