<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 2/25/2019
 * Time: 9:32 AM
 */
$echoYou = 'echoYou';
echo <<<heredoc
Change procedure ($subject) has been approved by {$echoYou($performed_by, $user_id)}.
Click this link for more details: <a href="$link">$link</a>
heredoc;
