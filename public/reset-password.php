<?php
require '../core/session.php';
checkSession();

$meta=[];
$meta['title']="Reset Password";

$content=<<<EOT
<h1>Reset Password</h1>
{$message}
<form action="contact.php" method="POST">
  

  <div class="form-group">
    <label for="name">Current Password</label>
    <input 
      class="form-control" 
      id="current_password" 
      type="password" 
      name="current_password">
  </div>

  <div class="form-group">
    <label for="password">New Password</label>
    <input 
      class="form-control" 
      id="password" 
      type="password" 
      name="password">
  </div>

  <div class="form-group">
    <label for="confirm_password">Confirm Password</label>
    <input 
      class="form-control" 
      id="confirm_passwor" 
      type="password" 
      name="confirm_passwor">
  </div>

  <div class="form-group">
    <input class="btn btn-primary" type="submit" value="Send">
  </div>

</form>
EOT;

require '../core/layout.php';

