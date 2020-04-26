<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request as RequestAlias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Recognizer extends Controller
{

    public function recognizeAction(Request $request)
    {
        $image = $this->getImage();

        return $this->sendRequest($image);
    }

    private function sendRequest($image)
    {
        try {
            $client = new Client(['base_uri' => getenv('RECOGNIZER_HOST').":".getenv("RECOGNIZER_PORT")]);
            $header = ['x-api-key' => getenv('RECOGNIZER_KEY')];
            $result = $client->request(
                "POST",
                'recognition',
                ['body' => $image, 'headers' => $header])
                ->getBody()->getContents();

            return json_decode($result, true);
        } catch (ConnectException $exception) {
            Log::error($exception->getMessage(), $exception->getTrace());

            return ['Cannot connect'];
        }


    }

    private function sendRequestAsync($image)
    {
        $client   = new Client(['base_uri' => getenv('RECOGNIZER_HOST').":".getenv("RECOGNIZER_PORT")]);
        $requests = [];
        $header   = ['x-api-key' => getenv('RECOGNIZER_KEY')];

        for ($i = 0; $i < 3; $i++) {
            $requests[] = new RequestAlias("POST",
                "/recognition",
                $header,
                $image);
        }
        $pool = new Pool($client, $requests, []);
        foreach ($pool->batch($client, $requests, []) as $item) {
            var_dump($item->getBody()->getContents());
        }
        die;
    }

    /**
     * @return string
     */
    private function getImage()
    {
        return file_get_contents(getenv("CAMERA_HOST").getenv('CAMERA_PHOTO'));
    }
}
