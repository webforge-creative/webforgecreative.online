<?php
defined('BASEPATH') or exit('No direct script access allowed');

// application/config/email.php

$config['protocol'] = 'smtp';
$config['smtp_host'] = 'smtp.gmass.co';
$config['smtp_port'] = 587;
$config['smtp_user'] = 'gmass'; // Your Gmail address
$config['smtp_pass'] = '57e492f3-d4ce-4b51-a74b-a534018c4882'; // Your Gmail password or app password
$config['smtp_crypto'] = 'tls'; // or 'ssl' for SSL encryption
$config['mailtype'] = 'html';
$config['charset'] = 'utf-8';
$config['newline'] = "\r\n";
$config['wordwrap'] = TRUE;