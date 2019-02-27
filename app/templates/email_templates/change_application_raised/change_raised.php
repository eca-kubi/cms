<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 2/25/2019
 * Time: 9:32 AM
 */
if ($user_id === getUserSession()->user_id) {
    echo <<<heredoc
Change procedure ($subject) has been raised by {$performed_by}.
heredoc;
} else {

}

