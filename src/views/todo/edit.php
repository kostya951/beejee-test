<div class="d-lg-flex justify-content-center align-items-center">
    <div class="w-25">
        <form method="post">
            <div class="form-group">
                <label for="id">Id</label>
                <input id="id" class="form-control" type="text" value="<?=$model->id?>" name="id" readonly>
            </div>
            <div class="form-group">
                <label for="description">Описание</label>
                <textarea id="description" class="form-control" type="text" name="description" rows="10" cols="50"><?=$model->description?></textarea>
            </div>
            <div class="form-group">
                <label for="status">Статус</label>
                <select id="status" class="form-control" name="status">
                    <?php
                        $status = $model->status;
                        if($status==0){
                            echo '<option value="0" selected>Не выполнена</option>';
                            echo '<option value="1">Выполнена</option>';
                        }else if($status==1){
                            echo '<option value="0">Не выполнена</option>';
                            echo '<option value="1" selected>Выполнена</option>';
                        }
                    ?>
                </select>
            </div>
            <input type="text" readonly style="display: none" name="updated_by_admin" value="<?=$model->updated_by_admin?>">
            <button type="submit" class="btn btn-primary">Изменить</button>
        </form>
    </div>
</div>