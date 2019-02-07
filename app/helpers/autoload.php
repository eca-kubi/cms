<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 2/6/2019
 * Time: 7:35 PM
 * Simple Autoloader for especially scripts to run on command line
 */
spl_autoload_register(function ($class_name) {
    $dirs = array(
        '../models',
        '../libraries/',
        '../classes/'
    );
    foreach ($dirs as $dir) {
        if (!file_exists('../app/' . $dir . $class_name . '.php')) {
            continue;
        } else {
            require_once('../app/' . $dir . $class_name . '.php');
        }
    }
});
require_once '../../vendor/autoload.php';