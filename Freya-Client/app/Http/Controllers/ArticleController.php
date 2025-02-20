<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends Controller
{
    public function index()
    {
        try {
            $response = Http::freyarest()->get('articles'); 
    
                    // Decode the JSON response
        // $articles = $response->json();

            if ($response->status() != Response::HTTP_OK) {
                return view('404');
            }

           
            // Pass the articles to the view
        return view('articles.index', compact('articles'));
         //visszaalakítja a jsont modellekké
            // return view('plants.index', ['articles' => collect($response->json())]);

        } catch (\Exception $e) {
            // \Log::error('Error fetching articles: ' . $e->getMessage());
            return view('error', ['message' => 'Unable to fetch plants. Please try again later.']);
        }
    }
}