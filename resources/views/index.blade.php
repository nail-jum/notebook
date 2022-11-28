@extends("layouts.main")
@section("main_content")
{{-----------------------------------------------}}
    <h1>Записная книжка</h1>

    <div class="content">
        <table class="text-list">
            <tr>
                <th>id</th>
                <th>имя</th>
                <th>компания</th>
                <th>телефон</th>
                <th>email</th>
                <td>дата рожд.</td>
                <td>фото</td>
                <td colspan=2 class="center"><a href={{url('/add')}}>Добавить контакт</a></td>
            </tr>

            @foreach ($rowList as $row)
            <tr>
                <td>{{$row->id}}</td>
                <td>{{$row->name}}</td>
                <td>{{$row->company}}</td>
                <td>{{$row->phone}}</td>
                <td>{{$row->email}}</td>
                <td>{{$row->birthday}}</td>
                <td>{{($row['photo'] && $row['photo'] != 'null' ? 'есть' : 'нет')}}</td>
                <td><a href="edit/{{$row->id}}">Редактировать</a></td>
                <td><a href="delete/{{$row->id}}">Удалить</a></td>
            </tr>
            @endforeach

        </table>
    </div>
{{-----------------------------------------------}}
@endsection
