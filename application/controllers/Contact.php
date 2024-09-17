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
        $this->load->library('email');

        // Get POST data from AJAX
        $firstName = $this->input->post('firstName');
        $lastName = $this->input->post('lastName');
        $email = $this->input->post('email');
        $message = $this->input->post('message');

        // Email configuration
        $this->email->from($email, $firstName . ' ' . $lastName);
        $this->email->to('webforgecreative@gmail.com');
        $this->email->subject('Contact Form Message');
        $this->email->message($message);

        // Enable debugging
        $this->email->print_debugger();

        // Send email and return response to AJAX
        if ($this->email->send()) {
            echo 'success';
        } else {
            echo 'error';
        }
    }
}
