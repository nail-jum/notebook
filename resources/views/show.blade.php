<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Telegraph</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="{{url('/styles.css?2')}}">
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var btnCancel = document.querySelector('#btn-cancel');
            btnCancel.addEventListener('click', function (){window.location = '{{url("/")}}';});
        });
    </script></head>
<body>
<h1>Просмотр статьи</h1>

<div class="data-form">
    <div>
        <label>Автор:</label>
        <div class="form_show">{{$text->author}}</div>
    </div>
    <div>
        <label">Наименование:</label>
        <div class="form_show">{{$text->title}}</div>
    </div>
    <div>
        <label>Текст:</label>
        <div class="form_show">{!!nl2br($text->text)!!}</div>
    </div>
    <div>
        <label>Добавлено: {{$text->created_at}}</label><br>
        <label>Изменено: {{$text->updated_at}}</label>
    </div>
    <div class="form-buttons">
        <input id="btn-cancel" type="button" value="Закрыть">
    </div>
</div>
