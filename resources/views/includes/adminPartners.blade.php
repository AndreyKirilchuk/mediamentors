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

<div class="container" id="main">
    <div class="main_array" id="video-reverse">
        <div class="main_title">
            Все клиенты:
        </div>
        <form method="post" action="/partners" enctype="multipart/form-data">
            @csrf
            <div class="plus btn_dialog"></div>
            <dialog>
                <div class="cross" style="float:right"></div><br>
                Выберите фото:
                <div class="fileuploadcontainer">
                    <input type="file" name="partnerFile">
                </div>
                <button type="submit" class="input-btn btn" style="width: 100%">
                    Сохранить
                </button>
            </dialog>
        </form>
    </div>
</div>
<div class="container portfolio" style="padding: 0">
    <div class="portfolio_card-container">
        @php
            $count = 1
        @endphp
        @foreach($partners as $partner)
            <!-- Карточка -->
            <div class="parnerts_card">
                <h3>Клиент №{{$count}}</h3>
                <img src="{{asset($partner->img)}}" width="150px" alt="">
                <div class="portfolio_card-content">
                    <form method="post" action="/partners" enctype="multipart/form-data">
                        @csrf
                        @method('delete')
                        <button type="button" class="input-btn btn btn_dialog">
                            Удалить
                        </button>
                        <dialog>
                            <div class="cross" style="float:right"></div><br><br>
                            <input type="hidden" value="{{$partner->img}}" name="thisPartnerPath">
                            <input type="hidden" value="{{$partner->id}}" name="thisPartnerId">
                            <button type="submit" class="input-btn btn" style="width: 100%">
                                Подтвердите удаление
                            </button>
                        </dialog>
                    </form>
                </div>
            </div>
            @php
                $count++
            @endphp
        @endforeach
    </div>
</div>


@section('admin_link')
    <a href="{{route('logout')}}">ВЫЙТИ ИЗ АДМИНКИ</a>
@endsection

