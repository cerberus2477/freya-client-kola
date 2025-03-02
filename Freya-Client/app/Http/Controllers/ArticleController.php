<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        // try {
        //     $response = Http::freyarest()->get('articles'); 
    
        //             // Decode the JSON response
        //     // $articles = $response->json();

        //     if ($response->status() != Response::HTTP_OK) {
        //         return view('404');
        //     }

           
        //     // Pass the articles to the view
        //     return view('articles.index', compact('articles'));
        //     //visszaalakítja a jsont modellekké
        //     // return view('plants.index', ['articles' => collect($response->json())]);

        // } catch (\Exception $e) {
        //     // \Log::error('Error fetching articles: ' . $e->getMessage());
        //     return view('error', ['message' => 'Unable to fetch articles. Please try again later.']);
        // }
        return view('articles.index');
    }

    
    public function filter(Request $request)
    {
        $queryParams = [
            'q' => $request->input('q'),
            'after' => $request->input('after'),
            'before' => $request->input('before'),
            'typeofplant' => $request->input('typeofplant'),
            'plant' => $request->input('plant'),
            'category' => $request->input('category'),
            'pageSize' => $request->input('pageSize'),
        ];
    
        // Remove empty values
        $queryParams = array_filter($queryParams);
    
        // Make API request
        $response = Http::freyarest()->get('articles/search', $queryParams);
    
        if ($response->failed()) {
            return view('error', ['message' => 'Unable to fetch articles. Please try again later.']);
        }
    
        $articles = $response->json()['data'];
    
        // Fetch responses from api
        $typesResponse = Http::freyarest()->get('types')->json();
        $plantsResponse = Http::freyarest()->get('plants')->json();
        $categoriesResponse = Http::freyarest()->get('categories')->json();

        //get only the name field in data
        $types = array_map(fn($type) => $type['name'], $typesResponse['data'] ?? []);
        $plants = array_map(fn($plant) => $plant['name'], $plantsResponse['data'] ?? []);
        $categories = array_map(fn($category) => $category['name'], $categoriesResponse['data'] ?? []);
    
        return view('articles.filter', [
            'articles' => $articles,
            'types' => $types,
            'plants' => $plants,
            'categories' => $categories,
        ]);
    }
    

}