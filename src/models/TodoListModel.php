<?php


class TodoListModel extends Model
{
    /**
     * @var TodoModel список тудушек
     */
    public $todoList= [];

    public function validate()
    {
        // TODO: Implement validate() method.
    }

    public function save()
    {
        // TODO: Implement save() method.
    }

    public function load($params = [])
    {
        $order_statement='ORDER BY id';
        if(isset($params['order_by'])){
           $orders = $params['order_by'];
           foreach ($orders as $field=>$direction){
            $order_statement=$order_statement.",{$field} {$direction}";
           }
        }
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
            $this->todoList[] = $model;
        }
    }
}