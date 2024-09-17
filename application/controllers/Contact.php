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
        $this->load->library('email');

        // Get POST data from AJAX
        $firstName = $this->input->post('firstName');
        $lastName = $this->input->post('lastName');
        $email = $this->input->post('email');
        $message = $this->input->post('message');

        // Email configuration
        $this->email->from('webforgecreative@gmail.com', 'WebForge Creative'); // Use a verified sender address
        $this->email->to('webforgecreative@gmail.com'); // Your email address
        $this->email->reply_to($email); // Set the user's email address as reply-to
        $this->email->subject('Contact Form Message');
        $this->email->message("From: $firstName $lastName ($email)\n\n$message");

        // Send email and return response to AJAX
        if ($this->email->send()) {
            echo 'success';
        } else {
            echo 'error';
        }
    }
}
