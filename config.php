<?php
return [
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
    'require_dirs'=>[
        'controllers'=>'src/controllers',
        'core'=> 'src/core',
        'models'=>'src/models'
    ],

];