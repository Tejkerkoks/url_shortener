<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    // Metoda do wyświetlania wszystkich skróconych linków
    public function index()
    {
        // Pobieranie wszystkich linków z bazy danych
        $links = Link::all();
        
        // Zwracanie widoku z danymi linków
        return view('links.index', compact('links'));
    }

    // Metoda do tworzenia nowego skróconego linku
    public function store(Request $request)
    {
        // Walidacja wprowadzonego URL
        $request->validate([
            'original_url' => 'required|url',
        ]);

        // Generowanie unikalnego skróconego linku
        $shortenedUrl = substr(md5(time()), 0, 6); // Przykład prostego skrótu

        // Tworzenie nowego rekordu w tabeli 'links'
        Link::create([
            'original_url' => $request->original_url,
            'shortened_url' => $shortenedUrl,
        ]);

        // Przekierowanie do strony z listą linków
        return redirect()->route('links.index');
    }
}
