<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 2/14/2019
 * Time: 10:00 AM
 */

class Downloads
{
    public function DownloadRiskAttachment($cms_form_id)
    {
        $the_file = '';
        $file_name = (new CMSForm(['cms_form_id' => $cms_form_id]))->getRiskAttachment();
        $files = explode(',', $file_name);
        $zipname = 'Risk-Attachments.zip';
        $zip = new ZipArchive;
        $zip->open($zipname, ZipArchive::CREATE);
        foreach ($files as $file) {
            $the_file = PATH_RISK_ATTACHMENT . $file;
            $zip->addFile($file);
        }
        $zip->close();
        if (headers_sent()) {
            echo 'HTTP header already sent';
        } else {
            if (!is_file($the_file)) {
                header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
                echo 'File not found';
            } else if (!is_readable($the_file)) {
                header($_SERVER['SERVER_PROTOCOL'] . ' 403 Forbidden');
                echo 'File not readable';
            } else {
                header($_SERVER['SERVER_PROTOCOL'] . ' 200 OK');
                header('Content-Description: CMS Risk Assessment Documents');
                header("Content-Type: application/zip");
                header("Content-Transfer-Encoding: Binary");
                header("Content-Length: " . filesize($zipname));
                header("Content-disposition: attachment; filename=\"" . $zipname . "\"");
                readfile($zipname);
                exit;
            }
        }
    }
} ?>