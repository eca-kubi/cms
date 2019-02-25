<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 2/25/2019
 * Time: 1:23 PM
 */
if ($originator_id) {

}
echo <<<heredoc
Hi  . $recipient,
A Change Proposal application has been raised by $originator.
Click this link for details: <a href="$link">$link</a>
heredoc;
