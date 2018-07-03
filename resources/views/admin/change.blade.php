@extends('layers.layer')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-5 mt-5">
                <h4>Просмотр/редактирование материала</h4>
                <label for="title" class="mt-3">Заголовок</label>
                <input type="text" id="title" class="form-control" value="{{ $material->title }}">
                <hr />
                <label for="description" class="">Описание</label>
                <textarea name="" id="description" cols="30" rows="10" class="form-control">{{ $material->description }}
                </textarea>
                <label for="statuss">Статус</label>
                <select name="" id="statuss" class="form-control">
                    <option>Опубликовано</option>
                    <option selected>Не опубликовано</option>
                </select>
                <button class="form-control btn btn-success mt-3">Изменить</button>
            </div>
            <div class="col-6 mt-5 ml-3">
                    <h4>Комментарии к материалу</h4>
                    <div class="comments ">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        checkComment();
        function checkComment() {
            $.ajax({
                url: '/viewComment',
                type: "POST",
                async:false,
                data: {
                    parent_id: "{{ $material->id }}"
                },
                success: function (data) {
                    $("div.comment").remove();
                    for (var i = 0; i < data.length; i++) {
                        var newElems = $("<div class='comment mt-2 '></div>")
                            .append("<p>" + "Комментарий № " + data[i].number + "</p>")
                            .append("<p>" + data[i].created_at + "</p>")
                            .append("<textarea cols='30' rows='4' class='form-control comment'>"+data[i].comment+"</textarea>")
                            .append("<button id='changeComment' data-change="+data[i].id+" class='btn btn-primary mt-2 changeComment'>    Редактировать </button>" + "<button id='deleteComment' data-remove=" + data[i].id + " class='btn btn-danger mt-2 ml-3 deleteComment'> Удалить </button>")
                            .append("<hr />");
                        $('.comments').append(newElems);
                    }
                },
                error: function (msg) {
                    alert("Ошибка");
                }
            });
        }

    $('.changeComment').click(function(e){
        var commentId = e.currentTarget.dataset.change;
        var comment = $(e.target).siblings('textarea').val();

        $.ajax({
            url: '/changeComment',
            type: "POST",
            async:false,
            headers: {
                'X-Csrf-Token': $('meta[name="csrf-token"]').attr('content')
            },
            data:{
                id : commentId,
                comment : comment
            },
            success: function(data){
                setTimeout( 'location="/change-material/{{ $material->id }}";', 300);
            },
            error: function(msg){
                alert('Ошибка');
        }
        });
    });
        $('.deleteComment').click(function(e){
            var commentId = e.currentTarget.dataset.remove;

            $.ajax({
                url: '/removeComment',
                type: "POST",
                async:false,
                headers: {
                    'X-Csrf-Token': $('meta[name="csrf-token"]').attr('content')
                },
                data:{
                    id : commentId
                },
                success: function(data){
                    setTimeout( 'location="/change-material/{{ $material->id }}";', 300);
                },
                error: function(msg){
                    alert('Ошибка');
                }
            });
        });




    </script>
@endsection