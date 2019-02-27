<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 2/25/2019
 * Time: 9:32 AM
 */
$echoYou = 'echoYou';
echo <<<heredoc
$project_owner has selected $project_leader as Project Leader for Change Application ($subject).
Click this link for more details: <a href="$link">$link</a>
heredoc;
