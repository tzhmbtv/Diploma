<?php

namespace App\Services;

use GuzzleHttp\Client;

class Recognition
{
    private Client $client;
    private string $image;
    private array  $header;
    private string $response;

    public function __construct()
    {
        $this->client = new Client(
            ['base_uri' => getenv('RECOGNIZER_HOST').":".getenv("RECOGNIZER_PORT")]
        );
        $this->setHeader();
    }

    public function setImage(string $image)
    {
        $this->image = $image;
    }

    private function setHeader()
    {
        $this->header = ['x-api-key' => getenv('RECOGNIZER_KEY')];
    }

    /**
     * @return array
     */
    public function getNumber()
    {
        $result = $this->client->request(
            "POST",
            'recognition',
            ['body' => $this->image, 'headers' => $this->header])
            ->getBody()->getContents();

        $this->response = $result;

        return json_decode($result, true);
    }

    /**
     * @return string
     */
    public function getResponse()
    {
        return $this->response;
    }
}
