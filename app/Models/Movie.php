<?php

namespace App\Models;

use Illuminate\Support\Facades\Http;

class Movie
{
    public array $data;

    public function __construct(string $id)
    {
        $this->searchImdbId($id);
    }

    private function searchImdbId(string $id)
    {
        $token = env('IMDB_TOOLS_TOKEN');
        $apiUrl = "https://www.myapifilms.com/imdb/idIMDB?idIMDB=$id&token=$token&format=json&language=pt-br&aka=0&business=0&seasons=0&seasonYear=0&technical=1&trailers=0&movieTrivia=0&awards=0&moviePhotos=0&movieVideos=0&actors=0&biography=0&uniqueName=0&filmography=0&bornDied=0&starSign=0&actorActress=0&actorTrivia=0&similarMovies=0&goofs=0&keyword=0&quotes=0&fullSize=0&companyCredits=0&filmingLocations=0&directors=1&writers=1";

        $response = Http::get($apiUrl)->json()['data']['movies'][0];
        $this->data = [
            'year' => $response['year'],
            'genres' => $this->formatGenres($response['genres']),
            'runtime' => $this->formatRuntime($response['technical']['runtime'][0]),
            'rating' => $this->formatRating($response['rating']),
            'rated' => $response['rated'],
            'title' => $response['title']
        ];
    }

    private function formatGenres(array $genres): string
    {
        return implode('/', $genres);
    }

    private function formatRuntime(string $runtime): string
    {
        $runtime = str_replace(' ', '', $runtime);
        $runtime = str_replace('hr', 'h', $runtime);
        $runtime = str_replace('min', 'm', $runtime);
        $runtime = substr($runtime, 0, strpos($runtime, '('));
        return $runtime;
    }

    private function formatRating(string $rating): string
    {
        return str_replace(',', '.', $rating);
    }
}
