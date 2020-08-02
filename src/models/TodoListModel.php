<?php


class TodoListModel extends Model
{
    /**
     * @var TodoModel список тудушек
     */
    public $todoList= [];

    public function save()
    {
        // Не понадобилось сохранять список моделей
    }

    public function load($params = [])
    {
        $order_statement='';
        if(isset($params['order_by'])){
            $order_statement='ORDER BY';
            $orders = $params['order_by'];
            foreach ($orders as $field=>$direction){
                $order_statement=$order_statement." {$field} {$direction},";
            }
        }
        $order_statement=substr($order_statement,0,-1);
        $sql=<<<sql
SELECT * FROM todo
{$order_statement}
sql;

        $result_set = mysqli_query(Application::$db_connection,$sql);

        while($row=mysqli_fetch_array($result_set)){
            $model = new TodoModel();
            $model->id=$row['id'];
            $model->email=$row['email'];
            $model->description=$row['description'];
            $model->status=$row['status'];
            $model->username=$row['username'];
            $model->updated_by_admin=$row['updated_by_admin'];
            $this->todoList[] = $model;
        }
    }
}