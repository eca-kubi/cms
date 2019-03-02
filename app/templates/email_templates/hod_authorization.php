<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 2/25/2019
 * Time: 9:32 AM
 */
$echoYou = 'echoYou';
$you_they = array(
    'you' => 'You have',
    'they' => $performed_by . " has"
);

echo <<<heredoc
{$echoYou($you_they, $performed_by)} authorized this Change Proposal ($subject) for implementation. <br>
Click this link for more details: <a href="$link">$link</a>
heredoc;
