<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 2/25/2019
 * Time: 9:32 AM
 */
echo <<<heredoc
{$echoYou($originator, $user_id)} have raised a Change Proposal application ($subject). <br>
Click this link for details: <a href="$link">$link</a>
heredoc;


