      <!-- Форма -->
      <div class="container mobile_container" id="form">
        <div class="form_title">
            Оставьте контакты и мы с вами оперативно свяжемся
        </div>
        <form method="POST" action="/getApplication">
            @csrf
            <div class="input_container">
                <input type="text" placeholder="Имя" required name="nickname">
                <input type="number" placeholder="Номер телефона" required name="tel">
            </div>
            <div class="form_info">
                <div>
                    Нажимая на кнопку, вы даете согласие на обработку персональных данных и соглашаетесь c политикой конфиденциальности
                </div>
                <input type="submit" class="input-btn btn"  value="Отправить">
            </div>
        </form>
    </div>
    

