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
<div class="container portfolio">
    <div class="main_title adminTitle">
        {{$direction->title}}
        <span>
          Управление элементом:
        </span>
        <a href="{{route('adminPortfolioBlade', $direction->id)}}">
            Обратно
        </a>
    </div>

    <div class="portfolio_card-container">
                <!-- Карточка -->
                <div class="portfolio_card">
                    @if($element->type === 'video')
                        <div class="main_array-card portfolio-preview">
                            <video src="{{asset($thisMedia->file)}}" poster="{{asset($thisMedia->poster)}}" muted controls="controls"  class="main_video" loop width="100%" >
                                <h1>Ваш бразуер не поддерживает видео</h1>
                            </video>
                            <button class="playButtons">
                                <img src="{{asset('images/playButton.svg')}}" name="playButton" alt="" width="100%">
                                <img src="{{asset('images/pauseButton.svg')}}" name="pauseButton" alt="" width="100%">
                            </button>
                        </div>
                    @else
                        @foreach($thisMedia as $thisImg)
                            @if($thisImg->preview === 'true')
                                <img src="{{asset($thisImg->file)}}" width="100%" alt="" class="card-preview portfolio-preview">
                            @endif
                        @endforeach
                    @endif
                    <div class="portfolio_card-content">
                        <h2>
                            {{$element->name}}
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
                            <form method="post" action="/portfolio" enctype="multipart/form-data">
                                @csrf
                                @method('patch')
                                <input type="hidden" name="thisPortfolioId" value="{{$element['id']}}">
                                <button type="button" class="input-btn btn btn_dialog" style="min-width: 300px">
                                    Редактировать
                                </button>
                                <dialog>
                                    <div class="cross" style="float:right"></div><br>
                                    Название:
                                    <input class="adminInput" type="text" value="{{$element->name}}" placeholder="Введите название" name="portfolioName"><br><br>
                                    Описание:
                                    <textarea name="portfolioInfo" rows="4" placeholder="Введите описание">{{$element->info}} </textarea>
                                    Автор:
                                    <input class="adminInput" type="text" placeholder="Введите имя автора" name="portfolioAuthor" value="{{$element->author}}"><br><br>
                                    <input type="hidden" name="thisPortfolioId" value="{{$element->id}}">
                                    <button type="submit" class="input-btn btn" style="width: 100%">
                                        Сохранить
                                    </button>
                                </dialog>
                            </form>
                        </div>
                    </div>
                </div>
    </div>
</div>
@php
    $countElement = 0;
@endphp
<div class="container" id="main">
    <h2 style="color:white;">Управление медиа контентом:</h2>
    @if($element->type === 'img')
        <form method="post" action="/media" enctype="multipart/form-data" style="margin-bottom: 100px">
            @csrf
            <div class="plus btn_dialog"></div>
            <dialog>
                <div class="cross" style="float:right"></div><br>
                <input type="hidden" name="portfolio_id" value="{{$element->id}}">
                <input type="hidden" name="direction_id" value="{{$element->direction_id}}">
                Выберите фото:
                <div class="fileuploadcontainer">
                    <input type="file" name="mediaFile" required>
                </div>
                <button type="submit" class="input-btn btn" style="width: 100%">
                    Сохранить
                </button>
            </dialog>
        </form>
    @endif
    <div class="applications-container">
        @if($element->type === 'img')
            @foreach($thisMedia as $thisImg)
                <div class="applications-info">
                    <div>
                        <img src="{{asset($thisImg->file)}}"  width="400px" alt="">
                    </div>
                    <div>
                        @if($thisImg->preview !== 'true')
                            Элемент галлереи №{{$countElement}}
                        @else
                            Превью
                        @endif
                    </div>
                    <div style="width:300px; display: flex; flex-direction: column; gap:20px;">
                        <form method="post" action="/media" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <button type="button" class="input-btn btn btn_dialog" style="width: 100%">
                                Изменить
                                @if($thisImg->preview !== 'true')
                                    медиа
                                @else
                                    превью
                                @endif
                            </button>
                            <dialog>
                                <div class="cross" style="float:right"></div><br><br>
                                Выберите новое фото:
                                <div class="fileuploadcontainer">
                                    <input type="file" name="mediaFile">
                                </div>
                                <input type="hidden" name="thisMediaId" value="{{$thisImg->id}}" >
                                <button type="submit" class="input-btn btn" style="width: 100%">
                                    Сохранить
                                </button>
                            </dialog>
                        </form>
                            <form method="post" action="/media" enctype="multipart/form-data">
                                @csrf
                                @method('delete')
                                <button type="button" class="input-btn btn btn_dialog" style="width: 100%">
                                    Удалить
                                </button>
                                <dialog>
                                    <div class="cross" style="float:right"></div><br><br>
                                    <input type="hidden" value="{{$thisImg->id}}" name="thisMediaId">
                                    <button type="submit" class="input-btn btn" style="width: 100%;">
                                        Подтвердите удаление
                                    </button>
                                </dialog>
                            </form>
                    </div>
                </div>
                @if($thisImg->preivew !== 'true')
                    @php
                        $countElement++;
                    @endphp
                @endif
            @endforeach
        @else
            <div class="applications-info">
                <div class="main_array-card portfolio-preview">
                    <video src="{{asset($thisMedia->file)}}" poster="{{asset($thisMedia->poster)}}" muted controls="controls"  class="main_video" loop width="400px">
                        <h1>Ваш бразуер не поддерживает видео</h1>
                    </video>
                    <button class="playButtons">
                        <img src="{{asset('images/playButton.svg')}}" name="playButton" alt="" width="100%">
                        <img src="{{asset('images/pauseButton.svg')}}" name="pauseButton" alt="" width="100%">
                    </button>
                </div>
                <div style="width:300px; display: flex; flex-direction: column; gap:20px;">
                    <form method="post" action="/media" enctype="multipart/form-data">
                        @csrf
                        <button type="button" class="input-btn btn btn_dialog" style="width: 100%">
                            Изменить медиа
                        </button>
                        <dialog>
                            <div class="cross" style="float:right"></div><br><br>
                            Выберите новое видео:
                            <div class="fileuploadcontainer">
                                <input type="file" name="mediaFile">
                            </div>
                            Выберите новую обложку для видео
                            <div class="fileuploadcontainer">
                                <input type="file" name="mediaPoster">
                            </div>
                            <input type="hidden" name="thisMediaId" value="{{$thisMedia->id}}">
                            <button type="submit" class="input-btn btn" style="width: 100%">
                                Сохранить
                            </button>
                        </dialog>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>

@section('admin_link')
    <a href="{{route('logout')}}">ВЫЙТИ ИЗ АДМИНКИ</a>
@endsection

