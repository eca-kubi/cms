<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 2/25/2019
 * Time: 9:32 AM
 */
$echoYou = 'echoYou';
echo <<<heredoc
{$echoYou($user_name)} changed the manager for $department to $mgr_name.
heredoc;
