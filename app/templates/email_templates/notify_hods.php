<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 2/25/2019
 * Time: 1:23 PM
 */
$echoYou = 'echoYou';
$you_they = array(
    'you' => 'you',
    'they' => $originator
);
echo <<<heredoc
Hi $recipient_name,
your input is required to complete the impact assessment for your department ($recipient_department) 
for this Change Implementation Procedure ($subject) raised by {$echoYou($you_they, $user_id)}. <br>
Click this link for details: <a href="$link">$link</a>
heredoc;
