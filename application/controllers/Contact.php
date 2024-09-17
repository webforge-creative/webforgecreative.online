<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contact extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('email');  // Load the email library
    }

    public function test()
    {
        // Set email configuration
        $this->load->library('email');
        $this->email->from('webforgecreative@gmail.com', 'Your Name');
        $this->email->to('aptechstudent48@gmail.com');
        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');

        if ($this->email->send()) {
            echo 'Email sent.';
        } else {
            echo 'Failed to send email.';
        }
    }

    public function send_email()
    {
        // Load email library and configuration
        $this->load->library('email');
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'in-v3.mailjet.com'; // Mailjet SMTP server
        $config['smtp_port'] = 587; // Mailjet SMTP port
        $config['smtp_user'] = 'c18134d7c5be01c9a506607401235c3c'; // Your Mailjet API key
        $config['smtp_pass'] = '383f2509c47ee03905397d79bb2c28f0'; // Your Mailjet secret key
        $config['mailtype'] = 'html';
        $config['charset']  = 'utf-8';
        $config['wordwrap'] = TRUE;
        $this->email->initialize($config);

        // Get POST data from AJAX
        $firstName = $this->input->post('firstName');
        $lastName = $this->input->post('lastName');
        $email = $this->input->post('email');
        $message = $this->input->post('message');

        // Set email parameters
        $this->email->from($email, $firstName . ' ' . $lastName);
        $this->email->to('webforgecreative@gmail.com'); // Your email address
        $this->email->subject('Contact Form Message');
        $this->email->message($message);

        // Send email and check for success
        if ($this->email->send()) {
            echo 'success';
        } else {
            echo $this->email->print_debugger(); // Print email debug information
        }
    }
}
