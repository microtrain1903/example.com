<?php
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
  
  <div>
  <label for="name">Name</label>
    <input id="name" type="text" name="name" value="{$valid->userInput('name')}">
    <div class="text-error">{$valid->error('name')}</div>
  </div>

  <div>
    <label for="email">Email</label>
    <input id="email" type="text" name="email" value="{$valid->userInput('email')}">
    <div class="text-error">{$valid->error('email')}</div>
  </div>

  <div>
    <label for="message">Message</label>
    <textarea id="message" name="message">{$valid->userInput('message')}</textarea>
    <div class="text-error">{$valid->error('message')}</div>
  </div>

  <div>
    <input type="submit" value="Send">
  </div>

</form>
EOT;

require '../core/layout.php';

