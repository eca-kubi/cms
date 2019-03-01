<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 2/25/2019
 * Time: 9:32 AM
 */
$echoYou = 'echoYou';

echo <<<heredoc
Hi $recipient_name, this Change Proposal ($subject) owned by $hod requires your approval as GM.
Click this link for more details: <a href="$link">$link</a>
heredoc;
