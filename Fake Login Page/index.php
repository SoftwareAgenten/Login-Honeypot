<?php

include_once('great-attractor/system.php');

ga_register_visit('index');
ga_register_request('index');

?><!doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Login</title>
    <link rel="stylesheet" href="data/assets/styles.css">
  </head>
  <body>
    <h1>Login</h1>
    
    <form action="post">
      <label for="email">Email Address</label>
      <input type="email" name="email" id="email">
      
      <label for="password">Password</label>
      <input type="password" name="password" value="" id="password">
      
      <input type="submit" />
    </form>
    
    <p><a href="register.php">Register</a></p>
  </body>
</html>