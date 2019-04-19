<?php
require '../bootstrap.php';
require '../core/processContactForm.php';

$meta=[];
$meta['title']="Contact Me";
$meta['description']="My contact page";
$meta['keywords']=false;

$content=<<<EOT
<h1>Contact Me - YOUR-NAME</h1>
{$message}
<form action="contact.php" method="POST">
  
  <input type="hidden" name="subject" value="New submission!">
  
  <div class="form-group">
    <label for="name">Name</label>
    <input class="form-control" id="name" type="text" name="name" value="{$valid->userInput('name')}">
    <div class="text-danger">{$valid->error('name')}</div>
  </div>

  <div class="form-group">
    <label for="email">Email</label>
    <input class="form-control" id="email" type="text" name="email" value="{$valid->userInput('email')}">
    <div class="text-danger">{$valid->error('email')}</div>
  </div>

  <div class="form-group">
    <label for="message">Message</label>
    <textarea class="form-control" id="message" name="message">{$valid->userInput('message')}</textarea>
    <div class="text-danger">{$valid->error('message')}</div>
  </div>

  <div class="form-group">
    <input class="btn btn-primary" type="submit" value="Send">
  </div>

</form>
EOT;

require '../core/layout.php';

