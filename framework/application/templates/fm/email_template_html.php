﻿<?php /* templates/fm/email_users_template.php */

# Create the body of the message.
$body='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
$body.='<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">';
$body.='<head>';
$body.='<title>'.$subject.'</title>'."\n";
$body.='<meta http-equiv="content-type" content="text/html; charset=UTF-8" />';
$body.='<meta http-equiv="content-language" content="english" />';
$body.='<meta name="copyright" content="Copyright &copy; '.date('Y').' Jam The Force" />';
$body.='</head>'."\n";
$body.='<body style="background:#fff;border:1px solid #ef4123;border-radius:12px;padding-left:8px">';
$body.='<table style="width:100&#37;;font-size:12px;line-height:18px;font-family:Helvetica,Arial,Verdana,sans-serif;color:#444;">';
$body.='<tr>';
$body.='<td>';
$body.='<p>Hello%s</p>'."\n\n\n";
$body.='<p>'.$message.'</p>'."\n\n\n";
$body.='Thank you,<br />'."\n";
$body.=$sender_name."\n\n\n\n";
$body.='</td>';
$body.='</tr>';
$body.='</table>';
$body.='</body>';
$body.='</html>';