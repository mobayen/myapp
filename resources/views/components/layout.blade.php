<html class="scroll-smooth">

<head>
    <title>{{ $title ?? 'Motivational Speakers, LLC' }}</title>
    <link
        rel="stylesheet"
        href="/css/app.css"
    >
    <script
        defer
        src="{{ mix('/js/app.js') }}"
    ></script>
</head>

<body>
    <div id="app" class="font-montserrat">
        <header class="">
            <x-header></x-header>
            <hr />
        </header>
        
        <main class="my-10">
            {{ $slot }}
        </main>

        <footer>
            <x-footer></x-footer>
        </footer>
    </div>
</body>

</html>
