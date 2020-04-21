<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request as RequestAlias;
use Illuminate\Http\Request;

class Recognizer extends Controller
{

    public function recognizeAction(Request $request)
    {
        $image = $request->file('image')->get();

        return $this->sendRequest($image);
    }

    private function sendRequest($image)
    {
        $client = new Client(['base_uri' => getenv('RECOGNIZER_HOST').":".getenv("RECOGNIZER_PORT")]);
        $header = ['x-api-key' => getenv('RECOGNIZER_KEY')];
        $result = $client->request(
            "POST",
            'recognition',
            ['body' => $image, 'headers' => $header])
            ->getBody()->getContents();

        return json_decode($result, true);
    }

    private function sendRequestAsync($image)
    {
        $client   = new Client(['base_uri' => getenv('RECOGNIZER_HOST').":".getenv("RECOGNIZER_PORT")]);
        $requests = [];
        $header = ['x-api-key' => getenv('RECOGNIZER_KEY')];

        for ($i = 0; $i < 3; $i++) {
            $requests[] = new RequestAlias("POST",
                "/recognition",
                $header,
                $image);
        }
        $pool = new Pool($client, $requests, []);
        foreach ($pool->batch($client, $requests, []) as $item)
        {
            var_dump($item->getBody()->getContents());
        }
        die;
    }
}
