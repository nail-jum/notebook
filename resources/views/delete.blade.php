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
<h2>удаление контакта</h2>

<form class="data-form" method="post" action="{{url('/delete/'.$row->id)}}">
    @csrf
    <div>
        <label for="name">Имя:</label>
        <div class="form_show">{{$row->name}}</div>
    </div>
    <div>
        <label for="company">Компания:</label>
        <div class="form_show">{{$row->company}}</div>
    </div>
    <div>
        <label for="phone">Телефон:</label>
        <div class="form_show">{{$row->phone}}</div>
    </div>
    <div>
        <label for="email">email:</label>
        <div class="form_show">{{$row->email}}</div>
    </div>
    <div class="form-buttons">
        <input id="btn-cancel" type="button" value="Отмена">
        <input id="btn-delete" type="submit" value="Удалить">
    </div>
</form>
{{-----------------------------------------------}}
@endsection
