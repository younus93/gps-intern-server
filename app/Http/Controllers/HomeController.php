<?php

namespace App\Http\Controllers;

use App\GPSTable;
use GuzzleHttp\Client;

class HomeController extends Controller
{

    public function store()
    {
        $row = GPSTable::inRandomOrder()->first();
        $client = new Client();
        $url = request()->get('url');
        $response = $client->post("https://interns.truckjee.com", [
            'json' => $row->toArray(),
        ]);
        return response([
            'id' => $row->id,
        ]);
    }

}
