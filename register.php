<?php

include_once('great-attractor/system.php');

ga_init('register');
ga_register_visit();
ga_register_request();

if (isset($_POST['email'])) {
  ga_register_form_data($_POST);
}

?><!doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Register</title>
    <link rel="stylesheet" href="assets/styles.css">
  </head>
  <body>
    <h1>Register</h1>
    
    <form method="post">
      <label for="fn">First Name</label>
      <input type="text" name="fn" value="" id="fn">
      
      <label for="last_name">Last Name</label>
      <input type="text" name="last_name" value="" id="last_name">
      
      <label for="email">Email Address</label>
      <input type="email" name="email" id="email">
      
      <label for="password">Password</label>
      <input type="password" name="password" value="" id="password">
      
      <label for="repeatpassword">Repeat Password</label>
      <input type="password" name="repeatpassword" value="" id="repeatpassword">
      
      <label for="captcha">What is 4 + 2?</label>
      <input type="text" name="captcha" value="" id="captcha">
      
      <input type="submit" />
    </form>
  </body>
</html>