<?php

//класс отвечающий за марщрутизацию запроса
class Router
{
    public function doRoute($config){
        //маршрут по умолчания
        $default_controller_name=$config['defaultController'];
        $default_method_name=$config['defaultMethod'];

        $use_deafult_controller = false;
        $use_default_method = false;

        //маршруты из запроса
        $routes = explode('/',$_SERVER['REQUEST_URI']);
        $controller_name = $routes[1];
        $method_name = $routes[2];

        if($controller_name==null){
            $use_deafult_controller=true;
        }

        if($method_name==null){
            $use_default_method=true;
        }

        $controller_name = $use_deafult_controller ? ucfirst($default_controller_name) : ucfirst($controller_name);
        $controller_full_name = $controller_name.'Controller';
        $controller_file = $controller_full_name.'.php';

        //подключение файла контроллера
        $path = Application::$config['require_dirs']['controllers'].'/'.$controller_file;
        if(file_exists($path)){
            include $path;
        }else{
            return [
                'ok'=>false,
                'error'=>'Не найден контроллер '.$controller_name."({$path})",
            ];
        }

        //создание контроллера и выбор метода
        $controller_instance = new $controller_full_name;
        $controller_instance->controller_name=$controller_name;
        if($use_default_method){
            $method=$default_method_name;
        }else {
            $method = $method_name;
        }

        if(method_exists($controller_instance,$method)){
            //вызываем метод контроллера для обработки запроса.
            return [
                'ok'=>true,
                'controller'=>$controller_instance,
                'method'=>$method,
            ];
        }else{
            return [
                'ok'=>false,
                'error'=>'Не существует метода '.$method.' в контроллере '.get_class($controller_instance),
            ];
        }
    }
}