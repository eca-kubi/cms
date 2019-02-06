<?php
function uploadAttachment($file, $staff_id)
{
    $result['success'] = false;
    $result['file'] = '';
    $allowedExts = array('doc', 'docx', 'pdf', 'xlsx', 'txt');
    $temp = explode('.', $_FILES[$file]['name']);
    $extension = end($temp);
    if ($_FILES[$file]['size'] > 0) {
        // $filename = $_FILES[$file]['name'];
        // $filename = explode('/', $filename);
        // $filename = end($filename);
        if ((($_FILES[$file]['type'] == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
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
                $ret = move_uploaded_file($_FILES[$file]['tmp_name'], APP_ROOT . '\..\public\assets\attachments\\' . $staff_id . '.' . $extension);
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
        $result['success'] = true;
        return $result;
    }
}

function uploadProfilePic($file, $staff_id)
{
    $result['success'] = false;
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
        $result['success'] = true;
        return $result;
    }
}

function uploadCSV($table)
{
    $db = DataBase::getDbh();
    $result['success'] = false;
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

function uploadRiskAttachment($file, $cms_form_id)
{
    $path = PATH_RISK_ATTACHMENT;
    $result['success'] = false;
    $result['file'] = '';
    $result['reason'] = '';
    $allowedExts = array('doc', 'docx', 'pdf', 'xlsx', 'xls', 'txt', 'pptx', 'ppt');
    if (isset($_FILES[$file])) {
        $temp = explode('.', $_FILES[$file]['name']);
        $extension = end($temp);
        if ($_FILES[$file]['size'] > 0) {
            $filename = $_FILES[$file]['name'];
            $filename = explode('/', $filename);
            $filename = end($filename);
            if ((($_FILES[$file]['type'] == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                    || ($_FILES[$file]['type'] == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
                    || ($_FILES[$file]['type'] == 'application/msword')
                    || ($_FILES[$file]['type'] == 'application/pdf')
                    || ($_FILES[$file]['type'] == 'text/plain')
                )
                || in_array($extension, $allowedExts)) {
                if ($_FILES[$file]['error'] > 0) {
                    $result['success'] = false;
                    $result['reason'] = $_FILES['file']['error'] . '<br>';
                } else {
                    $filename = $_FILES[$file]['name'];
                    $result['success'] = move_uploaded_file($_FILES[$file]['tmp_name'], $path . 'c_' . $cms_form_id . '_u_' . getUserSession()->user_id . '.' . $extension);
                    $result['file'] = 'c_' . $cms_form_id . '_u_' . getUserSession()->user_id . '.' . $extension;
                    if (!$result['success']) {
                        $result['reason'];
                    }
                    return $result;
                }
            } else {
                $result['reason'] = 'Please upload a risk assessment document in word, pdf, or an excel-supported format (xlsx, csv...)!';
            }
        } else {
            $result['success'] = true;
        }
    }

    return $result;
}

function uploadAdditionalInfo($file, $cms_form_id)
{
    $path = APP_ROOT . '\..\public\assets\uploads\additional-infos\\';
    $result['success'] = false;
    $result['file'] = '';
    $allowedExts = array('doc', 'docx', 'pdf', 'xlsx', 'txt', 'pptx', 'ppt');
    $temp = explode('.', $_FILES[$file]['name']);
    $extension = end($temp);
    if ($_FILES[$file]['size'] > 0) {
        $filename = $_FILES[$file]['name'];
        $filename = explode('/', $filename);
        $filename = end($filename);
        if ((($_FILES[$file]['type'] == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                || ($_FILES[$file]['type'] == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
                || ($_FILES[$file]['type'] == 'application/msword')
                || ($_FILES[$file]['type'] == 'application/pdf')
                || ($_FILES[$file]['type'] == 'text/plain')
            )
            || in_array($extension, $allowedExts)) {
            if ($_FILES[$file]['error'] > 0) {
                $result['success'] = false;
                $result['reason'] = $_FILES['file']['error'] . '<br>';
            } else {
                $filename = $_FILES[$file]['name'];
                $result['success'] = move_uploaded_file($_FILES[$file]['tmp_name'], $path . 'c_' . $cms_form_id . '_u_' . getUserSession()->user_id . '.' . $extension);
                $result['file'] = 'c_' . $cms_form_id . '_u_' . getUserSession()->user_id . '.' . $extension;
                if (!$result['success']) {
                    $result['reason'];
                }
                return $result;
            }
        } else {
            $result['reason'] = 'The type of file uploaded is not supported';
        }
    } else {
        $result['success'] = true;
    }
    return $result;
}

function download_file($file)
{
    if (file_exists($file)) {
        $arr = explode('.', basename($file));
        $ext = end($arr);
        $file_name = $arr[0];
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . 'Risk Assessment Document[' . $file_name . "].$ext");
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        return readfile($file);
    }
    return false;
}