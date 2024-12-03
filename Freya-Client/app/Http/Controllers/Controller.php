<?php

namespace App\Http\Controllers;

abstract class Controller
{
    //a httprequest jsonban adja vissza az eredményt, ezt nekünk tömbbé kell alakítanunk
    // private function getEntitiesFromResponse($response): array
    // {
    //     $body = $response->body();
    //     $data = json_decode($body);
    //     return $data->data;
    // }

    // lehet helyette helyben használni a ->json()-t
}
