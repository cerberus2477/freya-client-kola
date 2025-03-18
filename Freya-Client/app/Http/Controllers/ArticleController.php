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
                throw new \Exception("Sikertelen kérés.");
            }

            $articles = $response->json()['data'];
        // Catch any exception and pass the error message to the view
        } catch (\Exception $e) {
            $errorMessage = $this->handleXAMPPError($e);
            return view('home', ['errorMessage' => $errorMessage]);
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
            
        // Catch any exception and pass the error message to the view
        } catch (\Exception $e) {
            $errorMessage = $this->handleXAMPPError($e);

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

        
        // ?all or ?pageSize={pageSize}&page={page}, but not both
        // if ($request->input('pageSize') === 'all') {
        //     $queryParams = array_filter($queryParams, fn($key) => $key !== 'pageSize', ARRAY_FILTER_USE_KEY);
  
        //     $queryParams['all'] = true;
        // } else {
        //     $queryParams['pageSize'] = $request->input('pageSize');
        //     $queryParams['page'] = $request->input('page');
        // }


    // public function filter(Request $request)
    // {
    //     // TODO: ki kell szűrni az oldalszámot?
    //     $queryParams = $request->except(['page']);


    //     //deep is a flag in the api, it does not have value (on, or true/false). we are making it the correct format from the incoming request
    //     if (!$request->has('deep')) {
    //         unset($queryParams['deep']);
    //     }

    //     if ($request->has('deep')) {
    //         $queryParams['deep'] = true; 
    //     }

    //     // Remove empty values to keep URL clean
    //     $queryParams = array_filter($queryParams, fn($value) => $value !== null && $value !== '');
    //     Log::info("Szűrt queryParams:", $queryParams);

    //             // Logoljuk az API-kérés URL-jét és paramétereit
    //     $apiUrl = 'articles/search?' . http_build_query($queryParams);
    //     Log::info("API request: " . $apiUrl);

    //     // Make API request
    //     try {
    //         $response = Http::freyarest()->get('articles/search', $queryParams);

    //         if ($response->failed()) {
    //             throw new \Exception("Unable to fetch articles. Please try again later.");
    //         }

    //         $articles = $response->json()['data'];
    //         $pagination = $response->json()['pagination'] ?? null;

    //     // Catch any exception and pass the error message to the view
    //     } catch (\Exception $e) {
    //         return view('articles.filter', [
    //             'errorMessage' => $this->handleXAMPPError($e)
    //         ]);
    //     }

    //     // Fetch responses from api - get only the name field in data
    //     $types = array_column(Http::freyarest()->get('types')->json()['data'] ?? [], 'name');
    //     $plants = array_column(Http::freyarest()->get('plants')->json()['data'] ?? [], 'name');
    //     $categories = array_column(Http::freyarest()->get('categories')->json()['data'] ?? [], 'name');

    //     //csak azokat add vissza aminek van értéke. oldd meg hogy működjön a filter oldal így is. ha van pl beállított q paraméter, akkor a search inputnak legyen az az értéke.
    //     return view('articles.filter', compact('articles', 'types', 'plants', 'categories', 'pagination', 'queryParams'));
    // }


    public function filter(Request $request)
    {
        // Fetch filter options from the API - get only the name field in data
        $types = array_column(Http::freyarest()->get('types')->json()['data'] ?? [], 'name');
        $plants = array_column(Http::freyarest()->get('plants')->json()['data'] ?? [], 'name');
        $categories = array_column(Http::freyarest()->get('categories')->json()['data'] ?? [], 'name');

        // Collect all parameters for the API request
        $parameters = $request->only(['q', 'deep', 'type', 'plant', 'after', 'before', 'category', 'pageSize', 'page']);

        // Reset `page` (jump to first page) if query or filters change (not `pageSize`)
        if ($request->except(['page', 'pageSize']) !== $request->only(['page', 'pageSize'])) {
            unset($parameters['page']);
        }

        // Make API request
        try {
            $response = Http::freyarest()->get('articles/search', $parameters);

            if ($response->failed()) {
                throw new \Exception("Unable to fetch articles. Please try again later.");
            }

            $articles = $response->json()['data'] ?? [];
            $pagination = $response->json()['pagination'] ?? null;

        // Catch any exception and pass the error message to the view
        } catch (\Exception $e) {
            return view('articles.filter', [
                'errorMessage' => $this->handleXAMPPError($e)
            ]);
        }

        // Return view with data
        return view('articles.filter', compact('types', 'plants', 'categories', 'articles', 'pagination'));
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