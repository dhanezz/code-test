<?php

class ApiClient
{
    private string $baseUrl;
    private array $header;

    function __construct(string $baseUrl, array $header)
    {
        $this->baseUrl = rtrim($baseUrl, '/');
        $this->header = $header;
    }

    // Send a GET request
    public function get(string $endpoint): array
    {
        $url = $this->baseUrl . '/' . ltrim($endpoint, '/');
        $response = file_get_contents($url);

        return $this->handleResponse($response);
    }

    // Send a POST request
    public function post(string $endpoint, array $data): array
    {
        $url = $this->baseUrl . '/' . ltrim($endpoint, '/');
        $options = [
            'http' => [
                'header' => $this->formatHeaders($this->header),
                'method' => 'POST',
                'content' => json_encode($data)
            ]
        ];

        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);

        if ($response === false) {
            throw new Exception('Error communicating with the API.');
        }

        return $this->handleResponse($response);
    }

    private function handleResponse(string $response)
    {
        return json_decode($response, true);
    }

    private function formatHeaders(array $headers)
    {
        return implode("\r\n", $headers);
    }
}
