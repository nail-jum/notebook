@extends("layouts.main")

@section("javascript")
{{-----------------------------------------------}}
document.addEventListener("DOMContentLoaded", function () {
    var btnCancel = document.querySelector('#btn-cancel');
    btnCancel.addEventListener('click', function() {window.location = '{{url("/")}}';});
});
{{-----------------------------------------------}}
@endsection

@section("main_content")
{{-----------------------------------------------}}
<h1>Записная книжка</h1>
<h2>добавление контакта</h2>

<form class="data-form" method="post" action="<?= $_SERVER['REQUEST_URI'] ?>">
    @csrf
    <div>
        <label for="name">Имя:</label>
        <input type="text" id="name" name="name" class="form_input">
    </div>
    <div>
        <label for="company">Компания:</label>
        <input type="text" id="company" name="company" class="form_input">
    </div>
    <div>
        <label for="phone">Телефон:</label>
        <input type="text" id="phone" name="phone" class="form_input">
    </div>
    <div>
        <label for="email">email:</label>
        <input type="text" id="email" name="email" class="form_input">
    </div>
    <div>
        <label for="birthday">Дата рождения:</label>
        <input type="date" id="birthday" name="birthday" class="form_input">
    </div>
    <div class="form-buttons">
        <input id="btn-cancel" type="button" value="Отмена">
        <input id="btn-submit" type="submit" value="Отправить">
    </div>
</form>
{{-----------------------------------------------}}
@endsection
