<?php
	class Transition_Model extends CI_Model{
		public function __construct(){
			parent::__construct();
			$this->load->database();
		}
        public function insert_txn_id($data){
			//$sql="insert into Reservation (Order_Num,Order_Date,User_Email,Button_id,Status) values (?,NOW(),?,?,?);";
			date_default_timezone_set('America/Chicago');
			$date = date('Y-m-d h:i:s', time());
			$sql="insert into Reservation (Order_Num,Order_Date,User_Email,Button_id,Status) values (?,'$date',?,?,?);";
			return $this->db->query($sql,$data);
		}
		
		public function get_lastid($email){
			//$email='qltf8@mail.missouri.edu';
			//$email='AK-1234';
			$sql="select * from Reservation where User_Email='$email' ORDER BY Order_Date DESC limit 1;";
			$res=$this->db->query($sql);
			foreach ($res->result() as $row)
				{
					 return $row->Order_Num; // access attributes
    
				}
		}
		
		public function verify_status($verify_id){
			if($verify_id=='123456'){
				return true;
			}else{
				return false;
			}
			
			
		}
		
		
		public function verify_order($order_id){
			
			$sql="select * from Reservation where Order_Num = '$order_id'";
			$res = $this->db->query($sql);

			$row = $res->row();

			if (isset($row))
				{
					return $row->Times;
				}
			else
				{
					return -1;
				}
		}
		
		public function update_times($order_id){
			$sql = "update Reservation set Times = 0 where Order_Num = '$order_id'";
			$res = $this->db->query($sql);
		}
		
		public function getEmail($order_id){
			$sql="select * from Reservation where Order_Num = '$order_id'";
			$res = $this->db->query($sql);
			$row = $res->row();
			return $row->User_Email;
		}
    }
?>     
        
        
