<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 2/25/2019
 * Time: 9:32 AM
 */
$echoYou = 'echoYou';
$echoYou2 = 'echoYou2';
$you_they_1 = array(
    'you' => "You",
    'they' => $performed_by
);

$you_they_2 = array(
    'you' => "you",
    'they' => $new_mgr_name
);
echo <<<heredoc
{$echoYou($you_they_1, $recipient_user_id)} changed the manager for $recipient_department to {$echoYou2($you_they_2, $recipient_user_id, $new_mgr_user_id)}.
heredoc;
