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
<div class="container" id="main">
    <h2 style="color:white;">Все заявки:</h2>
    <div class="applications-container">
        @foreach($applications->reverse() as $application)
            <div class="applications-info">
                <div>
                    №: {{$application->id}}
                </div>
                <div>
                    Имя: {{$application->name}}
                </div>

                <div>
                    Телефон: {{$application->tel}}
                </div>
                <div>
                    @if($application->status === 1)
                        <form method="post" action="/falseApplication">
                            @csrf
                            @method('patch')
                            <input type="hidden" value="{{$application->id}}" name="application_id">
                            <input type="submit" class="input-btn btn" style="background: green" value="Обзвонен">
                        </form>
                    @else
                        <form method="post" action="/trueApplication" >
                            @csrf
                            @method('patch')
                            <input type="hidden" value="{{$application->id}}" name="application_id">
                            <input type="submit" class="input-btn btn" value="Не обзвонен">
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>


@section('admin_link')
    <a href="{{route('logout')}}">ВЫЙТИ ИЗ АДМИНКИ</a>
@endsection
