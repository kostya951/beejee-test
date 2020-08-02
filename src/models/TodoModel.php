<?php


class TodoModel extends Model
{
    public $id;
    public $username;
    public $email;
    public $description;
    public $status;
    public $updated_by_admin=0;
    public function save()
    {
        if($this->id==null) {
            $sql = <<<sql
INSERT INTO todo(username,description,email,status,updated_by_admin)
VALUES ('{$this->username}','{$this->description}','{$this->email}',{$this->status},{$this->updated_by_admin})
sql;
            $result = mysqli_query(Application::$db_connection, $sql);

            if (!$result) {
                throw new DatabaseException("Ошибка создания туду " . mysqli_error(Application::$db_connection));
            }
        }else{
            $sql=<<<sql
UPDATE todo SET description='{$this->description}', status={$this->status},updated_by_admin={$this->updated_by_admin}
WHERE id={$this->id}
sql;
            $result = mysqli_query(Application::$db_connection, $sql);
            echo $result;
            if (!$result) {
                throw new DatabaseException("Ошибка обновления туду " . mysqli_error(Application::$db_connection));
            }

        }
    }

    public function load($params =[])
    {
        $sql=<<<sql
SELECT id,description,status,updated_by_admin
FROM todo
WHERE id={$params['id']};
sql;
        $result_set = mysqli_query(Application::$db_connection,$sql);
        $row=mysqli_fetch_array($result_set);
        $this->id=$row['id'];
        $this->description=$row['description'];
        $this->status=$row['status'];
        $this->updated_by_admin=$row['updated_by_admin'];
    }
}