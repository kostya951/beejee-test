<?php


class DefaultController extends Controller
{
    public function index(){
        $model = new TodoListModel();
        $model->load();
        $this->render('default',['model'=>$model]);
    }
}