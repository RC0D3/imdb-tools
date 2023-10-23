<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use DateInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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


        $movie = Cache::remember($this->id, DateInterval::createFromDateString('1 day'), fn () =>  new Movie($this->id));
        $movie = new Movie($this->id);
        return response()->json($movie);
    }

    private function sanatizeUrl(string $url): string
    {
        if (preg_match('/tt(\\d{8}|\\d{7})/i', $url, $matches)) {
            return $matches[0];
        }
        return '';
    }
}
