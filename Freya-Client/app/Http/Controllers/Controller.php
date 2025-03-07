<?php

namespace App\Http\Controllers;

abstract class Controller
{
    //return costum error message for curl error 7, which means the server is not reached. (presumably xampp or api not started issue) 
    protected function handleXAMPPError(\Exception $e)
    {
        if (strpos($e->getMessage(), 'cURL error 7') !== false) {
            $docPath = asset('storage/dokumentacio.docx');
            return "A szervert nem sikerült elérni. Kérjük, ellenőrizze a MySQL és Apache szerver, valamint az API futását. 
                    <a href='{$docPath}' target='_blank'>Dokumentáció</a>";
        }

        // Default error message
        return $e->getMessage();
    }
}