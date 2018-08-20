<?php if(!defined('BASEPATH')) exit ('No direct script access allowed');

class Mail extends MY_Controller{
  function __constructor(){
    parent::__constructor();
  }

  function contact_me(){

    $this->load->library('form_validation');
    log_message('debug', 'call contact_me()');

    $name = $this->input->POST("name");
    $email_address = $this->input->POST("email");
    $phone = $this->input->POST("phone");
    $message = $this->input->POST("message");

    $this->load->library('form_validation');
    $this->form_validation->set_rules('name', 'name', 'required');
    $this->form_validation->set_rules('email', 'email', 'required');
    $this->form_validation->set_rules('message', 'message', 'required');


    if ($this->form_validation->run() == FALSE){
      echo "error";
      echo validation_errors();
      return false;
    }else{
      //        $topic_id = $this->Topic_model->add($this->input->post('title'), $this->input->post('description'));

      // Create the email and send the message
      $to = 'deutschgon@gmail.com'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
      $email_subject = "Website Contact Form:  $name";
      $email_body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email_address\n\nPhone: $phone\n\nMessage:\n$message";
      $headers = "From: noreply@dgon.eu\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
      $headers .= "Reply-To: $email_address";
//      mail($to,$email_subject,$email_body,$headers);

/*
      echo "email_subject=$email_subject<br>";
      echo "email_body=$email_body<br>";
*/
      $this->load->library('email');

      $config['protocol'] = 'sendmail';
      $config['mailpath'] = '/usr/sbin/sendmail';
      $config['charset'] = 'utf-8';
      $config['wordwrap'] = TRUE;

      $this->email->initialize($config);

      $this->email->set_header('Header1', $headers);

      $this->email->from('noreply@dgon.eu', 'DGon');
      $this->email->to('deutschgon@gmail.com');
      $this->email->subject($email_subject);
      $this->email->message($email_body);

      $this->email->send();
      return true;






    }

  }

}

?>
