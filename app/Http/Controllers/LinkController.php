<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;  

class LinkController extends Controller
{
    // Metoda do tworzenia nowego linku
    public function store(Request $request)
    {
        // Walidacja wejściowego URL
        $request->validate([
            'original_url' => 'required|url',
        ]);

        // Generowanie skróconego URL
        $shortenedUrl = substr(md5(uniqid(rand(), true)), 0, 6);

        // Tworzenie nowego wpisu w bazie danych
        $link = new Link();
        $link->original_url = $request->original_url;
        $link->shortened_url = $shortenedUrl;
        $link->save();

        return response()->json([
            'original_url' => $link->original_url,
            'shortened_url' => $link->shortened_url,
        ]);
    }

    // Metoda do przekierowywania użytkownika z krótkiego URL do pełnego
    public function redirect($shortUrl)
    {
        // Wyszukaj link w bazie danych na podstawie skróconego URL
        $link = Link::where('shortened_url', $shortUrl)->firstOrFail();

        // Przekierowanie do oryginalnego URL
        return redirect($link->original_url);
    }
}
