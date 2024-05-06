
<div class="container" id="form" style="padding-top:150px;">
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

<div class="container" id="form" style=" margin-bottom:50px;">
    <div>
        <form method="post" name="renamePass" action="/renamePass" style="align-items: center; display: flex; justify-content: space-between">
            @csrf
            @method('put')
            <input type="text" name="newpassword" placeholder="Введите новый пароль" required>
            <button class="input-btn btn" type="submit" style="width: 300px">
                Cменить пароль
            </button>
        </form>
    </div><br><br>
    <div>
        <form method="POST" action="/direction"  style="align-items: center; display: flex; justify-content: space-between">
            @csrf
            <div>
                <input type="text" name="newDirection" placeholder="Введите название направления" required style="min-width: 350px">
            </div>
            <button class="input-btn btn" type="submit" style="width: 300px">
               Создать направление
            </button>
        </form>
    </div>
</div>


<div class="container" style="color:White;">
    <h2>Все направления:</h2>
</div>

@include('includes.mainAdmin')

@section('admin_link')
    <a href="{{route('logout')}}">ВЫЙТИ ИЗ АДМИНКИ</a>
@endsection
