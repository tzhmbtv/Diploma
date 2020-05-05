<?php

namespace App\Services;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Support\Facades\Log;

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
        try {
            $result = $this->client->request(
                "POST",
                'recognition',
                ['body' => $this->image, 'headers' => $this->header])
                ->getBody()->getContents();

            $this->response = $result;

            return json_decode($result, true);
        } catch (ConnectException $exception) {
            Log::error($exception->getMessage(), $exception->getTrace());

            return ['Cannot connect'];
        }
    }

    /**
     * @return string
     */
    public function getResponse()
    {
        return $this->response;
    }
}