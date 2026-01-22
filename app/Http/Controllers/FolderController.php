<?php

namespace App\Http\Controllers;

use App\Jobs\ScanFolder;

class FolderController extends Controller
{
    public function scan()
    {
        $path = storage_path('app/my_folder'); 
        ScanFolder::dispatch($path);

        return response()->json(['message' => 'Scan lancé en arrière-plan !']);
    }
}

