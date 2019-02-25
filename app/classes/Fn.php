<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 2/25/2019
 * Time: 10:02 AM
 */

class Fn
{
    public function __call($name, $args)
    {
        if (function_exists($name)) {
            return call_user_func_array($name, $args);
        }
    }
}