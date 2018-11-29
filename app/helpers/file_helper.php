<?php
function uploadAttachment($file, $user_id)
{
    $result['success'] =false;
    $result['file'] = '';
    $allowedExts = array('doc', 'docx', 'pdf', 'xlsx', 'txt');
    $temp = explode('.', $_FILES[$file]['name']);
    $extension = end($temp);
    if ($_FILES[$file]['size'] > 0) {
        // $filename = $_FILES[$file]['name'];
        // $filename = explode('/', $filename);
        // $filename = end($filename);
        if ((($_FILES[$file]['type'] == ' application/vnd.openxmlformats-officedocument.wordprocessingml.document')
            || ($_FILES[$file]['type'] == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
            || ($_FILES[$file]['type'] == 'application/msword')
            || ($_FILES[$file]['type'] == 'application/pdf')
            || ($_FILES[$file]['type'] == 'txt/plain')
          )
            && in_array($extension, $allowedExts)) {
            if ($_FILES[$file]['error'] > 0) {
                // echo 'Return Code: ' . $_FILES['file']['error'] . '<br>';
                $result['success'] = false;
                $result['reason'] = 'An error occured while uploading file';
            } else {
                //$filename = $_FILES[$file]['name'];
                $ret = move_uploaded_file($_FILES[$file]['tmp_name'], APP_ROOT . '\..\public\assets\images\profile_pics\\' . $user_id . '.' . $extension);
                $result['success'] = $ret;
                $result['file'] = $staff_id . '.' . $extension;
                if ($ret) {
                    return $result;
                }
                $result['reason'] = 'Unknown';
                return $result;
            }
        } else {
            $result['success'] = false;
            $result['reason'] = 'The type of file uploaded is not supported';
        }
        return $result;
    } else {
        $result['success'] =true;
        return $result;
    }
}

function uploadProfilePic($file, $staff_id)
{
    $result['success'] =false;
    $result['file'] = '';
    $allowedExts = array('gif', 'jpeg', 'jpg', 'png');
    $temp = explode('.', $_FILES[$file]['name']);
    $extension = end($temp);
    if ($_FILES[$file]['size'] > 0) {
        // $filename = $_FILES[$file]['name'];
        // $filename = explode('/', $filename);
        // $filename = end($filename);
        if ((($_FILES[$file]['type'] == 'image/gif')
            || ($_FILES[$file]['type'] == 'image/jpeg')
            || ($_FILES[$file]['type'] == 'image/jpg')
            || ($_FILES[$file]['type'] == 'image/pjpeg')
            || ($_FILES[$file]['type'] == 'image/x-png')
            || ($_FILES[$file]['type'] == 'image/png'))
            && in_array($extension, $allowedExts)) {
            if ($_FILES[$file]['error'] > 0) {
                // echo 'Return Code: ' . $_FILES['file']['error'] . '<br>';
                $result['success'] = false;
                $result['reason'] = 'An error occured while uploading file';
            } else {
                //$filename = $_FILES[$file]['name'];
                $ret = move_uploaded_file($_FILES[$file]['tmp_name'], APP_ROOT . '\..\public\assets\images\profile_pics\\' . $staff_id . '.' . $extension);
                $result['success'] = $ret;
                $result['file'] = $staff_id . '.' . $extension;
                if ($ret) {
                    return $result;
                }
                $result['reason'] = 'Unknown';
                return $result;
            }
        } else {
            $result['success'] = false;
            $result['reason'] = 'The type of file uploaded is not supported';
        }
        return $result;
    } else {
        $result['success'] =true;
        return $result;
    }
}

function uploadCSV($table)
{
    $db = DataBase::getDbh();
    $result['success'] =false;
    $allowedExts = array('csv');
    $temp = explode('.', $_FILES['file']['name']);
    $extension = end($temp);
    $path_to_file = realpath($_FILES["file"]["tmp_name"]);
    $options = Array("fieldChar" => ',', "lineChar" => '\r\n', "linesToIgnore" => 1, "loadDataLocal" => false);
    if ($_FILES['file']['size'] > 0) {
        if ((($_FILES['file']['type'] == 'application/vnd.ms-excel'))
            && in_array($extension, $allowedExts)) {
            if ($_FILES['file']['error'] > 0) {
                $result['success'] = false;
                $result['reason'] = 'An error occured while uploading file';
            } else {
                $db->where(true)
                    ->delete($table);
                $ret = $db->loadData($table, $path_to_file, $options);
                if ($ret) {
                    return $ret;
                }
                $result['reason'] = 'Unknown';
                return $result;
            }
        } else {
            $result['success'] = false;
            $result['reason'] = 'The type of file uploaded is not supported';
        }
        return $result;
    }
    return $result;
}