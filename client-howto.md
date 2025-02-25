
## **Client Project**
The client will fetch data from the API.

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

#### **3. API Authentication (If Secure)**
- If using Sanctum:
  - Ensure tokens are passed from the client:
    ```php
    Http::withToken($token)->get('http://api.local/api/posts');
    ```
