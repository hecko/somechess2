<?php
//		Some Chess, a PHP multi-player chess server.
//		Copyright (C) 2007 Jon Link
require_once('config.php');
$date	 	= date("Y.m.d");
$filename	= 'backups/somechess-'.str_replace('.','',$date).'.sql.gz';
$subject 	= 'somechess backup: '.$date;

$command 	= 'mysqldump -u '.$dbUser.' --password='.$dbPass.' '.$database.' | gzip > '.$filename;
$result		= passthru($command);

$attachmentname = array_pop(explode("/", $filename));

$message = "This is your backup file of Some Chess for ".$date.", file: ".$attachmentname." attached.\r\n";
$mime_boundary = "<<<:" . md5(time());
$data = chunk_split(base64_encode(implode('', file($filename))));

$headers = 'From: '.$adminEmail."\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-type: multipart/mixed;\r\n";
$headers .= " boundary=\"".$mime_boundary."\"\r\n";

$content = "This is a multi-part message in MIME format.\r\n\r\n";
$content.= "--".$mime_boundary."\r\n";
$content.= "Content-Type: text/plain; charset=\"iso-8859-1\"\r\n";
$content.= "Content-Transfer-Encoding: 7bit\r\n\r\n";
$content.= $message."\r\n";
$content.= "--".$mime_boundary."\r\n";
$content.= "Content-Disposition: attachment;\r\n";
$content.= "Content-Type: Application/Octet-Stream; name=\"$attachmentname\"\r\n";
$content.= "Content-Transfer-Encoding: base64\r\n\r\n";
$content.= $data."\r\n";
$content.= "--" . $mime_boundary . "\r\n";

if($backupEmail) $sent	= mail($adminEmail, $subject, $content, $headers);
if(!$backupFolder) unlink($filename);
?>