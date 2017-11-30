<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FRITZ reist um die Welt</title>

    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #000;
            overflow: hidden;
        }

        video {
            width: 100%;
            height: 100vh;
            object-fit: contain;
            transition: transform 2s;
        }

        video.is-zoomed {
            transform: scale(10);
        }

        .skip-link {
            display: block;
            position: absolute;
            right: 0;
            bottom: 0;
            padding: 5px;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
            font-size: 12px;
            transition: background-color 0.3s;
            color: #fff;
            text-decoration: none;
        }

        .skip-link:hover {
            background-color: rgba(255, 255, 255, 1);
            color: #000;
        }
    </style>
</head>

<body>
    <video id="intro" src="/video/intro.m4v" autoplay="true"></video>

    <a href="{{ route('home') }}" class="skip-link">Intro überspringen</a>

    <script>
        var intro = document.getElementById('intro');

        function redirect() {
            window.location.href = '{{ route('home') }}';
        }

        function introEnded() {
            intro.currentTime = intro.duration - 1;
            setTimeout(function() {
                intro.classList.add('is-zoomed');
                var delay = parseInt(getComputedStyle(intro).transitionDuration, 10) * 1000;
                setTimeout(redirect, delay);
            }, 200);
        }

        intro.addEventListener('ended', introEnded, false);
    </script>
</body>

</html>