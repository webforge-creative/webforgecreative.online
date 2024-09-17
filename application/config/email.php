<?php
defined('BASEPATH') or exit('No direct script access allowed');

// application/config/email.php

$config['protocol'] = 'smtp'; // Use SMTP protocol
$config['smtp_host'] = 'smtp.gmail.com'; // SMTP server
$config['smtp_port'] = 587; // SMTP port (587 for TLS, 465 for SSL)
$config['smtp_user'] = 'webforgecreative@gmail.com'; // Your email address
$config['smtp_pass'] = 'creativeworld2004'; // Your email password
$config['mailtype'] = 'html'; // Email format (text or html)
$config['charset']  = 'iso-8859-1'; // Character set
$config['wordwrap'] = TRUE; // Enable word wrap
$config['smtp_crypto'] = 'tls'; // Encryption (tls or ssl)

$this->load->library('email', $config);