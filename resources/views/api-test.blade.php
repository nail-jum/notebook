@extends("layouts.main")

@section("head_items")
{{-----------------------------------------------}}
<script src="/jquery-3.6.1.min.js"></script>
{{-----------------------------------------------}}
@endsection

@section("javascript")
{{-----------------------------------------------}}
let apiHost = 'http://notebook/api/';

// функция выполнения api-запроса
function apiRequest(requestType, apiUrl, successFunc, requestData = '') {
    $.ajax({
        url: apiHost + apiUrl,
        method: requestType,
        data: requestData,
        contentType: "application/json",
        dataType: 'json',
        success: successFunc,
        error: function(jqXHR, textStatus, errorThrown) {
            $('#content').html(JSON.stringify(jqXHR) + '<br><br>' + textStatus + '<br><br>' + errorThrown);
        }
    })
    .done(function() {
        //alert( "success" );
    })
    .fail(function() {
        //alert( "error" );
    })
    .always(function() {
        //alert( "complete" );
    });
}

// функция вывода полученного объекта (для теста)
function test(result) {
    $('#content').html(JSON.stringify(result));
}

// функция форматирования даты
function mysql2date(str) {
    if (str) {
        let arr = str.split('-');
        return arr[2] + '.' + arr[1] + '.' + arr[0];
    } else {
        return '';
    }
}

// функция вывода списка
function list(result) {
    let content = '<div><button id="btn-add">+ добавить</button></div>';
    content += '<table class="api-test"><tr><td>имя</td><td>компания</td><td>телефон</td><td>email</td><td>дата рожд.</td><td>фото</td></tr>';
    $.each(result, function(index, row) {
        content += '<tr id="row' + row['id'] + '" class="row"><td>' + row['name']
                + '</td><td>' + row['company']
                + '</td><td>' + row['phone']
                + '</td><td>' + row['email']
                + '</td><td>' + mysql2date(row['birthday'])
                + '</td><td>' + (row['photo'] && row['photo'] != 'null' ? 'есть' : 'нет')
                + '</td></tr>';
        });
    content += '</table>';
    $('#content').html(content);
    // обработчик нажатия кнопки "add"
    $('#btn-add').on('click', function() {
        add();
    });
    $('.row').each(function(index, el) {
        $(el).css('cursor', 'pointer');
        $(el).on('mouseover', function() {
            $('.row').css('backgroundColor', '#fff');
            $(this).css('backgroundColor', '#EE8');
        });
        $(el).on('click', function() {
            let id = this.id.substr(3);
            // отправка запроса
            apiRequest('GET', 'notebook/' + id, show);
        });
    });

}

// вывод формы добавления записи
function add() {
    content = '\
    <div><label>Имя:</label><input type="text" id="name"class="form_input"></div>\
    <div><label>Компания:</label><input type="text" id="company" class="form_input"></div>\
    <div><label>Телефон:</label><input type="text" id="phone" class="form_input"></div>\
    <div><label>email:</label><input type="text" id="email" class="form_input"></div>\
    <div><label>Дата рождения:</label><input type="date" id="birthday" class="form_input"></div>\
    <div><label>фото:</label>\
        <div class="photo"><img id="photo" class="photo" src=""></div>\
        <input type="file" id="photo-select">\
    </div>\
    <div class="form-buttons">\
        <input id="btn-cancel" type="button" value="Отмена">\
        <input id="btn-submit" type="button" value="Сохранить">\
    </div>';
    $('#content').html(content);

    $('#btn-cancel').on('click', function() {
        apiRequest('GET', 'notebook', list);
    });

    $('#btn-submit').on('click', function() {
        let data = {
            'name' : $('#name').val(),
            'company' : $('#company').val(),
            'phone' : $('#phone').val(),
            'email' : $('#email').val(),
            'birthday' : $('#birthday').val(),
            'photo' : $('#photo').attr('src'),
        };
        // отправка запроса
        apiRequest('POST', 'notebook', list, JSON.stringify(data));
    });

    $('#photo-select').on('change', function() {
        let file = this.files[0];
        // кодирование изображения в base64
        let reader = new FileReader();
        reader.onloadend = function() {
            // изменение изображения в браузере
            $('#photo').attr('src', reader.result);
        };
        reader.readAsDataURL(file);
    });
}

// вывод формы редактирования записи
function show(result) {
    content = '\
    <div><label>Имя:</label><input type="text" id="name"class="form_input" value="' + result['name'] + '"></div>\
    <div><label>Компания:</label><input type="text" id="company" class="form_input" value="' + result['company'] + '"></div>\
    <div><label>Телефон:</label><input type="text" id="phone" class="form_input" value="' + result['phone'] + '"></div>\
    <div><label>email:</label><input type="text" id="email" class="form_input" value="' + result['email'] + '"></div>\
    <div><label>Дата рождения:</label><input type="date" id="birthday" class="form_input" value="' + result['birthday'] + '"></div>\
    <div><label>фото:</label>\
        <div class="photo"><img id="photo" class="photo" src="' + result['photo'] + '"></div>\
        <input type="file" id="photo-select">\
    </div>\
    <div class="form-buttons">\
        <input id="btn-delete" type="button" value="Удалить">\
        <input id="btn-cancel" type="button" value="Отмена">\
        <input id="btn-submit" type="button" value="Сохранить">\
    </div>\
    ';
    $('#content').html(content);

    $('#btn-cancel').on('click', function() {
        apiRequest('GET', 'notebook', list);
    });

    $('#btn-submit').on('click', function() {
        let data = {
            'id': result['id'],
            'name' : $('#name').val(),
            'company' : $('#company').val(),
            'phone' : $('#phone').val(),
            'email' : $('#email').val(),
            'birthday' : $('#birthday').val(),
            'photo' : $('#photo').attr('src'),
        };
        // отправка запроса
        apiRequest('POST', 'notebook/' + result['id'], list, JSON.stringify(data));
    });

    $('#btn-delete').on('click', function() {
        apiRequest('post', 'notebook/delete/' + result['id'], list);
    });

    $('#photo-select').on('change', function() {
        let file = this.files[0];
        // кодирование изображения в base64
        let reader = new FileReader();
        reader.onloadend = function() {
            // изменение изображения в браузере
            $('#photo').attr('src', reader.result);
        };
        reader.readAsDataURL(file);
    });
}

$(document).ready(function() {
    // начальная загрузка списка
    apiRequest('GET', 'notebook', list);
});

{{-----------------------------------------------}}
@endsection

@section("main_content")
{{-----------------------------------------------}}
    <h1>Записная книжка</h1>
    <h2>api-интерфейс</h2>
    <div id="content" class="api-content">
    </div>
{{-----------------------------------------------}}
@endsection
