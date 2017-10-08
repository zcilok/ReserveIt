<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pdfprocess extends CI_Controller {

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
		$this->load->library('session');
		$this->load->model('Transition_Model','transition');
	}
	
	public function index()
	{
		//sleep(8);
		//print_r($_SESSION);
		$data['image_data']=$this->transition->get_lastid();
		$this->load->view('pdfticket',$data);
	}
	
	public function createPdf(){
		$temp=$_POST['pdf'];
		$pdf=str_replace(" ","+",$temp);
		$binary=base64_decode($pdf);
		$email=$_POST['email'];
		$name=$this->transition->get_lastid($email);
		if(file_exists("filePdf/".$name.".pdf")){
		
		}else{
			file_put_contents("filePdf/".$name.".pdf",$binary );
		}
		self::sendEmail($email);
	}
	
	public function sendEmail($receiver_email){
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
$subject='e-ticket from RESERVER IT';
$this->email->subject($subject);
$message='This is you e-ticket, please print it out and bring it with you when you go to our parking spot';
// Message in email
$this->email->message($message);
// It returns boolean TRUE or FALSE based on success or failure
$name=$this->transition->get_lastid($receiver_email);
$this->email->attach("filePdf/".$name.".pdf");
if($this->email->send()){
	echo "s";
}else{
	show_error($this->email->print_debugger());
}
	}
}
