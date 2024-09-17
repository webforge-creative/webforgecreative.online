<?php
defined('BASEPATH') or exit('No direct script access allowed');

// application/config/email.php

$config['protocol'] = 'smtp';
$config['smtp_host'] = 'in-v3.mailjet.com';
$config['smtp_port'] = 587;
$config['smtp_user'] = 'c18134d7c5be01c9a506607401235c3c'; // Your Mailjet API key
$config['smtp_pass'] = '383f2509c47ee03905397d79bb2c28f0'; // Your Mailjet secret key
$config['mailtype'] = 'html';
$config['charset']  = 'utf-8';
$config['wordwrap'] = TRUE;