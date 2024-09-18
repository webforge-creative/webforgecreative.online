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
        $this->email->from('webforgecreative@gmail.com', 'WebForge Creative');
        $this->email->to('webforgecreative@gmail.com');
        $this->email->reply_to($email);
        $this->email->subject('Contact Form Message');

        $messageToYou = "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; color: #333; }
            .container { width: 80%; margin: 0 auto; }
            .header { background-color: #007BFF; color: #fff; padding: 20px; text-align: center; }
            .content { padding: 20px; }
            .footer { background-color: #f1f1f1; color: #333; text-align: center; padding: 10px; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h1>New Contact Form Message</h1>
            </div>
            <div class='content'>
                <p><strong>From:</strong> $firstName $lastName ($email)</p>
                <p><strong>Message:</strong></p>
                <p>$message</p>
            </div>
            <div class='footer'>
                <p>&copy; 2024 WebForge Creative. All rights reserved.</p>
            </div>
        </div>
    </body>
    </html>";

        $this->email->message($messageToYou);

        // Send email to you and check for success
        if ($this->email->send()) {
            // Send confirmation email to the user
            $this->email->clear(); // Clear previous email settings

            $this->email->from('webforgecreative@gmail.com', 'WebForge Creative');
            $this->email->to($email);
            $this->email->subject('We Have Received Your Message');

            $messageToUser = "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; color: #333; }
                .container { width: 80%; margin: 0 auto; }
                .header { background-color: #007BFF; color: #fff; padding: 20px; text-align: center; }
                .content { padding: 20px; }
                .footer { background-color: #f1f1f1; color: #333; text-align: center; padding: 10px; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h1>Thank You for Your Message!</h1>
                </div>
                <div class='content'>
                    <p>Hi $firstName $lastName,</p>
                    <p>Thank you for contacting WebForge Creative. We have received your message and our team will get back to you as soon as possible.</p>
                    <p>Best regards,<br>WebForge Creative Team</p>
                </div>
                <div class='footer'>
                    <p>&copy; 2024 WebForge Creative. All rights reserved.</p>
                </div>
            </div>
        </body>
        </html>";

            $this->email->message($messageToUser);

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
