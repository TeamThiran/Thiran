<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
    
class Social extends CI_Controller {
    
   public function session($provider) { 

    	 $this->load->helper('url_helper');
         //facebook
         if($provider == 'facebook') {
                $app_id = $this->config->item('facebook_id');
		$app_secret = $this->config->item('facebook_secret');		
		$provider	= $this->oauth2->provider($provider, array(
			'id' => $app_id,
			'secret' => $app_secret,
			));			
		}
	//google
		else if($provider == 'google'){

			$app_id 		= $this->config->item('google_id');
			$app_secret 	= $this->config->item('google_secret');
			$provider 		= $this->oauth2->provider($provider, array(
				'id' => $app_id,
				'secret' => $app_secret,
			)); 			
		}
                
	if ( ! $this->input->get('code'))
        {  
            // By sending no options it'll come back here
            $provider->authorize();
            redirect('social?error');
        }
        else
        {
            // Howzit?
            try
            {
                $token = $provider->access($_GET['code']);
                $user = $provider->get_user_info($token);
               $this->session->set_userdata(array(
					'uid' => $user['uid'], 
					'first_name' => $user['first_name'],
                                        'last_name' => $user['last_name'],
					'name' => $user['name'],
					'email' => $user['email'],
					'image' => $user['image']
					
				));
                $this->load->model('user_model');
		$login_type = $this->user_model->signed_in($user['uid']);
                if($login_type == "signup"){
				//first timer. let the user fill out details
				$this->signup();
			}else if($login_type == "signin"){
                            $this->user_model->get_user($user['uid']);
                      $this->load->view('template');
                        }
                      
            }

            catch (OAuth2_Exception $e)
            {
                show_error('That didnt work: '.$e);
            }

        }
    }
    public function signup() {
		//check if signup form was submitted
		if($this->input->post('signup') == "true"){
			
			$this->load->model('user_model');
			//NOTE: form validation to come up here

			//Enter details into database
			$signup = $this->user_model->signup(array(
				'college_id' => $this->input->post('college_id'),
				'phone_no' => $this->input->post('phone_no'),
				'ypassout' => $this->input->post('ypassout'),
                              	'utype' => $this->input->post('utype')
                            
                            
			));

			if($signup){
				//data successfully added to database
                             $this->session->set_flashdata('success', 'Successfully submitted...');
                             
			}else{
				//there was a problem logging in.
				//send flash_message
                             $this->session->set_flashdata('error', 'Sign up error Try again...');
				redirect('welcome');
			}

			redirect('welcome');
		}else{
			$this->load->view('pages/social_signup');
		}
	}

    
    }

