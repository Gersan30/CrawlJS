<?php

namespace App\Http\Controllers;

use Goutte\Client;
use Illuminate\Http\Request;
use Symfony\Component\HttpClient\HttpClient;

class CrawlerController extends Controller
{
    public function crawl(Request $request)
    {
        $url = $request->input('url');
        
        if (!$url) {
            return redirect()->back()->withErrors(['url' => 'No URL provided']);
        }

        $client = new Client(HttpClient::create(['timeout' => 60]));
        $crawler = $client->request('GET', $url);

        // Extract all JavaScript file URLs
        $jsFiles = $crawler->filter('script[src]')->each(function ($node) {
            return $node->attr('src');
        });

        return view('crawler', ['jsFiles' => $jsFiles]);
    }

    public function showForm()
    {
        return view('crawler');
    }
}
