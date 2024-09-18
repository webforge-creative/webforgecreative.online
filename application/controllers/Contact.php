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
        // Load the Mailjet library
        $this->load->library('email');

        // Get POST data from AJAX
        $firstName = $this->input->post('firstName');
        $lastName = $this->input->post('lastName');
        $email = $this->input->post('email');
        $message = $this->input->post('message');

        $this->email->initialize(array(
            'protocol' => 'smtp',
            'smtp_host' => 'in-v3.mailjet.com',
            'smtp_port' => 587,
            'smtp_user' => 'c18134d7c5be01c9a506607401235c3c',
            'smtp_pass' => '383f2509c47ee03905397d79bb2c28f0',
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'wordwrap' => TRUE
        ));

        // Prepare data for Mailjet API
        $postData = array(
            'Messages' => array(
                array(
                    'From' => array(
                        'Email' => "webforgecreative@gmail.com",
                        'Name' => "WebForge Creative"
                    ),
                    'To' => array(
                        array(
                            'Email' => 'webforgecreative@gmail.com',
                            'Name' => 'WebForge Creative'
                        )
                    ),
                    'TemplateID' => 'YOUR_TEMPLATE_ID_FOR_RECEIVING_MESSAGES',
                    'TemplateLanguage' => true,
                    'Subject' => 'Contact Form Message',
                    'Variables' => array(
                        'FIRST_NAME' => $firstName,
                        'LAST_NAME' => $lastName,
                        'EMAIL' => $email,
                        'MESSAGE' => $message
                    )
                )
            )
        );

        // Send email to you
        $ch = curl_init('https://api.mailjet.com/v3.1/send');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Basic ' . base64_encode('c18134d7c5be01c9a506607401235c3c:383f2509c47ee03905397d79bb2c28f0')
        ));
        $response = curl_exec($ch);
        curl_close($ch);

        if (strpos($response, '"Status":"success"') !== false) {
            // Send confirmation email to the user
            $postData['Messages'][0]['To'] = array(array(
                'Email' => $email,
                'Name' => $firstName . ' ' . $lastName
            ));
            $postData['Messages'][0]['TemplateID'] = '6300296';
            $postData['Messages'][0]['Subject'] = 'We Have Received Your Message';

            // Send confirmation email
            $ch = curl_init('https://api.mailjet.com/v3.1/send');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Authorization: Basic ' . base64_encode('c18134d7c5be01c9a506607401235c3c:383f2509c47ee03905397d79bb2c28f0')
            ));
            $response = curl_exec($ch);
            curl_close($ch);

            if (strpos($response, '"Status":"success"') !== false) {
                echo 'success';
            } else {
                echo 'error';
            }
        } else {
            echo 'error';
        }
    }
}
