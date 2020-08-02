<div class="row">
    <div class="col text-left">
        <a class="btn btn-success" href="<?php echo Application::$config['webroot']?>todo/create">Создать</a>
    </div>
    <div class="col text-right">
        <?php
            $webroot=Application::$config['webroot'];
            if(isset($_COOKIE['logged']) && $_COOKIE['logged']==1){
                echo "<a class='btn btn-primary' href='{$webroot}login/logout'>Выйти</a>";
            }else{
                echo "<a class='btn btn-primary' href='{$webroot}login/index'>Авторизация</a>";
            }
        ?>
    </div>
</div>
<div class="row">
    <form method="post">
        <div class="row">
            <div class="col">
                <select class="form-control" name="field">
                    <option value="username">По имени пользователя</option>
                    <option value="email">По E-Mail</option>
                    <option value="status">По статусу</option>
                </select>
            </div>
            <div class="col">
                <select class="form-control" name="direction">
                    <option value="ASC">По возрастанию</option>
                    <option value="DESC">По убыванию</option>
                </select>
            </div>
            <input type="text" value="<?=$page?>" name="page" readonly style="display: none">
            <div class="col">
                <button class="btn btn-secondary" type="submit">Сортировать</button>
            </div>
        </div>
    </form>
</div>
<div class="row">
    <table class="table">
        <thead>
            <td scope="col">Id</td>
            <td scope="col">Пользователь</td>
            <td scope="col">Описание</td>
            <td scope="col">E-Mail</td>
            <td scope="col">Статус</td>
            <?php
            if(isset($_COOKIE['logged']) && $_COOKIE['logged']==1){
                echo "<td>Действие</td>";
            }
            ?>
        </thead>
        <tbody>
            <?php
                foreach ($model->todoList as $todo){
            ?>
                    <tr>
                        <td><?=$todo->id?></td>
                        <td><?=$todo->username?></td>
                        <td><?=$todo->description?></td>
                        <td><?=$todo->email?></td>
                        <td><?=$todo->status=='0'?'Не выполнена':'Выполнена'?><br>
                            <?=$todo->updated_by_admin==1? 'Обновлена администратором' : ''?>
                        </td>
                        <?php
                            if(isset($_COOKIE['logged']) && $_COOKIE['logged']==1){
                                echo "<td><a href='{$webroot}todo/edit?id={$todo->id}'>Редактировать</a></td>";
                            }
                        ?>
                    </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
    <ul class="pagination">
        <?php
            if($page!=1) {
                $prev = $page-1;
                echo "<li class='page-item'><a class='page-link' href='{$webroot}default/index?page={$prev}'>Предыдущая</a></li>";
            }
        ?>
        <?php
            for($i=1; $i<=$pages;$i++){
                $active = $i==$page? 'active': '';
                echo "<li class='page-item {$active}'><a class='page-link' href='{$webroot}default/index?page={$i}'>{$i}</a></li>";
            }
        ?>
        <?php
        if($page<$pages) {
            $next = $page+1;
            echo "<li class='page-item'><a class='page-link' href='{$webroot}default/index?page={$next}'>Следующая</a></li>";
        }
        ?>
    </ul>
</div>
<script>

</script>