<?php


class Application
{
    /**
     * @var array конфигурация
     */
    public static $config;

    /**
     * @var mysqli подключение к базе данных
     */
    public static $db_connection;

    /**
     * обработка запроса
     * @param $config
     */
    public function run($config){
        self::$config=$config;

        //инициализация подклчюения к БД
        try {
            self::initDatabaseConnection();
        }catch (DatabaseException $e){
            $this->error($e->getMessage());
            exit();
        }

        //маршрутизация запроса
        $router = new Router();
        $controller = $router->doRoute($config['route']);

        if($controller['ok']) {
            $controller_instance=$controller['controller'];
            $method=$controller['method'];
            try {
                $controller_instance->$method();
            }catch (ViewNotFoundException $e){
                $this->error($e->getMessage());
                exit();
            }catch (Exception $e){
                $this->error($e->getMessage());
                exit();
            }
        }else{
            $this->error($controller['error']);
            exit();
        }
    }

    private function error($message)
    {
        header('HTTP/1.1 500 Internal Server Error');
        header("Status: 500 Internal Server Error");
        echo $message;
    }

    private static function initDatabaseConnection(){
        $db = self::$config['db'];
        self::$db_connection = mysqli_connect($db['host'],$db['username'],$db['password'],$db['database_name'],$db['port']);
        if(self::$db_connection==false){
            throw new DatabaseException("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
        }
    }
}