<?php

    require (APPPATH.'views/google-api/vendor/autoload.php');
    $client = new Google_Client();

    // Enter your Client ID
    $client->setClientId('548591138639-57fcqfdrl1ur5cc55bmnv8u1ade3elha.apps.googleusercontent.com');
    // Enter your Client Secrect
    $client->setClientSecret('irWOesu4JmwEV8PoXDDPu0Ae');
    // Enter the Redirect URL
    $client->setRedirectUri('http://localhost/major/Home/google_auth');

    // Adding those scopes which we want to get (email & profile Information)
    $client->addScope("email");
    $client->addScope("profile");

    if(isset($_GET['code'])):

      $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
      
      if(!isset($token["error"]))
        {
      
          $client->setAccessToken($token['access_token']);
      
          // getting profile information
          $google_oauth = new Google_Service_Oauth2($client);
          $google_account_info = $google_oauth->userinfo->get();
      
          // Storing data into database
      
          $email = $google_account_info->email;
      
      
          // checking user already exists or not
          $users_list=$this->db->get_where('users',array('email'=>$email));
          if($users_list->num_rows()>0)
          {
            foreach($users_list->result() as $users)
            {

              if($email==$users->email)
              {
                $_SESSION['u_id']=$email;
                $_SESSION['role']=$users->role;
                if($users->role=="super admin")
                {
                redirect('Super_admin','refresh');
                }
                elseif($users->role=="librarian")
                {
                redirect('Librarian','refresh');
                }
                elseif($users->role=="hod")
                {
                redirect('Hod','refresh');
                }
                elseif($users->role=="professor")
                {
                redirect('Professor','refresh');
                }
                elseif($users->role=="lab assistant")
                {
                redirect('Lab_assistant','refresh');
                }
              }
              else
              {
                $this->session->set_flashdata('unregistered_email',"failed");
                redirect('Home/login','refresh');
              }
            }
          }
        else
            {
              $this->session->set_flashdata('unregistered_email',"failed");
              redirect('Home/login','refresh');
            }
        }
        else
        {
          //data base il nte gmail illenkil
          $this->session->set_flashdata('unregistered_email',"failed");
          redirect('Home/login','refresh');
        }
      else:
        $this->session->set_flashdata('unregistered_email',"failed");
        redirect('Home/login','refresh');
    endif;
    
    ?>