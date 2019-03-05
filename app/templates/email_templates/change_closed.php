<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 2/25/2019
 * Time: 9:32 AM
 */
$echoYou = 'echoYou';
$youThey = array(
    'you' => 'You have',
    'they' => $performed_by . "($role) has"
);
echo <<<heredoc
{$echoYou($youThey, $recipient_user_id)} closed the project for the Change Proposal ($subject). </br>
Click this link for more details: $link
heredoc;
