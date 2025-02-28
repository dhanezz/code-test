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

        return $this->get("my/agent")["data"] ?? [];
    }
}
