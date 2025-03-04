<?php

namespace App\Http\Controllers;

use Parsedown;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    public function home()
    {
        try {
            $response = Http::freyarest()->get('articles/', ['pageSize' => 3]);

            if ($response->failed()) {
                throw new \Exception("Unable to fetch articles.");
            }

            $articles = $response->json()['data'];
        } catch (\Exception $e) {
            return view('home', ['errorMessage' => $e->getMessage()]);
        }

        return view('home', ['articles' => $articles]);
    }


    public function index(Request $request)
    {
        $queryParams = [
            'pageSize' => $request->input('pageSize'),
            'page' => $request->input('page'),
        ];

         // Make API request
         try {
            $response = Http::freyarest()->get('articles/', $queryParams);

            if ($response->failed()) {
                throw new \Exception("Unable to fetch articles. Please try again later.");
            }

            $articles = $response->json()['data'];
            $pagination = $response->json()['pagination'] ?? null;
        } catch (\Exception $e) {
            // Catch any exception and pass the error message to the view
            $errorMessage = $e->getMessage();

            return view('articles.index', [
                'errorMessage' => $errorMessage
            ]);
        }

        $articles = $response->json()['data'];
        return view('articles.index', [
            'articles' => $articles,
            'pagination' => $pagination,
            'queryParams' => $queryParams
        ]);
    }

    
    public function filter(Request $request)
    {
        $queryParams = [
            'q' => $request->input('q'),
            'after' => $request->input('after'),
            'before' => $request->input('before'),
            'type' => $request->input('type'),
            'plant' => $request->input('plant'),
            'category' => $request->input('category'),
            'pageSize' => $request->input('pageSize'),
            'page' => $request->input('page'),
            'deep' => $request->input('deep')
        ];
    
        // ?all or ?pageSize={pageSize}&page={page}, but not both
        // if ($request->input('pageSize') === 'all') {
        //     $queryParams = array_filter($queryParams, fn($key) => $key !== 'pageSize', ARRAY_FILTER_USE_KEY);
  
        //     $queryParams['all'] = true;
        // } else {
        //     $queryParams['pageSize'] = $request->input('pageSize');
        //     $queryParams['page'] = $request->input('page');
        // }

        // Remove empty values
        $queryParams = array_filter($queryParams, fn($value) => !is_null($value) && $value !== '');

    

        // Make API request
        try {
            $response = Http::freyarest()->get('articles/search', $queryParams);

            if ($response->failed()) {
                throw new \Exception("Unable to fetch articles. Please try again later.");
            }

            $articles = $response->json()['data'];
            $pagination = $response->json()['pagination'] ?? null;
        } catch (\Exception $e) {
            // Catch any exception and pass the error message to the view
            $errorMessage = $e->getMessage();
            
            return view('articles.filter', [
                'errorMessage' => $errorMessage
            ]);
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
            'pagination' => $pagination,
            'queryParams' => $queryParams
        ]);
    }

    // /articles/{title}    
    public function show($title) 
    {
        try {
            // Make an API request using the title passed in the URL as part of the path
            $response = Http::freyarest()->get('articles/' . urlencode($title));  // Encode the title to handle special characters

            if ($response->failed()) {
                throw new \Exception("");
            }

            // Access the article from the 'data' key of the response
            $article = $response->json()['data'];

            if (empty($article)) {
                throw new \Exception($response->json()['message']);
            }

             // Convert markdown content to HTML
            $parsedown = new Parsedown();
            $article['content_html'] = $parsedown->text($article['content']);
        } catch (\Exception $e) {
            // Catch any exception and pass the error message to the view
            $errorMessage = $e->getMessage();
            
            return view('articles.show', [
                'errorMessage' => $errorMessage
            ]);
        }

        // Return the view with the article data
        return view('articles.show', ['article' => $article]);
    }


}