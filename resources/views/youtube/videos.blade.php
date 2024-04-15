<!DOCTYPE html>
<html>
<head>
    <title>Playlist Videos</title>
</head>
<body>
    <h1>Playlist Videos</h1>

    <ul>
        @foreach($videos as $video)
            <li>{{ $video['snippet']['title'] }}</li>
        @endforeach
    </ul>
</body>
</html>
