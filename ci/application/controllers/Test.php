<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Transition_Model','transition');
		//$this->load->library('session');
		//$this->index();
	}
	public function index()
	{
		 $data['order_id']=$this->uri->segment(3);
		 $this->load->view('check.php',$data);

	}
	
	public function verifyCode(){
	  $order_id=$_POST['Order_Number'];
	  $verify_id=$_POST['Verify_Code'];
	  $status=$this->transition->verify_status($verify_id);
	  if($status){
		  $order_status=$this->transition->verify_order($order_id);
		  if($order_status==1){
			   $this->transition->update_times($order_id);
			   $receiver_email=$this->transition->getEmail($order_id);
			   self::sendEmail($receiver_email,$order_id);
			   $data['info']="this e-ticket is verified";
		  }elseif($order_status==0){
			   $data['info']= "this e-ticket is already used";
		  }else{
			   $data['info']= "this order number is wrong";
		  }
	  }else{
		  $data['info']= "verify code is not correct";
	  }
	  $this->load->view('showresult.php',$data);
	}
	
		public function sendEmail($receiver_email,$order_id){
		// The mail sending protocol.
$config['protocol'] = 'smtp';
// SMTP Server Address for Gmail.
$config['smtp_host'] = 'ssl://smtp.googlemail.com';
// SMTP Port - the port that you is required
$config['smtp_port'] = 465;
// SMTP Username like. (abc@gmail.com)
$sender_email='mizzougroup11@gmail.com';
$config['smtp_user'] = $sender_email;
// SMTP Password like (abc***##)
$config['smtp_pass'] = 'Group111';
// Load email library and passing configured values to email library
$this->load->library('email', $config);
// Sender email address
$this->email->set_newline("\r\n");  
$username='mizzougroup11';
$this->email->from($sender_email, $username);
// Receiver email address.for single email

$this->email->to($receiver_email);
//send multiple email
//$this->email->to(abc@gmail.com,xyz@gmail.com,jkl@gmail.com);
// Subject of email
$subject='Your e-ticket is verified';
$this->email->subject($subject);
date_default_timezone_set('America/Chicago');
$date = date('m/d/Y h:i:s', time());
$message="Hi, you e-ticket is used at $date";
// Message in email
$this->email->message($message);
// It returns boolean TRUE or FALSE based on success or failure

if($this->email->send()){
	echo "s";
}else{
	show_error($this->email->print_debugger());
}
	}
}
