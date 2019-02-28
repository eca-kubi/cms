<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 2/25/2019
 * Time: 9:32 AM
 */
$you_they = array(
    'you' => 'You have',
    'they' => $performed_by . ' has'
);
$echoYou = 'echoYou';
echo <<<heredoc
{$echoYou($you_they, $user_id)} raised a Change Proposal application ($subject). <br>
Click this link for details: <a href="$link">$link</a>
heredoc;


