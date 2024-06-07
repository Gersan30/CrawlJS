<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class ScraperController extends Controller
{
    public function scrape(Request $request)
    {
        $url = $request->input('url');
        $depth = $request->input('depth', 1);

        if (!$url) {
            return redirect()->back()->withErrors(['url' => 'No URL provided']);
        }

        // Usa 'python' en lugar de 'python3' para Windows
        $process = new Process(['python', base_path('python_scripts/crawler.py'), $url, $depth]);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $links = json_decode($process->getOutput(), true);

        return view('scraper', ['links' => $links]);
    }

    public function showForm()
    {
        return view('scraper');
    }
}



