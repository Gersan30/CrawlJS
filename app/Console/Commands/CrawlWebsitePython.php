<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Log;

class CrawlWebsitePython extends Command
{
    protected $signature = 'crawl:website-python {url}';
    protected $description = 'Crawl a website using a Python script and retrieve all URLs';

    public function handle()
    {
        $url = $this->argument('url');
        $pythonScriptPath = base_path('scripts/crawler.py');

        Log::info('Starting Python process for URL: ' . $url);
        Log::info('Python script path: ' . $pythonScriptPath);

        $process = new Process(['python', $pythonScriptPath, $url]);
        $process->setTimeout(3600); // Set a timeout to prevent indefinite hanging
        $process->start();

        $process->wait(function ($type, $buffer) {
            if (Process::ERR === $type) {
                Log::error($buffer);
                $this->error($buffer);
            } else {
                Log::info($buffer);
                $this->info($buffer);
            }
        });

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        Log::info('Python process completed successfully');
        $this->info('Python process completed successfully');
    }
}

