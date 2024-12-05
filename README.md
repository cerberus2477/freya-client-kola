# Kommentek
A kliens az apit automatikusan a localhost:8069-es címen keresi, de az envben a api_urlt módosítva ezt át lehet állítani. we made it configurable c:



# Laravel API és Kliens létrehozásának lépései

## **API Project**
The API project will handle the data and logic, exposing it to the client via RESTful endpoints.

#### **1. Set Up Laravel API Project**
- Install Laravel:
  ```bash
  composer create-project laravel/laravel api-project
  ```
- Configure `.env`:
  - Set up database credentials.
  - Set `API_BASE_URL` to the API's URL (e.g., `http://api.local`).

#### **2. Define Routes**
- Use `routes/api.php` for defining API routes.
- Example:
  ```php
  Route::get('/posts', [PostController::class, 'index']);
  ```

#### **3. Create Controllers**
- Use Artisan to create controllers:
  ```bash
  php artisan make:controller PostController
  ```
- Example `PostController`:
  ```php
  public function index()
  {
      return Post::all();
  }
  ```

#### **4. Create Models and Migrations**
- Generate models with migrations:
  ```bash
  php artisan make:model Post -m
  ```
- Define the database schema in the migration file, then migrate:
  ```bash
  php artisan migrate
  ```

#### **5. Use Resource Controllers (Optional)**
- Create a resource controller:
  ```bash
  php artisan make:controller PostController --resource
  ```
- Define standard CRUD actions.

#### **6. Add Authentication (Optional)**
- Install Laravel Sanctum for token-based authentication:
  ```bash
  composer require laravel/sanctum
  php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
  php artisan migrate
  ```
- Middleware for securing routes:
  ```php
  Route::middleware('auth:sanctum')->group(function () {
      Route::get('/posts', [PostController::class, 'index']);
  });
  ```

#### **7. Test API**
- Use tools like Postman or curl to test the API endpoints.

---

## **Client Project**
The client will fetch data from the API.

#### **1. Set Up Laravel Client Project**
- Install Laravel:
  ```bash
  composer create-project laravel/laravel client-project
  ```
- Configure `.env`:
  - Set `APP_URL` to the client’s URL (e.g., `http://client.local`).

#### **2. Install HTTP Client**
- Use Laravel’s built-in HTTP client or Guzzle:
  ```bash
  composer require guzzlehttp/guzzle
  ```

#### **3. Create Services to Consume API**
- Create a service to handle API requests:
  ```php
  namespace App\Services;

  use Illuminate\Support\Facades\Http;

  class ApiService
  {
      public static function getPosts()
      {
          $response = Http::get('http://api.local/api/posts');
          return $response->json();
      }
  }
  ```

#### **4. Create Controllers**
- Use Artisan to create controllers:
  ```bash
  php artisan make:controller PostController
  ```
- Use the service to fetch data from the API:
  ```php
  namespace App\Http\Controllers;

  use App\Services\ApiService;

  class PostController extends Controller
  {
      public function index()
      {
          $posts = ApiService::getPosts();
          return view('posts.index', compact('posts'));
      }
  }
  ```

#### **5. Define Routes**
- Use `routes/web.php` for client-side routes:
  ```php
  Route::get('/posts', [PostController::class, 'index']);
  ```

#### **6. Create Views**
- Use Blade templates to render data:
  ```html
  <ul>
      @foreach ($posts as $post)
          <li>{{ $post['title'] }}</li>
      @endforeach
  </ul>
  ```

---

### **Shared Steps**
#### **1. Cross-Origin Resource Sharing (CORS)**
- Configure CORS on the API server to allow requests from the client.
  - Update `config/cors.php`:
    ```php
    'paths' => ['api/*'],
    'allowed_origins' => ['http://client.local'],
    ```

#### **2. Environment Setup**
- Ensure `.env` files have proper URLs (`APP_URL`, `API_BASE_URL`).

#### **3. API Authentication (If Secure)**
- If using Sanctum:
  - Ensure tokens are passed from the client:
    ```php
    Http::withToken($token)->get('http://api.local/api/posts');
    ```

#### **4. Test Integration**
- Use tools like Postman or browser developer tools to debug and ensure the client is correctly fetching data from the API.
