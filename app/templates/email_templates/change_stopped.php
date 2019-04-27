<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 2/25/2019
 * Time: 9:32 AM
 */
$echoYou = 'echoYou';
$youThey = array(
    'you' => 'you',
    'they' => $performed_by
);
echo <<<heredoc
Change procedure ($subject) has been stopped by {$echoYou($youThey, $recipient_user_id)}.
heredoc;
