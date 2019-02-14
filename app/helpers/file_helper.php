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
    $ret = false;
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
                try {
                    $ret = $db->loadData($table, $path_to_file, $options);
                } catch (Exception $e) {
                }
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

function uploadFile($file, $cms_form_id, $path = PATH_ADDITIONAL_INFO)
{
    $cms = new CMSFormModel($cms_form_id);
    $result = array();
    $result['success'] = false;
    $result['file'] = '';
    $result['reason'] = '';
    $db_file = '';
    $allowedExts = array('doc', 'docx', 'pdf', 'xlsx', 'xls', 'txt', 'pptx', 'ppt', 'csv');
    if (isset($_FILES[$file])) {
        foreach ($_FILES[$file]['name'] as $key => $value) {
            $temp = explode('.', $_FILES[$file]['name'][$key]);
            $extension = end($temp);
            if ($_FILES[$file]['size'][$key] > 0) {
                //$filename = $_FILES[$file]['name'][$key];
                //$filename = explode('/', $filename);
                //$filename = end($filename);
                $filetype = $_FILES[$file]['type'][$key];
                $file_error = $_FILES[$file]['error'][$key];
                if ((($filetype == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                        || ($filetype == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
                        || ($filetype == 'application/msword')
                        || ($filetype == 'application/pdf')
                        || ($filetype == 'text/plain')
                    )
                    || in_array($extension, $allowedExts)) {
                    if ($file_error > 0) {
                        $result['success'] = false;
                        $result['reason'] = $_FILES['file']['error'] . '<br>';
                    } else {
                        $ref = $cms->getHodRefNum();
                        if (empty($ref)) {
                            $db_file = getDeptRef(getUserSession()->department_id) . "_$key.$extension";
                        } else {
                            $db_file = $ref . "_$key.$extension";
                        }
                        //$db_file = 'c_' . $cms_form_id . '_u_' . getUserSession()->user_id . "_k_$key." . $extension;
                        $dir = $path . "$cms_form_id\\";
                        if (!file_exists($dir)) {
                            mkdir($dir, 0777, true);
                        }
                        $result['success'] = move_uploaded_file($_FILES[$file]['tmp_name'][$key], $dir . "$db_file");
                        $result['file'] = trim($result['file'] . ',' . $db_file, ',');
                        if (!$result['success']) {
                            $result['reason'] = 'An error occurred while uploading file!';
                            return $result;
                        }
                    }
                } else {
                    $result['reason'] = 'Please upload a risk assessment document in word, pdf, txt, or any Microsoft Office-Supported format (xlsx, csv...)!';
                }
            } else {
                $result['success'] = true;
            }
        }
    }
    return $result;
}

/*function uploadRiskAttachment($file, $cms_form_id)
{
    $path = PATH_RISK_ATTACHMENT;
    $result = array();
    $result['success'] = false;
    $result['file'] = '';
    $result['reason'] = '';
    $allowedExts = array('doc', 'docx', 'pdf', 'xlsx', 'xls', 'txt', 'pptx', 'ppt', 'csv');
    if (isset($_FILES[$file])) {
        foreach ($_FILES[$file]['name'] as $key => $value) {
            $temp = explode('.', $_FILES[$file]['name'][$key]);
            $extension = end($temp);
            if ($_FILES[$file]['size'][$key] > 0) {
                $filename = $_FILES[$file]['name'][$key];
                $filename = explode('/', $filename);
                //$filename = end($filename);
                $filetype = $_FILES[$file]['type'][$key];
                $file_error = $_FILES[$file]['error'][$key];
                if ((($filetype == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                        || ($filetype == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
                        || ($filetype == 'application/msword')
                        || ($filetype == 'application/pdf')
                        || ($filetype == 'text/plain')
                    )
                    || in_array($extension, $allowedExts)) {
                    if ($file_error > 0) {
                        $result['success'] = false;
                        $result['reason'] = $_FILES['file']['error'] . '<br>';
                    } else {
                        $db_file = 'c_' . $cms_form_id . '_u_' . getUserSession()->user_id . "_k_$key." . $extension;
                        $result['success'] = move_uploaded_file($_FILES[$file]['tmp_name'][$key], $path . $db_file);
                        $result['file'] = trim($result['file'] . ',' . $db_file, ',');
                        if (!$result['success']) {
                            $result['reason'] = 'An error occurred while uploading file!';
                            return $result;
                        }
                    }
                } else {
                    $result['reason'] = 'Please upload a risk assessment document in word, pdf, txt, or any Microsoft Office-Supported format (xlsx, csv...)!';
                }
            } else {
                $result['success'] = true;
            }
        }
    }
    return $result;
}*/

function download_file($file, $type = 'Risk Assessment Document')
{
    if (file_exists($file)) {
        $arr = explode('.', basename($file));
        $ext = end($arr);
        $file_name = $arr[0];
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . $type . '[' . $file_name . "].$ext");
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        return readfile($file);
    }
    return false;
}

?>