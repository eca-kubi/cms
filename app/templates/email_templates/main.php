<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 2/25/2019
 * Time: 9:32 AM
 */
$current_user = getUserSession();
/** @var string $subject */
/** @var string $recipient_name */
/** @var string $body */
echo <<<html
<html lang="en">
<head>
    <title>$subject</title>
</head>
<body style="margin: 0; padding: 0;">
<table align="center" cellpadding="10" cellspacing="0" width="600" style="border-collapse: collapse;">
    <tr bgcolor="#70bbd9" style="padding: 30px 30px 30px 30px;">
        <td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; font-weight: bold; border-bottom: #f8f8f8 2px solid;">
            <b>$subject</b>
        </td>
    </tr>
    <tr bgcolor="#70bbd9" style="padding: 30px 30px 30px 30px;">
        <td>
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td style="color: #153643;font-family: Arial, sans-serif; font-size: 14px;">
                        Hello $recipient_name,
                        <br/>
                        $body
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr bgcolor="#ee4c50" style="padding: 30px 30px 30px 30px;">
        <td>
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 10px; font-weight: bold"> 
                        (c) 2022 - Developed by Adamus IT<br/>
                        Email: ithelpdesk@adamusgh.com <br/>
                        Ext: 1000/1001/1002/1003/1004
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
html;
