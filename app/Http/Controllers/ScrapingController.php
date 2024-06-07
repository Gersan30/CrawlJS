<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;

class ScrapingController extends Controller
{
    public function showForm()
    {
        return view('scrape_form');
    }

    public function scrape(Request $request)
    {
        $url = $request->input('url');

        $client = new Client();
        $crawler = $client->request('GET', $url);

        // Obténemos todos los enlaces de la página
        $links = $crawler->filter('a')->each(function ($node) {
            return $node->attr('href');
        });

        return view('scraped_links', compact('links'));
    }
}



