<div class="d-lg-flex justify-content-center align-items-center">
    <div class="w-25">
        <form method="post">
            <div class="form-group">
                <label for="login">Логин</label>
                <input id="login" class="form-control" type="text" name="login">
                <span id="login-error" style="color:red"></span>
            </div>
            <div class="form-group">
                <label for="password">Пароль</label>
                <input id="password" class="form-control" type="password" name="password">
                <span id="password-error" style="color:red"></span>
            </div>
            <button type="submit" class="btn btn-primary">Войти</button>
        </form>
        <div class="error" style="color: red"><?=isset($error)?$error:''?></div>
    </div>
</div>
<script>
    //валидация полей
    $('form').submit(function (event) {
        var login = $('#login').val();
        var password = $('#password').val();
        $('#login-error').text('');
        $('#password-error').text('');
        if(login.length<1){
            event.preventDefault();
            $('#login-error').text("Логин должен быть не пустым");
            return;
        }

        if(password.length<1){
            event.preventDefault();
            $('#password-error').text("Пароль должен быть не пустым");
            return;
        }
    })
</script>
