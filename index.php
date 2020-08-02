<?php
$config = require('config.php');

$splFunction=function($className) use ($config){
    $dirs = $config['require_dirs'];
    foreach ($dirs as $dir){
        $file = $dir.'/'.$className.'.php';
        if(file_exists($file)){
            require_once $file;
            return;
        }
    }
};
spl_autoload_register($splFunction);


(new Application())->run($config);
