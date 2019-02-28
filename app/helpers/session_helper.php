<?php
session_start();

// Flash message helper
// EXAMPLE - flash('register_success', 'You are now registered');
// DISPLAY IN VIEW - echo flash('register_success');
function flash($name = 'flash', $message = '', $class = 'alert alert-success alert-dismissible text-sm', $dismissible_button = '<button type="button" class="close" data-dismiss="alert" style="position: absolute;top: 10%;left: 95%;" aria-label="Close"><span aria-hidden="true" >&times;</span><span class="sr-only">Close</span></button>')
{
    $name = str_replace('-', '_', $name);
    if (!empty($name)) {
        if (!empty($message) && empty($_SESSION[$name])) {
            if (!empty($_SESSION[$name])) {
                unset($_SESSION[$name]);
            }

            if (!empty($_SESSION[$name . '_class'])) {
                unset($_SESSION[$name . '_class']);
            }

            if (!empty($_SESSION[$name . '_dismissible_button'])) {
                unset($_SESSION[$name . '_dismissible_button']);
            }

            $_SESSION[$name] = $message;
            $_SESSION[$name . '_class'] = $class;
            $_SESSION[$name . '_dismissible_button'] = $dismissible_button;
        } elseif (empty($message) && !empty($_SESSION[$name])) {
            $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';
            $dismissible_button = !empty($_SESSION[$name . '_dismissible_button']) ? $_SESSION[$name . '_dismissible_button'] : '';
            //echo '<div class="' . $class . '" id="msg-flash">' . $_SESSION[$name] . '</div>';
            echo <<<alert
        <div class="p-2">
        <div class="$class col-md-10 m-auto" role="alert">
        $dismissible_button
        <strong>$_SESSION[$name]</strong>
        </div>
        </div>
alert;
            unset($_SESSION[$name]);
            unset($_SESSION[$name . '_class']);
            unset($_SESSION[$name . '_dismissible_button']);
        }
    }
}


function isLoggedIn()
{
    if (isset($_SESSION['logged_in_user'])) {
        return true;
    } else {
        return false;
    }
}

function getRole()
{
    return getUserSession()->role;
}

/**
 * Summary of getUserSession
 * @return User|bool
 */
function getUserSession()
{
    if (isset($_SESSION['logged_in_user'])) {
        return $_SESSION['logged_in_user'];
    } else {
        return false;
    }
}

function createUserSession(User $u)
{
    //unset($u->password);
    $_SESSION['logged_in_user'] = $u;
}

function createAdminSession($user)
{
    unset($user->password);
    $_SESSION['logged_in_admin'] = $user;
    adminSessionOn();
}

function createReviewerSession($user)
{
    unset($user->password);
    $_SESSION['logged_in_reviewer'] = $user;
    reviewSessionOn();
}

function logout()
{
    unset($_SESSION['logged_in_user']);
    session_destroy();
    redirectToStart();
}

function destroySession()
{
    unset($_SESSION['logged_in_user']);
    session_destroy();
    session_start();
}

function adminSessionOn()
{
    $_SESSION['admin_session'] = true;
}

function adminSessionOff()
{
    unset($_SESSION['admin_session']);
}

/**
 * Summary of isAdminSessionOn
 * @return boolean
 */
function isAdminSessionOn()
{
    return !empty($_SESSION['admin_session']);
}

/*
function isAdmin($staff_id) {
    $role = Database::getDbh()->where('staff_id', $staff_id)->getValue('users', 'role');
    return in_array($role, ADMINS);
}

function isReviewer($staff_id) {
    $role = Database::getDbh()->where('staff_id', $staff_id)->getValue('users', 'role');
    return in_array($role, REVIEWERS);
}*/

function reviewSessionOn()
{
    $_SESSION['review_session'] = true;
}

function reviewSessionOff()
{
    unset($_SESSION['review_session']);
}

/**
 * Summary of isAdminSessionOn
 * @return boolean
 */
function isReviewSessionOn()
{
    return !empty($_SESSION['review_session']);
}

/**
 * Reviewer must not review him/herself
 */
function excludeReviewer()
{
    Database::getInstance()->where('u.user_id', getUserSession()->user_id, '<>');
    return Database::getInstance();
}

?>

