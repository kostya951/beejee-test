<div class="row">
    <div class="col text-right">
        <a href="/login/index">Авторизация</a>
    </div>
</div>
<div class="row">
    <table class="table">
        <thead>
            <td scope="col">Id</td>
            <td scope="col">Пользователь</td>
            <td scope="col">Описание</td>
            <td scope="col">E-Mail</td>
            <td scope="col">Статус</td>
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
                        <td><?=$todo->status=='0'?'Не выполнена':'Выполнена'?></td>
                    </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
</div>