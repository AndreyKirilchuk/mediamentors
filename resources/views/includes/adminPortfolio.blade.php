<!-- Портфолио -->
<div class="container" id="form" style="padding-top:150px">
    <nav class="adminNav">
        <a href="/admin">
            Направления
        </a>
        <a href="/adminApplications">
            Посмотреть все заявки
        </a>
        <a href="/adminPartners">
            Партнеры
        </a>
    </nav>
</div>
<div class="container portfolio"  id="reverse">
    <div class="main_array">
        <div class="main_title adminTitle">
            {{$direction->title}}
            <span>
          Управление портфолио:
        </span>
            <a href="{{route('admin.index')}}">
                Обратно
            </a>
        </div>


        <form method="post" action="/portfolio" enctype="multipart/form-data">
            @csrf
            <div class="plus btn_dialog" style="margin:50px 0px"></div>
            <dialog>
                <div class="cross" style="float:right"></div><br>
                <input class="adminInput" type="text" required placeholder="Введите название" name="portfolioName"><br><br>
                <textarea name="portfolioInfo" rows="4" required placeholder="Введите описание" > </textarea>
                <input class="adminInput" type="text" required placeholder="Введите имя автора" name="portfolioAuthor"><br><br>
                <input type="hidden" name="newportfolioDirectionId" value="{{$direction->id}}">
                Выберите фото или видео:
                <div class="fileuploadcontainer">
                    <input type="file" name="portfolioFile" required>
                </div>
                Выберите обложку, если загружаете видео
                <div class="fileuploadcontainer">
                    <input type="file" name="portfolioPoster">
                </div>
                <button type="submit" class="input-btn btn" style="width: 100%">
                    Сохранить
                </button>
            </dialog>
        </form>
    </div>
    <div class="portfolio_card-container">
        @if($boolean)
        @foreach($portfolio as $element)
            <!-- Карточка -->
                <div class="portfolio_card @if($element->type === 'img') portfolio_card-img @endif">
                @if($element->type === 'video')
                        @foreach($media as $thisMedia)
                            @if($thisMedia->portfolio_id === $element->id)
                                <div class="main_array-card portfolio-preview">
                                    <video src="{{asset($thisMedia->file)}}" poster="{{asset($thisMedia->poster)}}" muted controls="controls"  class="main_video" loop width="100%" >
                                        <h1>Ваш бразуер не поддерживает видео</h1>
                                    </video>
                                    <button class="playButtons">
                                        <img src="{{asset('images/playButton.svg')}}" name="playButton" alt="" width="100%">
                                        <img src="{{asset('images/pauseButton.svg')}}" name="pauseButton" alt="" width="100%">
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
                    <h2>
                        <a href="{{route('adminPortfolioElementBlade',$element->id)}}">
                            {{$element->name}}
                        </a>
                    </h2>
                    {{$element->info}}
                    <br><br>
                    {{$element->author}}
                    <br><br>
                    <div style="display: flex; gap:20px;">
                        <form method="post" action="/portfolio">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="directionId" value="{{$element->direction_id}}">
                            <input type="hidden" name="thisPortfolioId" value="{{$element->id}}">
                            <button type="button" class="input-btn btn btn_dialog">
                                Удалить
                            </button>
                            <dialog>
                                <div class="cross" style="float:right"></div><br><br>
                                <button type="submit" class="input-btn btn" style="width: 100%">
                                    Потвердите удаление
                                </button>
                            </dialog>
                        </form>
                        <a href="{{route('adminPortfolioElementBlade',$element->id)}}">
                            <button type="button" class="input-btn btn btn_dialog" style="min-width: 300px">
                                Управление элементом
                            </button>
                        </a>
                    </div>
                </div>
                    @if($element->type === 'img')
                        <div class="gallerey_container">
                            <div class="gallerey">
                            @php $countGallerey = 0; @endphp
                                @foreach($media as $thisMedia)
                                    @if($thisMedia->portfolio_id === $element->id && $thisMedia->preview !== 'true')
                                        @php
                                            $countGallerey++;
                                        @endphp
                                        <img src="{{asset($thisMedia->file)}}" alt="" width="100%" id="{{$countGallerey}}" class="showGalereySlider">
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <dialog class="sliderDialog">
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
        @endforeach
        @else
            <span style="color:white;">У этого направления пустое портфолио</span>
        @endif
    </div>
</div>



@section('admin_link')
    <a href="{{route('logout')}}">ВЫЙТИ ИЗ АДМИНКИ</a>
@endsection

