<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieInfoController extends Controller
{
    public string $id;

    public function search(Request $request)
    {
        if (empty($request->url)) {
            return response()->json(['error' => '⚠️Url inválida⚠️'], 400);
        }


        $this->id = $this->sanatizeUrl($request->url);

        if (empty($this->id)) {
            return response()->json(['error' => '⚠️Url inválida⚠️'], 400);
        }


        $movie = new Movie($this->id);
        return response()->json($movie);
    }

    private function sanatizeUrl(string $url): string
    {
        if (preg_match('/tt\\d{7}/i', $url, $matches)) {
            return $matches[0];
        }
        return '';
    }
}
