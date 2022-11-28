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
<h2>редактирование контакта</h2>

<form class="data-form" method="post" action="{{url('/edit')}}">
    @csrf
    <input type="hidden" name="id" value="{{$row->id}}">
    <div>
        <label for="name">Имя:</label>
        <input type="text" id="name" name="name" class="form__input" value="{{$row->name}}">
    </div>
    <div>
        <label for="company">Компания:</label>
        <input type="text" id="company" name="company" class="form__input" value="{{$row->company}}">
    </div>
    <div>
        <label for="phone">Телефон:</label>
        <input type="text" id="phone" name="phone" class="form__input" value="{{$row->phone}}">
    </div>
    <div>
        <label for="email">email:</label>
        <input type="text" id="email" name="email" class="form__input" value="{{$row->email}}">
    </div>
    <div class="form-buttons">
        <input id="btn-cancel" type="button" value="Отмена">
        <input id="btn-submit" type="submit" value="Отправить">
    </div>
</form>
{{-----------------------------------------------}}
@endsection
