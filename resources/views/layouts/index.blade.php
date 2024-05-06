<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{asset('images/header_logo_ico.svg')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    @yield('header_link_swiper')
    <title>@yield('portfolio.title', 'MediaMentors')</title>
    <meta name="format-detection" content="telephone=no">
    <meta name="description" 
    content="Услуги по съемке фото и видео на заказ. 
    Профессиональная команда фотографов и видеографов. 
    Проведение фотосессий для любых событий: свадьбы, корпоративы, дни рождения. 
    Съемка видеороликов: рекламных, корпоративных, музыкальных. 
    Обработка и монтаж фото и видео материалов. 
    Консультации по подбору оборудования и локаций для съемок. 
    Индивидуальный подход к каждому клиенту и проекту. Гарантия качества и профессионализма.">
</head>
<body>
    @include('includes.header')

    @yield('content')
    @include('includes.link_reverse')
    @include('includes.footer')

    
    <script src="{{asset('js/main.js')}}"></script>
    @yield('portfolio_script')
</body>
</html>
