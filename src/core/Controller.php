<?php


class Controller
{
    /**
     * @var string имя контроллера
     */
    public $controller_name;

    /**
     * @param $viewName string имя представления для поиска в доступных представлениях
     * @param array $params
     */
    public function render($viewName,$params=null){
        $layout = Application::$config['path']['layout'];
        $path=Application::$config['path']['views'].lcfirst($this->controller_name).'/'.$viewName.'.php';
        if(file_exists($layout)) {
            if (file_exists($path)) {
                if (is_array($params)) {
                    extract($params);
                }
                ob_start();
                require $path;
                $content = ob_get_clean();
                include $layout;
            } else {
                throw new ViewNotFoundException('Предсталение ' . $viewName .
                    ' контроллера ' . $this->controller_name . ' не найдено!' . "({$path})");
            }
        }else{
            throw new ViewNotFoundException("Шаблон layout.php не найден по пути {$layout}");
        }
    }

}