@extends('layers.layer')
@section('content')
    <div class="container center-block">
        <div class="row">
            <div class="col-6 text-center" style="margin: 25% auto;">
                <div class="error-report" style="height: 30px; color:#ff0905; font-size: 20px;">
                    <?if(isset($_SESSION['errors'])){ foreach ($_SESSION['errors'] as $error):?>
                    <? echo $error;?>
                    <? endforeach; }?>
                </div>
                <form action="/confirm" method="post" class="form-control">
                    <h3>Административный интерфейс</h3>
                    {{ csrf_field() }}
                    <label for="name">Имя Пользователя</label>
                    <input type="text" name="name" class="form-control">
                    <label for="pass">Пароль</label>
                    <input type="password" name="password" class="form-control">
                    <button type="submit" class="btn btn-primary mt-3 btn-lg">Войти</button>
                </form>
            </div>
        </div>
    </div>
    <?php if(isset($_SESSION['errors'])){unset($_SESSION['errors']);}?>
@endsection