
<div class="container" id="main">
    @foreach($directions as $direction)
        <!-- Плашка с заголовком и картами -->
        <div class="main_array" style="display: flex; justify-content: space-between; align-items: center">
            <!-- Заголовок для карточек -->
            <div class="main_array-title">
                <a href="{{route('adminPortfolioBlade', $direction['id'])}}" class="main_title">{{$direction['title']}}</a>
            </div>
            <div style="display: flex; gap:20px;">
                <form method="post" action="/direction">
                    @csrf
                    @method('delete')
                    <input type="hidden" name="thisDirectionId" value="{{$direction['id']}}">
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
                <form method="post" action="/direction">
                    @csrf
                    @method('patch')
                    <input type="hidden" name="thisDirectionId" value="{{$direction['id']}}">
                    <button type="button" class="input-btn btn btn_dialog" style="min-width: 300px">
                        Изменить название
                    </button>
                    <dialog>
                        <div class="cross" style="float:right"></div><br>
                        <input class="adminInput" type="text" placeholder="Введите новое название" name="newTitleDirection"><br><br>
                        <button type="submit" class="input-btn btn" style="width: 100%">
                            Сохранить
                        </button>
                    </dialog>
                </form>
            </div>
        </div>
    @endforeach
    @if(!$boolean)
        <h2 style="color:white">Нет направлений</h2>
    @endif
</div>
