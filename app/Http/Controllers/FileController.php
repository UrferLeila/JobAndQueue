<?php

namespace App\Http\Controllers;

use App\Jobs\WriteToFileJob;

class FileController extends Controller
{
    public function write()
    {
        WriteToFileJob::dispatch();

        return back()->with('success', 'Job envoyé à la queue');
    }
}
