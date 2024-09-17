<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// SMTP Configuration for GMass
$config['protocol'] = 'smtp';
$config['smtp_host'] = 'smtp.gmass.co';
$config['smtp_port'] = 465;  // Use 465 for SSL or 587 for TLS
$config['smtp_user'] = 'webforgecreative@gmail.com'; // Your Gmail address
$config['smtp_pass'] = 'dxlb pmhz igcg aidk'; // Your Gmail password or app password
$config['smtp_crypto'] = 'ssl';  // Use 'ssl' for port 465, 'tls' for port 587
$config['mailtype'] = 'html';  // You can set this to 'text' if you don't want HTML emails
$config['charset']  = 'utf-8';
$config['wordwrap'] = TRUE;
$config['newline']  = "\r\n";  // Newline for proper formatting
$config['smtp_timeout'] = 30;  // Optional: timeout for the SMTP request