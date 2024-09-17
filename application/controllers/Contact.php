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

        // Email to your address with the user's message
        $this->email->from('webforgecreative@gmail.com', 'WebForge Creative'); // Verified sender address
        $this->email->to('webforgecreative@gmail.com'); // Your email address
        $this->email->reply_to($email); // User's email address as reply-to
        $this->email->subject('Contact Form Message');
        $this->email->message("From: $firstName $lastName ($email)\n\n$message");

        // Send email to you and check for success
        if ($this->email->send()) {
            // Send confirmation email to the user
            $this->email->clear(); // Clear previous email settings

            $this->email->from('webforgecreative@gmail.com', 'WebForge Creative'); // Verified sender address
            $this->email->to($email); // User's email address
            $this->email->subject('We Have Received Your Message');
            $this->email->message("Hi $firstName $lastName,\n\nThank you for contacting us. We have received your message and our team will get back to you as soon as possible.\n\nBest regards,\nWebForge Creative");

            // Send confirmation email and return response to AJAX
            if ($this->email->send()) {
                echo 'success';
            } else {
                echo 'error';
            }
        } else {
            echo 'error';
        }
    }
}
