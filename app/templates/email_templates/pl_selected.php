<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 2/25/2019
 * Time: 9:32 AM
 */
$echoYou = 'echoYou';
echo <<<heredoc
$project_owner has selected you as Project Leader for Change Application ($subject).
Click this link to accept: <a href="$link">$link</a>
heredoc;
