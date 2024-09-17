<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contact extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('email');  // Load the email library
    }

    public function send_email()
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

    public function submit_ajax()
    {
        // Collect form data
        $first_name = $this->input->post('first_name');
        $last_name = $this->input->post('last_name');
        $email = $this->input->post('email');
        $message = $this->input->post('message');

        // Validation (optional, add more checks as needed)
        if (empty($first_name) || empty($last_name) || empty($email) || empty($message)) {
            echo json_encode(['status' => 'error', 'message' => 'All fields are required']);
            return;
        }

        // Set up the email (using GMass SMTP)
        $this->email->from($email, $first_name . ' ' . $last_name);
        $this->email->to('webforgecreative@gmail.com');  // Replace with your email address
        $this->email->subject('Contact Form Submission');
        $this->email->message("First Name: $first_name\nLast Name: $last_name\nEmail: $email\n\nMessage:\n$message");

        // Send email
        if ($this->email->send()) {
            echo json_encode(['status' => 'success', 'message' => 'Email sent successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => $this->email->print_debugger()]);
        }
    }
}
