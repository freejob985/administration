<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class YouTubeController extends Controller
{
    public function getPlaylists()
    {
        $apiKey = 'AIzaSyBZCTa-1nF4LuMeYvfq1WnYUrvotzH0wd0';
        $client = new Client();

        $response = $client->request('GET', 'https://www.googleapis.com/youtube/v3/playlists?part=snippet&mine=true&key=' . $apiKey);

        $playlists = json_decode($response->getBody(), true)['items'];

        return view('youtube.playlists', ['playlists' => $playlists]);
    }

    public function getVideos($playlistId)
    {
        $apiKey = 'AIzaSyBZCTa-1nF4LuMeYvfq1WnYUrvotzH0wd0';
        $client = new Client();

        $response = $client->request('GET', 'https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&playlistId=' . $playlistId . '&key=' . $apiKey);

        $videos = json_decode($response->getBody(), true)['items'];

        return view('youtube.videos', ['videos' => $videos]);
    }
}
