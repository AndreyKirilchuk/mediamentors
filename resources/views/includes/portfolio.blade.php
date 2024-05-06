<!-- Портфолио -->

<div class="container portfolio" id="reverse">
    <div class="main_array">
        <div class="main_title">
            {{$direction->title}}
        </div>
    </div>
    <div class="portfolio_card-container">
        @if($boolean)
            @php 
                $countSlider = 0
            @endphp
            @foreach($portfolio as $element)
                <!-- Карточка -->
                <div class="portfolio_card @if($element->type === 'img') portfolio_card-img @endif"   >
                    <span class="partners_form_anchor" id="portfolioCard{{$element['id']}}"></span>
                    <div class="portfolioname_mobile">
                        <h2>
                            {{$element->name}}
                        </h2>
                    </div>
                    @if($element->type === 'video')
                        @foreach($media as $thisMedia)
                            @if($thisMedia->portfolio_id === $element->id)
                                <div class="main_array-card portfolio-preview">
                                    <video src="{{asset($thisMedia->file)}}" poster="{{asset($thisMedia->poster)}}" muted autoplay playsinline preload="auto" class="main_video" loop width="100%" >
                                        <h1>Ваш бразуер не поддерживает видео</h1>
                                    </video>
                                    <button class="playButtons">
                                        <img src="{{asset('images/playButton.svg')}}" name="playButton" alt="" width="100%">
                                        <img src="{{asset('images/pauseButton.svg')}}" name="pauseButton" alt="" width="100%">
                                    </button>
                                    <button class="screenButton"> 
                                        <img src="{{asset('images/screenButton.png')}}" class="screenButtonImg" name="playButton" alt="" width="100%">
                                    </button>
                                    <button class="MuteButton MuteButtonPortfolio">
                                        <img src="{{asset('images/mute.svg')}}" class="MuteButtonImg" alt="" width="100%">
                                        <img src="{{asset('images/unmute.svg')}}" class="MuteButtonImg2" alt="" width="100%">
                                    </button>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <div class="portfolio-preview">
                            @foreach($media as $thisMedia)
                                @if($thisMedia->portfolio_id === $element->id && $thisMedia->preview === 'true')
                                    <img src="{{asset($thisMedia->file)}}" width="100%" alt="" id="0" class="card-preview  showGalereySlider"/>
                                @endif
                            @endforeach
                        </div>
                    @endif
                    <div class="portfolio_card-content">
                        <h2 class="portfolioname_desktop">
                            {{$element->name}}
                        </h2>
                        {{$element->info}}
                        <br><br>
                        {{$element->author}}
                    </div>
                    @if($element->type === 'img')
                        <div class="gallerey_container">
                            <div class="gallerey">
                                @php 
                                    $countGallerey = 0;
                                @endphp        
                                @foreach($media as $thisMedia)
                                    @if($thisMedia->portfolio_id === $element->id && $thisMedia->preview !== 'true')
                                        @php $countGallerey++ @endphp
                                        <img src="{{asset($thisMedia->file)}}" alt="" width="100%" style="display:none" id="{{$countGallerey}}" class="showGalereySlider">
                                    @endif
                                @endforeach
                            </div>
                            <button class="btn showMoreSlides input-btn" onclick="showMoreSlides({{$countSlider}})">
                                Больше фото 
                            </button>
                            <div class="shadowPortfolio">
                                
                            </div>
                        </div>
                        <dialog class="sliderDialog">
                              <div class="sliderCross"></div>
                                <div class="swiper">
                                    <div class="swiper-wrapper">
                                        @foreach($media as $thisMedia)
                                            @if($thisMedia->portfolio_id === $element->id)
                                                <div class="swiper-slide">
                                                    <img src="{{asset($thisMedia->file)}}" width="100%" alt="" class="card-preview"/>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <!-- If we need navigation buttons -->
                                    <div class="swiper-button-prev"></div>
                                    <div class="swiper-button-next"></div>
                                </div>
                            </dialog>
                    @endif
                </div>
                @php
                    $countSlider++
                @endphp
            @endforeach
        @else
            <span style="color:white;">У этого направления пустое портфолио</span>
        @endif
    </div>
</div>


<div class="sliderModal"></div>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>