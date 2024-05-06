<div>
    <div class="container">
        <form method="POST" id="recaptcha-form" style="padding-top:150px;" action="/login"  style="display: flex; justify-content: space-between">
            @csrf
            <input type="text" name="password" placeholder="Введите пароль" required>
            <button type="submit" class="portfolio_card-btn btn"style="float:right">
                Войти
            </button>
        </form>
        @if($errors->any())
            <div style="color:White;">
                Ошибка
            </div>
        @endif
    </div>
</div>
