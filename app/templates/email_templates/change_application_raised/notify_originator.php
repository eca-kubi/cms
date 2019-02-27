<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 2/25/2019
 * Time: 1:23 PM
 */
$echoYou = 'echoYou';

echo <<<heredoc
Hi $recipient,
You have raised a Change Proposal application.
Click this link for details: <a href="$link">$link</a>
heredoc;
