<?php

class ApiClient
{
    private $baseUrl;
    private $header;

    public function __construct(string $baseUrl, array $header = [])
    {
        $this->baseUrl = rtrim($baseUrl, '/');
        $this->header = $header;
    }

    // Send a GET request
    public function get(string $endpoint): array
    {
        $url = $this->baseUrl . '/' . ltrim($endpoint, '/');
        $options = [
            'http' => [
                'header' => $this->formatHeaders($this->header),
                'method' => 'GET',
                'ignore_errors' => true,
            ]
        ];

        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);
        $headers = get_headers($url, true);

        return $this->handleResponse($response, $headers);
    }

    // Send a POST request
    public function post(string $endpoint, array $data): array
    {
        $url = $this->baseUrl . '/' . ltrim($endpoint, '/');
        $options = [
            'http' => [
                'header' => $this->formatHeaders($this->header),
                'method' => 'POST',
                'content' => json_encode($data),
                'ignore_errors' => true
            ]
        ];

        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);

        if ($response === false) {
            throw new Exception('Error communicating with the API.');
        }

        return $this->handleResponse($response);
    }

    private function handleResponse(string $response, array $headers = []): array
    {
        $res = json_decode($response, true);
        $sessionValid = true;

        if (isset($headers['X-Ratelimit-Reset'])) {
            $ratelimitReset = new DateTime($headers['X-Ratelimit-Reset']);
            if (new DateTime('now') > $ratelimitReset) {
                $sessionValid = false;
            }
        }

        if ($sessionValid === false) {
            $res = [
                'status' => 'error',
                'message' => 'Session is expired.',
                'code' => 401
            ];
        } else {
            if (isset($res['error'])) {

                $res = array_merge(['status' => 'error'], $res['error']);
            } else {
                $res = array_merge(['status' => 'success'], $res);
            }
        }

        return $res;
    }

    private function formatHeaders(array $headers)
    {
        return implode("\r\n", $headers);
    }

    // GETTERS AND SETTERS
    public function getHeader(): array
    {
        return $this->header;
    }

    public function setHeader(array $headers): void
    {
        $this->header = $headers;
    }
}
