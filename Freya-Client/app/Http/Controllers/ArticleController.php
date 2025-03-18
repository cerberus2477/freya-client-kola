<?php

namespace App\Http\Controllers;

use Parsedown;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ArticleController extends Controller
{
    public function home()
    {
        try {
            $response = Http::freyarest()->get('articles/', ['pageSize' => 3]);

            if ($response->failed()) {
                throw new \Exception("Unable to fetch the 3 most recent articles. Please try again later.");
            }

            $articles = $response->json()['data'];
        // Catch any exception and pass the error message to the view
        } catch (\Exception $e) {
            $errorMessage = $this->handleXAMPPError($e);
            return view('home', ['errorMessage' => $errorMessage]);
        }

        return view('home', ['articles' => $articles]);
    }
        

    public function search(Request $request)
    {
        // Collect all parameters for the API request
        $parameters = $request->only(['q', 'deep', 'type', 'plant', 'after', 'before', 'category', 'pageSize']);

        if ($request->has('page')) {
            $parameters['page'] = $request->query('page');
        }

        // Make API request
        try {
            $response = Http::freyarest()->get('articles/search', $parameters);

            if ($response->failed()) {
                throw new \Exception("Unable to fetch matching articles. Please try again later.");
            }

            $articles = $response->json()['data'] ?? [];
            $pagination = $response->json()['pagination'] ?? null;

        // Catch any exception and pass the error message to the view
        } catch (\Exception $e) {
            return view('articles.search', [
                'errorMessage' => $this->handleXAMPPError($e)
            ]);
        }

        // Fetch filter options from the API - get only the name field in data
        $types = array_column(Http::freyarest()->get('types')->json()['data'] ?? [], 'name');
        $plants = array_column(Http::freyarest()->get('plants')->json()['data'] ?? [], 'name');
        $categories = array_column(Http::freyarest()->get('categories')->json()['data'] ?? [], 'name');
        
        // Return view with data
        return view('articles.search', compact('types', 'plants', 'categories', 'articles', 'pagination'));
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

             // Convert markdown content to HTML
            $parsedown = new Parsedown();
            $article['content_html'] = $parsedown->text($article['content']);
        // Catch any exception and pass the error message to the view
        } catch (\Exception $e) {
            $errorMessage = $this->handleXAMPPError($e);
            
            return view('articles.show', [
                'errorMessage' => $errorMessage
            ]);
        }

        // Return the view with the article data
        return view('articles.show', ['article' => $article]);
    }

    


}