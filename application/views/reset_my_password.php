<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style>
    html,
body {
  height: 100%;
}

body {
  /*display: -ms-flexbox;
  display: flex;
  -ms-flex-align: center;
  align-items: center;
  padding-top: 40px;
  padding-bottom: 40px;
  background:url("<?php echo base_url('assets/image/login_g.jpg'); ?>");
  background-repeat:no-repeat;
  background-size:cover;
 */
}

.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: auto;
  z-index:4;
  
}
.form-signin .checkbox {
  font-weight: 400;
  
}
.form-signin .form-control {
  position: relative;
  box-sizing: border-box;
  height: auto;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;  
}
.form-signin input[type="password"] {
  margin-bottom: 10px;

}
#particles-js
{
  width:100%;
  height:100vh;
  position:absolute;
  z-index:0;
}
/*google login*/
*, *:before, *:after {
  box-sizing: border-box;
}
.g-sign-in-button {
  padding:4px;
  display: inline-block;
  width: 100%;
  height: 50px;
  background-color: #fff;
  color: #000;
  border-radius: 1px;
  box-shadow: 0 2px 4px 0 rgba(0,0,0,.25);
  transition: background-color .218s, border-color .218s, box-shadow .218s;
}
.g-sign-in-button:hover {
  cursor: pointer;
  -webkit-box-shadow: 0 0 3px 3px rgba(66,133,244,.3);
  box-shadow: 0 0 3px 3px rgba(66,133,244,.3);
}

.g-sign-in-button .content-wrapper {
  height: 100%;
  width: 100%;
  border: 1px solid transparent;
}
.g-sign-in-button img {
    width: 18px;
    height: 18px;
}
.g-sign-in-button .logo-wrapper {
   padding-top: 9px;
   background:#fff;
   width: 48px;
   height: 100%;
   border-radius: 1px; 
   display: inline-block;
}
.g-sign-in-button .text-container {
    font-family: Roboto,arial,sans-serif;
    font-weight: 500;
    letter-spacing: .21px;
    font-size: 16px;
    line-height: 48px;
    vertical-align: top;
    border: none;
    display: inline-block;
    text-align: center;
    width: 180px;
}

</style>

<?php 
if($this->session->flashdata('invalid_user')){
 echo '
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Login failed!</strong> Invalid user id or password.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
if($this->session->flashdata('mailsend')){
  echo '
 <div class="alert alert-success alert-dismissible fade show" role="alert">
   <strong>Success!</strong> Check your email for password reset.
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
     <span aria-hidden="true">&times;</span>
   </button>
 </div>';
 }
if($this->session->flashdata('unregistered_email')){
    echo '
   <div class="alert alert-danger alert-dismissible fade show" role="alert">
     <strong>Login failed!</strong> invalid email id.
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </button>
   </div>';
   }
?>
<?php

$email=$this->input->get('email');
$old_pass=$this->input->get('pa');



?>
<form action="<?php echo base_url('Home/reset_pass_process'); ?>" method="post" class="form-signin text-center" oninput='new_password.setCustomValidity(new_password.value != confirm_password.value ? "Passwords do not match." : "")' >
<div class="mt-5">
      <img class="mb-4" src="<?php echo base_url('assets/image/marthoma.png'); ?>" alt="" width="90" height="94" />
      <h1 class="h3 mb-3 font-weight-normal">Reset Your Password</h1>
      <label for="inputEmail" class="sr-only">New Password</label>
      <input type="hidden" name="email" value="<?php echo $email; ?>">
      <input type="hidden" name="old_pass" value="<?php echo $old_pass; ?>">

      <input type="password" name="new_password" class="form-control" placeholder="New Password" required autofocus>
      <label for="inputPassword" class="sr-only">Confirm Password</label>
      <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" required>
      <div class="checkbox mb-3">
        <label>
           Don't need to reset? <a href="<?php echo base_url('Home/login'); ?>"> Go Back</a>
        </label>
      </div>
      <input class="btn btn-lg btn-primary btn-block" type="submit" value="Sign in" name="u_login">
      <div class="row mt-3 mb-3"><hr class="col-3"><div class="col-2">OR</div><hr class="col-3"></div>

      <div class="google-btn mb-3">
      <?php
require 'google-api/vendor/autoload.php';

// Creating new google client instance
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


?>
        <a class='g-sign-in-button' href="<?php echo $client->createAuthUrl(); ?>">
          <div class="content-wrappe"r>
            <div class='logo-wrapper'>  
              <img src='https://developers.google.com/identity/images/g-logo.png'>
            </div>  
            <span class='text-container'> 
              <span>Sign in with Google</span>
            </span>
          </div>  
        </a>

      </div>
    </div>
     
</form>
<div id=particles-js>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="<?php echo base_url('assets/particles_js/particles.js'); ?>"></script>
<script src="<?php echo base_url('assets/particles_js/demo/js/app.js'); ?>"></script>


