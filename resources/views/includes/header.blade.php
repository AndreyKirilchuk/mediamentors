<!-- Плашка с услугами -->
<div class="servis">
    <div class="container mobile_container">
        <header class="servis_header">
            <div class="header_logo">
                <img src="{{asset('images/header_logo_ico.svg')}}" alt="">
                <img src="{{asset('images/production.svg')}}" alt="">
            </div>
            <div class="header_cross" onclick="closeServis()">

            </div>
        </header>
        <div class="servis_info">
            <h1>МЫ ДЕЛАЕМ</h1>
            <div class="servis_info-text">
                <div class="text-anim">КЛИПЫ</div>
                <div class="text-anim">ФОТО</div>
                <div class="text-anim">РЕКЛАМА</div>
                <div class="text-anim">ГРАФИКА</div>
                <div class="text-anim">ИНТЕРВЬЮ</div>
                <div class="text-anim">ВИДЕО-КУРСЫ</div>
            </div>
        </div>
        <div class="portfolio_card-btn_container portfolio_card-btn_container-servis">

        </div>
    </div>
</div>
<div class="header_container">
    <div class="container mobile_container">
        <!-- Шапочка -->
        <header id="header">
            <!-- Лого -->
            <a href="/" style="z-index: 910;">
                <div class="header_logo">
                    <img src="{{asset('images/header_logo_ico.svg')}}" alt="">
                    <img src="{{asset('images/header_logo_text.svg')}}" alt="">
                </div>
            </a>
            <div class="header_logo_mobile">
                <img src="{{asset('images/header_logo_text.svg')}}" alt="">
            </div>
            <!-- Кнопки навигации -->
            <nav>
                <a href="@yield('portfolio.link', '#partners-form')">ЗАКАЗАТЬ СЪЁМКУ</a>
                <a href="#services" onclick="openServis()">УСЛУГИ</a>
                <a href="@yield('portfolio_case','#cases')">КЕЙСЫ</a> 
                <a href="link">ПРЕЗЕНТАЦИЯ</a>
                @yield('admin_link')
            </nav>
            <!-- Иконка бургера появляется при достиженении 1024px а навигация выше скрывается -->
            <div class="header_burger" onclick="toggleMenu()">
                <div class="line"></div>
                <div class="line"></div>
            </div>
            <!-- Бургер меню -->
            <div class="burger-menu">
                <a href="@yield('portfolio_case','#cases')" onclick="toggleMenu()">Кейсы</a> 
                <a href="#services" onclick="openServis()">Услуги</a>
                <a href="@yield('portfolio.link', '#partners-form')" onclick="toggleMenu()">Связаться</a>
                <a href="link">Презентация</a>
                @yield('admin_link')
                <div class="burger_line"></div>
                <a href="mailto:hello@mediamentors.ru" class="burger_bottom-link" target="_blank">hello@mediamentors.ru</a>
                <div class="burger_link-container">
                    <a href="https://t.me/ohmyproducer" class="burger_bottom-link" target="_blank">Telegram</a>
                    <a href="https://wa.me/+79955092409" class="burger_bottom-link"  target="_blank">WhatsApp</a>
                </div>
            </div>
        </header>
    </div>
</div>
