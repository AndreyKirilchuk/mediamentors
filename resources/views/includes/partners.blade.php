  
 <div class="container mobile_container" id="main">
    <span class="partners_form_anchor" id="partners-form"></span>
    <!-- Партнеры -->
    <div class="main_array partner_title_array">
        <div class="main_title partner_title">
            Клиенты
        </div>
    </div>
</div>

    <!-- Бегущая строка -->
  <section class="marquee">
          <div>
              @foreach($partners as $partner)
                  <img src="{{asset($partner->img)}}" alt="{{ $partner->img }}">
              @endforeach
          </div>
          <div>
              @foreach($partners as $partner)
                  <img src="{{asset($partner->img)}}" alt="{{ $partner->img }}">
              @endforeach
          </div>
  </section>


