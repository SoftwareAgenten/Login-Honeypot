<?php

/*
 * Great Attractor
 * https://github.com/SoftwareAgenten/Great-Attractor
 *
 * Part of the "Software-Agenten im Internet" project.
 * https://github.com/SoftwareAgenten/
 *
 * The MIT License (MIT)
 * Copyright © 2016 Florian Pircher <http://addpixel.net>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the “Software”), to
 * deal in the Software without restriction, including without limitation the
 * rights to use, copy, modify, merge, publish, distribute, sublicense, and/or
 * sell copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED “AS IS”, WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS
 * IN THE SOFTWARE.
 */

define('DS', DIRECTORY_SEPARATOR);

session_start();
error_reporting(-1);

// Mark Admins
if (isset($_GET['thisisanadmin']) && $_GET['thisisanadmin'] == '1') {
  $_SESSION['thisisanadmin'] = true;
}

function ga_register_visit($page_name)
{
  // Do not Track Admins
  if ($_SESSION['thisisanadmin'] === true) {
    return;
  }
  
  // This is not an Admin
  $filename = "$page_name.json";
  $file = join(DS, array(__DIR__, '..', 'data', 'stats', 'click_count', $filename));
  $data = new stdClass();
  $data->count = 0;
  
  if (file_exists($file)) {
    $data = json_decode(file_get_contents($file));
  }
  
  $data->count += 1;
  
  file_put_contents($file, json_encode($data));
}