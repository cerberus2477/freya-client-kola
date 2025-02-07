# Kommentek
A kliens az apit automatikusan a localhost:8069-es címen keresi, de az envben a api_urlt módosítva ezt át lehet állítani. we made it configurable c:

# Freya's Web (client)

***Az éves projektünkhöz (Freya's Garden) készül a weboldal Laravelben***

  
## Futtatás lépései:
1. Töltsd le a projektet. 
 <a href= "https://github.com/cerberus2477//archive/refs/heads/master.zip"><img src="http://img.shields.io/badge/Download_ZIP_green?style=for-the-badge" alt="Download ZIP"></a>
    - Csomagold ki a fájlt a `C:\xampp\htdocs\` mappába.
2. XAMPP indítása (Apache, MySQL) és a <a href= "https://github.com/cerberus2477/freya-rest-kola/archive/refs/heads/master.zip">REST API</a> indítása
    - (opcionális, e nélkül is elindul az oldal de az adatokat nem fogja tudni lekérni) 
3. Futtasd a Laravel működéséhez szükséges parancsokat a projekt mappájában.
```cmd
composer install
php artisan serve --port 8000
```
4. A weboldal megnyitása a `http://127.0.0.1:8000/` címen. Enjoy :)



Potential errors:
- `composer install` eredménye sok sok ilyesmi: `Failed to download psr/log from dist: The zip extension and unzip command are both missing, skipping.`
	- **megoldás**: `C:\xampp\php\php.ini`-ben `extension=zip` legyen `;` nélkül.
