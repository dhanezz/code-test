<?php
require_once("api/AgentApiClient.php");

$agentApi = new AgentApiClient(getenv("SPACETRADERS_API_URL"), [
    "Content-Type: application/json",
    "Authorization: Bearer " . getenv("SPACETRADERS_API_TOKEN")
]);

// Gets the fractions
$factions = $agentApi->getFractions();
$factionsOptions = "";

for ($i = 0; $i < count($factions); $i++) {
    $factionsOptions .= '<option>' . $factions[$i]["name"] . '</option>';
}

#Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $symbol = $_POST["symbol"] ?? '';
    $factionsOptions = $_POST["faction"] ?? '';

    if (!empty($symbol) && !empty($factionsOptions)) {
        $newAgent = ["symbol" => $symbol, "faction" => $factionsOptions];
        $agentApi->createNewAgent($newAgent);
    }
}

// Loads the View
require_once "views/AgentView.php";
