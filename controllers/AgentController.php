<?php
require_once("api/AgentApiClient.php");

$agentApi = new AgentApiClient(getenv("SPACETRADERS_API_URL"), [
    "Content-Type: application/json",
    "Authorization: Bearer " . getenv("SPACETRADERS_ACCESS_TOKEN")
]);

// Gets the fractions
$factions = $agentApi->getFactions();
$factionsOptions = "";

for ($i = 0; $i < count($factions); $i++) {
    $factionsOptions .= '<option value="' . $factions[$i]["symbol"] . '">' . $factions[$i]["name"] . '</option>';
}

#Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $symbol = $_POST["symbol"] ?? '';
    $faction = $_POST["faction"] ?? '';

    if (!empty($symbol) && !empty($faction)) {
        $newAgent = ["symbol" => $symbol, "faction" => $faction];
        $response = $agentApi->createNewAgent($newAgent);
        if ($response['data']['token']) {
            $_SESSION["AGENT_TOKEN"] = $response['data']['token'];
            // Redirect after submission to prevent resubmission on refresh
            header("Location: ?page=agent&success=1");
        } else {
            header("Location: ?page=agent&success=0");
        }
    }
}

// Loads the View
require_once "views/AgentView.php";
