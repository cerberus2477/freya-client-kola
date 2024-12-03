<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlantController extends Controller
{
    //példa kólától
    public function index()
    {
        $response = Http::postoffice()->get('counties');
        if ($response->status() != Response::HTTP_OK) {
            return view('404');
        }
        $entities = $this->getEntitiesFromResponse($response);
        return view('plants/list', ['entities' => $entities]);
    }


}