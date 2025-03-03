<?php
require_once "core/ApiClient.php";

class AgentApiClient extends ApiClient
{
    // Gets all the Fractions
    public function getFactions(): array
    {
        return $this->get("factions");
    }

    public function createNewAgent(array $data): array
    {
        return $this->post("register", $data);
    }

    public function getAgent(string $agentToken = ''): array
    {
        if (!empty($agentToken)) {
            // Change header auth to agent token
            $headers = $this->getHeader();
            $index = array_search('Authorization: Bearer', $headers);

            if ($index !== false) {
                unset($headers[$index]);
            }

            $headers[] = 'Authorization: Bearer ' . $agentToken;
            $this->setHeader($headers);
        }

        return $this->get('my/agent');
    }

    public function getStartingLocation(string $systemSymbol, string $waypointSymbol): array
    {
        return $this->get("systems/$systemSymbol/waypoints/$waypointSymbol");
    }

    public function getContracts(): array
    {
        return $this->get('my/contracts');
    }

    public function acceptContract(string $contractId): array
    {
        return $this->post("my/contracts/$contractId/accept", []);
    }

    public function getShips(): array
    {
        return $this->get('my/ships');
    }
}
