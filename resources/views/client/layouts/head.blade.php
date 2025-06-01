<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>KidsLearn - Nền tảng học tập vui nhộn cho trẻ em</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script src="{{ asset('assets/js/tw_config.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <link href="{{ asset('logo.png') }}" rel="icon" />
    <script src="//unpkg.com/alpinejs" defer></script>
    <style type="text/css">
        @import url("https://fonts.googleapis.com/css2?family=Playwrite+US+Modern:wght@100..400&display=swap");

        body {
            font-family: "Playwrite US Modern", cursive;
        }
        .text-stroke-3 {
            text-shadow: -1px -1px 0 #dd2f6f, 1px -1px 0 #dd2f6f, -1px 1px 0 #dd2f6f, 1px 1px 0 #dd2f6f;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    @stack('styles')
</head>
