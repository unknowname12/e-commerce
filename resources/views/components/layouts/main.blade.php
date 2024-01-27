@props(['title' => 'Not Found'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title . ' - ' . \Illuminate\Support\Facades\Config::get('app.name') }}</title>
    <link rel="shortcut icon" href="{{ secure_asset('icon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('icon.webp') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ secure_asset('build/assets/app-dd71d33e.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
{{-- md --}}
<body>
    @include('components.layouts.navbar')
    <div class="min-h-screen px-[.5rem] md:px-[10rem] py-[2rem] w-full">
        {{ $slot }}
    </div>
    @include('components.layouts.footer')
    <script src="{{ secure_asset('build/assets/app-55b385e2.js') }}"></script>
</body>

</html>
