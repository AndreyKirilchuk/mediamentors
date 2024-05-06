



    @foreach($directions as $direction)
        @php
            $count = 0;
        @endphp
        <!-- Плашка с заголовком и картами -->
        <div class="main_array">
            <span class="partners_form_anchor" id="cases"></span>
            <!-- Заголовок для карточек -->
            <div class="main_array-title">
                <a href="{{route('portfolio.index', $direction['id'])}}" class="title-link --debug main_title">{{$direction['title']}}</a>
            </div>
            <!-- Карточки -->
            <div class="main_array-card-container">
                @foreach($portfolio as $element)
                    @if($element['direction_id'] === $direction['id'])
                        @if($count < 3)
                            @if($element['type'] === 'video')
                                @foreach($media as $thisMedia)
                                    @if($thisMedia->portfolio_id === $element->id)
                                        <a href="/portfolio/{{$direction['id']}}#portfolioCard{{$element['id']}}" class="main_array-card">
                                            <video  src="{{asset($thisMedia->file)}}" poster="{{$thisMedia['poster']}}" muted autoplay playsinline preload="auto" class="main_video hoverMedia hovervideo" loop width="100%" >
                                                <h1>Ваш бразуер не поддерживает видео</h1>
                                            </video>
                                            <span class="main-array-card-text">{{$element['name']}}</span>
                                        </a>
                                    @endif
                                @endforeach
                            @else
                                <a href="/portfolio/{{$direction['id']}}#portfolioCard{{$element['id']}}" class="main_array-card">
                                    <div class="mainswiper">
                                        @foreach($media as $thisMedia)
                                            @if($thisMedia->portfolio_id === $element->id)
                                                <img src="{{asset($thisMedia->file)}}" alt="" width="100%" class="card-preview hoverMedia">
                                                @break
                                            @endif
                                        @endforeach
                                    </div>
                                    <span class="main-array-card-text">{{$element['name']}}</span>
                                </a>
                            @endif
                            @php
                                $count++
                            @endphp
                        @endif
                    @endif
                @endforeach
                @if($count === 0)
                    <span style="color:white">У данного направления пустое портфолио(</span>
                @endif
            </div>
        </div>
    @endforeach
    @if(!$boolean)
        <h2 style="color:white">Нет направлений</h2>
    @endif
    </div>

