<?php
return [
    'users'=>[
        [
            'login'=>'admin',
            'password'=>'123'
        ],
    ],
    'webroot'=>'/',//нужно указать корень например /root/ (обязательно слэш на конце и просто слэш для пустого корня)
    'route'=>[
        'defaultController'=>'Default',
        'defaultMethod'=>'index'
    ],
    'db'=>[
        'host'=>'localhost',
        'port'=>'3306',
        'username'=>'kostya951',
        'password'=>'iceHOT951',
        'database_name'=>'kostya951',
    ],
    'path'=>[
        'layout'=>'src/views/layout.php',
        'views'=>'src/views/'
    ],
    //директории для автозагрузки классов
    'require_dirs'=>[
        'controllers'=>'src/controllers',
        'core'=> 'src/core',
        'models'=>'src/models'
    ],
    //количество записей на одну страницу
    'paginate_rows'=>3,

];