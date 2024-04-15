<!DOCTYPE html>
<html>
<head>
    <title>YouTube Playlists</title>
</head>
<body>
    <h1>YouTube Playlists</h1>

    <ul>
        @foreach($playlists as $playlist)
            <li>{{ $playlist['snippet']['title'] }}</li>
        @endforeach
    </ul>
</body>
</html>
