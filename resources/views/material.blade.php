@extends('layers.layer')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 center-block mt-5">
                <h2>Просмотр материала {{ $material->title }}</h2>
                <hr />
            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-4">
                <h5><strong> {{ $material->description }} </strong></h5>
                <hr />
            </div>
        </div>
        <div class="row">
            <div class="col-6 mt-5">
                <h4>Комментарии к материалу</h4>
                <div class="comments ">

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-5">
                <button class="btn btn-primary add">Добавить комментарий</button>
            </div>
        </div>
        <div class="row">
            <div class="col-6 add-form mt-5" style="display:none;">
                <label for="comment_input">Комментарий:</label>
                <input type="text" class="form-control" id="comment_input">
                <button class="btn btn-primary add_comment mt-3">Добавить</button>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript" >
        function checkComment() {
            $.ajax({
                url: '/viewComment',
                type: "POST",
                data: {
                    parent_id: "{{ $material->id }}"
                },
                success: function (data) {
                        $("div.comment").remove();
                    for (var i = 0; i < data.length; i++) {
                        var newElems = $("<div class='comment mt-2 '></div>")
                            .append("<p>" + "Комментарий № " + data[i].number + "</p>")
                            .append("<p>" + data[i].created_at + "</p>")
                            .append("<h5>" + data[i].comment + "</h5>")
                            .append("<hr />");
                        $('.comments').append(newElems);
                    }
                },
                error: function (msg) {
                    alert("Ошибка");
                }
            });
        }
        var counter = 0;
        $('.add').click(function(){
            counter++;
            if(counter % 2 != 0){
                $('.add-form').css({
                    'display':'block'
                });
            } else{
                $('.add-form').css({
                    'display':'none'
                });
            }
        });
        checkComment();
        var commentInput = document.getElementById('comment_input');

        if(commentInput.value == ""){
            $('.add_comment').attr('disabled', true);
        }
        commentInput.onkeyup = function(){
            if(commentInput.value == ""){
                $('.add_comment').attr('disabled', true);
            } else{
                $('.add_comment').attr('disabled', false);
            }
        };

        $('.add_comment').click(function(){
            $.ajax({
                url: '/addComment',
                type: 'POST',
                data: {
                  comment :  $('#comment_input').val(),
                  parent_id :  "{{ $material->id }}"
                },
                success: function (data) {
                    checkComment();
                    $('#comment_input').val('');
                },
                error: function (msg) {
                    alert('Ошибка');
                }
            });
        });
    </script>
@endsection


