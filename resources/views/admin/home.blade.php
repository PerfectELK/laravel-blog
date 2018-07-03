<? Cookie::get('login');
?>
@extends('layers.layer')
@section('content')
    <!-- Модальное окно -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="title">Заголовок</label>
                    <input type="text" id="title" class="form-control">
                    <label for="description">Описание</label>
                    <textarea  id="description" cols="30" rows="10" class="form-control"></textarea>
                    <label for="statuss">Статус</label>
                    <select name="" id="statuss" class="form-control">
                        <option>Опубликовано</option>
                        <option selected>Не опубликовано</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <p class="data-text"></p>
                    <button type="button" class="btn btn-primary add">Добавить</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Добавить материал</button>
                <a href="/logout" class="btn btn-dark mb-3 mt-2" style="float:right;">Выйти</a>
                <table class="table">
                    <thead class="thead-dark">
                    <th>Id</th>
                    <th>Date change</th>
                    <th>Status</th>
                    <th>Title</th>
                    <th>Delete</th>
                    </thead>
                    <tbody>
                    @foreach($materials as $material)
                    <tr>
                        <td>{{ $material->id }}</td>
                        <td>{{ $material->updated_at }}</td>
                        <td>{{ $material->status }}</td>
                        <td><a href="/change-material/{{ $material->id }}" class="btn-link">{{ $material->title }}</a></td>
                        <td>
                            <form action="/delete/{{ $material->id }}" method="post">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger">Удалить</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('.add').click(function(){
           $.ajax({
               url: '/create',
               type: "POST",
               headers: {
                   'X-Csrf-Token': $('meta[name="csrf-token"]').attr('content')
               },
               data: {
                   title: $('#title').val(),
                   description : $('#description').val(),
                   status: $('#statuss').val()
               },
               success: function (data) {
                    $('.data-text').html(data);
                    setTimeout( 'location="/admin";', 500);
               },
               error: function (msg) {
                   alert("Ошибка");
               }
           });
        });

    </script>
@endsection
