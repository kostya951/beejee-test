<div class="d-lg-flex justify-content-center align-items-center">
    <div class="w-25">
        <form method="post">
            <div class="form-group">
                <label for="username">Имя пользователя</label>
                <input id="username"  class="form-control" type="text" name="username">
                <small>Только латинские буквы без спец символов длиной от 3 до 21 символов</small>
                <span id="username-error" style="color:red"></span>
            </div>
            <div class="form-group">
                <label for="description">Описание задачи</label>
                <textarea id="description" class="form-control" name="description" rows="10" cols="50"></textarea>
                <small>От 1 до 500 символов</small>
                <span id="description-error" style="color:red"></span>
            </div>
            <div class="form-group">
                <label for="email">E-Mail</label>
                <input id="email" class="form-control" type="email" name="email">
                <small>Валидный email адресс</small>
                <span id="email-error" style="color:red"></span>
            </div>
            <button class="btn btn-primary" type="submit">Создать</button>
        </form>
    </div>
</div>
<script>
    //валидация полей
    $('form').submit(function (event) {
        var username = $('#username').val();
        var description = $('#description').val();
        var email = $('#email').val();

        $('#username-error').text('');
        $('#description-error').text('');
        $('#email-error').text('');

        if(username.length>21 || username.length<3){
            event.preventDefault();
            $('#username-error').text("Ошибка валидации имени пользователя");
            return;
        }


        var result = username.match(/^[a-zA-Z]+/);
        if(!result){
            event.preventDefault();
            $("#username-error").text("Ошибка валидации имени пользователя");
            return;
        }

        if(description.length<1 || description.length>500){
            event.preventDefault();
            $('#description-error').text('Ошибка валидации описания');
            return;
        }

        if(email.length==0){
            event.preventDefault();
            $('#email-error').text('Ошибка валидации email');
            return;
        }

        result = email.match(/\w+@\w+\.\w+/);
        if(!result){
            event.preventDefault();
            $('#email-error').text('Ошибка валидации email');
            return;
        }
        this.submit();
    })
</script>
