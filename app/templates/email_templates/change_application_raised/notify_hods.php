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
A Change Proposal application has been raised by {$echoYou($user_id, $originator)}.
Click this link for details: <a href="$link">$link</a>
heredoc;
