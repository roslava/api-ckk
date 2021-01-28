<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    

    <!-- Fonts -->
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap"> -->

    <!-- Styles -->

    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/bootstrap.css" rel="stylesheet">

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body>
    <div class="wrapper">
        <div class="content">


        
            <div class="header-area">
            <div class="ckk-container">
                @include('navigation-dropdown')
            </div>
        </div>


            <div class="ckk-container">
                @yield('content')
            </div>

        </div>
        <div class="ckk-footer">
                футер
            </div>
    </div>
    @stack('modals')
    @livewireScripts
    @stack('scripts')
</body>

</html>