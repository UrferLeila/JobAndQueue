<?php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ScanFolder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function handle()
    {
        if (!is_dir($this->path)) {
            Log::error("Le chemin n'existe pas : " . $this->path);
            return;
        }

        $files = scandir($this->path);

        foreach ($files as $file) {
            if ($file === '.' || $file === '..') continue;

            $fullPath = $this->path . DIRECTORY_SEPARATOR . $file;

            if (is_dir($fullPath)) {
                ScanFolder::dispatch($fullPath);
            } else {
                Log::info("Fichier trouvé : " . $fullPath);
            }
        }
    }
}



