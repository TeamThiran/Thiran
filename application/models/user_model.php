<?php
class user_model extends CI_Model {
	

	function signed_in($uid=''){
		

		$this->db->from('users');
		$this->db->where('uid',$uid);
		$sql = $this->db->get()->result();
		if (is_array($sql)&&count($sql)==1){
			//user already exists. just sign-in the user
			return 'signin';
		}else{
			//return signup, and the controller loads the view
			//to read first-time details
			return 'signup';
		}
	}

	function signup($details){
		
//`id`, `firstname`, `lastname`, `email`, `password`, `college_id`, `phone_no`, `uid`, `last_update`, `ypassout`, `user_type`, `photo`
        global $id;


        //make sure this user doesn't exist
		$sql = "SELECT id,range_val from college,users where college.college_id=? order by users.id desc limit 1"; 
		$query = $this->db->query($sql, $details['college_id']);
                
		if ($query->num_rows() > 0)
		{
		   $row = $query->row();
		  $id=$row->id;
                   $Range=$row->range_val;
                   $array = json_decode($Range, true);
                if (($array['from'] >=$id)&&($id<$array['to'])) {
                   $id=$id+1;
                   
            }
                }
                else {
                    $sql = "SELECT range_val from college where college.college_id=?"; 
		$query = $this->db->query($sql, $details['college_id']);
                if ($query->num_rows() > 0)
		{
		   $row = $query->row();
                   $Range=$row->range_val;
                   $array = json_decode($Range, true);
                        $id=$array['from'];
		}
                
                
 }
              $data = array(
                        'id'=>$id,
			'first_name'=> $this->session->userdata('first_name'),
                        'last_name'=> $this->session->userdata('last_name'),
                        'email' =>$this->session->userdata('email') ,
                        'password'=> md5(rand(1002300000,8907654345)),
                        'college_id' => $details['college_id'],
			'phone_no' => $details['phone_no'],
                        'uid'=> $this->session->userdata('uid'),
                        'ypassout' => $details['ypassout'],
                        'user_type' => $details['utype'],
			'photo' => $this->session->userdata('image')
                         
		);
                 $this->session->set_userdata(array(
					'is_logged_in' => TRUE,
                                        'ypassout' => $data['ypassout'],
                                         'user_type' => $data['user_type'],                
                                         'phone_no' => $data['phone_no'],
                                         'college_id' => $data['college_id']
                     ));
			return $this->db->insert('users',$data);
		
	}

	public function get_user($uid='')
        {
            $sql = "SELECT * FROM users WHERE uid = ?"; 
		$query = $this->db->query($sql, $uid);
		if ($query->num_rows() > 0)
		{
		   $row = $query->row();
		   $this->session->set_userdata(array(
                     'ypassout'=>$row->ypassout,
                       'user_type'=>$row->user_type,
                       'phone_no'=>$row->phone_no,
                       'college_id'=>$row->college_id
                   ));
		}
        }
        
          function login_t($detail)
          {
              $this->db->from('users');
              $this->db->where('email',$detail['email']);
              $this->db->where('password',  md5($detail['password']));             
              $sql = $this->db->get()->result();
		if (is_array($sql)&&count($sql)==1){
                    $row=$sql->row();
                     $data = array(
                        'id'=>$row->id,
			'first_name'=> $row->first_name,
                        'last_name'=> $row->last_name,
                        'email' =>$row->email,
                        'college_id' => $row->college_id,
			'phone_no' => $row->phone_no,
                        'ypassout' => $row->ypassout,
                        'user_type' => $row->utype,
                         'is_logged_in' => TRUE
                         
		);
                   return $data; 
                }
           
          }
          
                function signup_t($details)
        {
                   global $id;
		$sql = "SELECT id,range_val from college,users where college.college_id=? order by users.id desc limit 1"; 
		$query = $this->db->query($sql, $details['college_id']);
		if ($query->num_rows() > 0)
		{
		   $row = $query->row();
		  $id=$row->id;
                   $Range=$row->range_val;
                   $array = json_decode($Range, true);
                if (($array['from'] >=$id)&&($id<$array['to'])) {
                   $id=$id+1;
                   
            }
                }
                else {
                    $sql = "SELECT range_val from college where college.college_id=?"; 
		$query = $this->db->query($sql, $details['college_id']);
                if ($query->num_rows() > 0)
		{
		   $row = $query->row();
                   $Range=$row->range_val;
                   $array = json_decode($Range, true);
                        $id=$array['from'];
		}
                
                
 }
                  $data = array(
                        'id'=>$id,
			'first_name'=> $details['first_name'],
                        'last_name'=> $details['last_name'],
                        'email' =>$details['email'] ,
                        'password'=>  md5($details['password']),
                        'college_id' => $details['college_id'],
			'phone_no' => $details['phone_no'],
                        'uid'=>'',
                        'ypassout' => $details['ypassout'],
                        'user_type' => $details['utype'],
			'photo' =>''
                         
		);
                return $this->db->insert('users',$data);
        }
}


