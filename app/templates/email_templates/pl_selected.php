<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 2/25/2019
 * Time: 9:32 AM
 */
$echoYou = 'echoYou';
echo <<<heredoc
Hi $project_leader,
$project_owner has selected you as Project Leader for Change Application ($subject).
Click this link for more details: <a href="$link">$link</a>
heredoc;
