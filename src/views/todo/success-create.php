<div class="row">
    Туду успешно сохранена/обновлена в БД!Вы будете переадресованы на главную страницу через 3 сек!
</div>
<script>
    setTimeout(function () {
        document.location.replace('<?php echo Application::$config['webroot']?>default/index');
    },3000)
</script>
