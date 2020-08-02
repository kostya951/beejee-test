<?php


class TodoController extends Controller
{
    public function create(){
        if(empty($_POST)){
            $this->render('create');
        }else if(!empty($_POST)){
            $model = new TodoModel();
            $model->username=Application::xssSecure($_POST['username']);
            $model->description=Application::xssSecure($_POST['description']);
            $model->email=Application::xssSecure($_POST['email']);
            $model->status=0;
            try {
                $model->save();
                $this->render('success-create');
            }catch (DatabaseException $e){
                $this->render('error-create',['error'=>$e]);
            }
        }
    }

    public function edit(){
        if(isset($_COOKIE['logged']) && $_COOKIE['logged']==1){
            if(empty($_POST)){
                $id =Application::xssSecure($_GET['id']);
                $model = new TodoModel();
                $model->load(['id'=>$id]);
                $_SESSION['description']=$model->description;
                print_r($_SESSION);
                try {
                    $this->render('edit', ['model' => $model]);
                }catch (ViewNotFoundException $e){
                    $this->render('error-create',['error'=>$e]);
                }
            }else{
                $model = new TodoModel();
                $model->id =Application::xssSecure($_POST['id']);
                $model->description=Application::xssSecure($_POST['description']);
                $model->status =Application::xssSecure($_POST['status']);
                $model->updated_by_admin=Application::xssSecure($_POST['updated_by_admin']);
                if(isset($_SESSION['description'])){
                    $new_description = $model->description;
                    $old_description=$_SESSION['description'];
                    if($model->updated_by_admin!=1) {
                        $model->updated_by_admin = strcmp($old_description, $new_description) == 0 ? 0 : 1;
                    }
                    try {
                        $model->save();
                        $this->render('success-create');
                    }catch (DatabaseException $e){
                        $this->render('error-create',['error'=>$e]);
                    }
                }
            }
        }else{
            echo "Доступ запрещён!";
        }
    }
}