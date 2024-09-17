<?php
defined('BASEPATH') or exit('No direct script access allowed');

// application/config/email.php

$config['protocol'] = 'smtp';
$config['smtp_host'] = 'smtp.gmass.co';
$config['smtp_port'] = 587;
$config['smtp_user'] = 'webforgecreative@gmail.com'; // Your Gmail address
$config['smtp_pass'] = 'lxwp-ycqf-klze-ihzy'; // Your Gmail password or app password
$config['smtp_crypto'] = 'tls'; // or 'ssl' for SSL encryption
$config['mailtype'] = 'html';
$config['charset'] = 'utf-8';
$config['newline'] = "\r\n";
$config['wordwrap'] = TRUE;