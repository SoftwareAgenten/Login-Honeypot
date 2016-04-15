<?php

include_once('great-attractor/system.php');

ga_init('index');
ga_register_visit();
ga_register_request();

if (isset($_POST['email'])) {
  ga_register_form_data($_POST);
}

?><!doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Login</title>
    <link rel="stylesheet" href="data/assets/styles.css">
  </head>
  <body>
    <h1>Login</h1>
    
    <form method="post">
      <label for="email">Email Address</label>
      <input type="email" name="email" id="email">
      
      <label for="password">Password</label>
      <input type="password" name="password" value="" id="password">
      
      <input type="submit" />
    </form>
    
    <p><a href="register.php">Register</a></p>
  </body>
</html>