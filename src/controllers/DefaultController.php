<?php


class DefaultController extends Controller
{
    public function index(){
        $page = 0;
        $rows = Application::$config['paginate_rows'];
        if(empty($_POST)) {
            $model = new TodoListModel();
            if(isset($_SESSION['field']) && isset($_SESSION['direction'])){
                $order_by_field=$_SESSION['field'];
                $order_by_direction=$_SESSION['direction'];
                $model->load(['order_by'=>[
                    $order_by_field=>$order_by_direction
                    ]
                ]);
            }else {
                $model->load();
            }
            $pages = ceil((count($model->todoList) / Application::$config['paginate_rows']));
            if (isset($_GET['page'])) {
                $page = Application::xssSecure($_GET['page']) - 1;
            }
        }else{
            $page=Application::xssSecure($_POST['page'])-1;
            $order_by_field = Application::xssSecure($_POST['field']);
            $order_by_direction = Application::xssSecure($_POST['direction']);
            $_SESSION['field']=$order_by_field;
            $_SESSION['direction']=$order_by_direction;
            $model = new TodoListModel();
            $model->load(['order_by'=>[
                    $order_by_field=>$order_by_direction
                ]
            ]);
            $pages = ceil((count($model->todoList) / Application::$config['paginate_rows']));
        }
        $model->todoList = array_slice($model->todoList,$page*$rows,$rows);

        $this->render('default', ['model' => $model, 'pages' => $pages, 'page' => $page + 1]);
    }
}