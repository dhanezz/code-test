<?php
require_once "core/ApiClient.php";

class AgentApiClient extends ApiClient
{
    // Gets all the Fractions
    public function getFactions(): array
    {
        return $this->get("factions")["data"];
    }

    public function createNewAgent(array $data): array
    {
        return $this->post("register", $data);
    }
}
