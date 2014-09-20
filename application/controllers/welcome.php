<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	

	public function index()
	{
		//Check if user is logged in
		if($this->auth->is_logged_in()){
                    $this->load->view('template');
                }
                else{
			$this->load->view('startup');
                }
	}
        public function login_t()
        {
$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
$this->form_validation->set_rules('password', 'Password', 'required');
if ($this->form_validation->run()!= FALSE)
		{
            if($this->input->post('login')!='')
            {
                $this->load->model('user_model');
                $login= $this->user_model->login_t(array(
                    $this->input->post('email'),
                    $this->input->post('password')
          ));
                if($login)
                {
                    $this->session->set_userdata(array(
                                        'name'=> $login['first_name']+" "+$login['last_name'],
                                        'email' =>$login['email'] ,
                                        'is_logged_in' =>$login['is_logged_in'],
                                        'ypassout' => $login['ypassout'],
                                         'user_type' => $login['user_type'],                
                                         'phone_no' => $login['phone_no'],
                                         'college_id' => $login['college_id']
                        
                        ));
                        redirect('welcome');
                }
            }
                }
               else {
                    $this->load->view('startup');
                }
        }
        public function signup()
        {
$this->form_validation->set_rules('first_name','Firstname','trim|required|min_length[4]|max_length[10]|xss_clean');
$this->form_validation->set_rules('last_name','Lastname','trim|required|min_length[4]|max_length[10]|xss_clean');
$this->form_validation->set_rules('password', 'Password', 'trim|required|matches[conf_password]');
$this->form_validation->set_rules('conf_password', 'Password Confirmation', 'trim|required');
$this->form_validation->set_rules('email_id', 'Email', 'trim|required|valid_email|is_unique[users.email]');
$this->form_validation->set_rules('ypassout', 'Year of passout', 'trim|required|numeric');
$this->form_validation->set_rules('phone_no', 'Phone no', 'trim|required|max_length[20]');
if ($this->form_validation->run()!= FALSE)
		{
            if($this->input->post('signup')!='')
            {
            $this->load->model('user_model');
			//NOTE: form validation to come up here

			//Enter details into database
			$signup = $this->user_model->signup_t(array(
                                'first_name' => $this->input->post('first_name'),
                                'last_name' => $this->input->post('last_name'),
				'email' => $this->input->post('email_id'),
                                'password' => $this->input->post('password'),
                                'college_id' => $this->input->post('college_id'),
				'phone_no' => $this->input->post('phone_no'),
				'ypassout' => $this->input->post('ypassout'),
                              	'utype' => $this->input->post('user_type')
                            
                            
			));
                        if($signup)
                        {
                             $this->session->set_flashdata('success', 'Successfully submitted...');
                            redirect('welcome');
                        }
        }
        }
        else {
                    $this->load->view('startup');
                }
   }
        public function logout() {
		//log out user
		//function is inside the library folder
		$this->auth->logout();
	}
}

