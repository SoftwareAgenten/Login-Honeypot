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

// ===========
// = Utility =
// ===========

function make_path($components, $force_create)
{
  $path = join(DS, $components);
  
  if ($force_create && !file_exists($path)) {
    mkdir($path, 0755, true);
  }
  
  return $path;
}

// ==========
// = Config =
// ==========

$config = new stdClass();
$config->geopluginEndpoint = 'http://www.geoplugin.net/json.gp?ip=';
$config->geoFields = array(
  'geoplugin_credit' => 'credit',
  'geoplugin_city' => 'city',
  'geoplugin_region' => 'region',
  'geoplugin_areaCode' => 'areaCode',
  'geoplugin_dmaCode' => 'dmaCode',
  'geoplugin_countryCode' => 'countryCode',
  'geoplugin_countryName' => 'countryName',
  'geoplugin_continentCode' => 'continentCode',
  'geoplugin_latitude' => 'latitude',
  'geoplugin_longitude' => 'longitude',
  'geoplugin_regionCode' => 'regionCode',
  'geoplugin_regionName' => 'regionName'
);

$paths = new stdClass();
$paths->root = make_path(array(__DIR__, '..'));
$paths->data = make_path(array($paths->root, 'data'), true);
$paths->stats = make_path(array($paths->data, 'stats'), true);
$paths->requests = make_path(array($paths->data, 'requests'), true);

// ===============
// = Mark Admins =
// ===============

if (isset($_GET['thisisanadmin']) && $_GET['thisisanadmin'] == '1') {
  $_SESSION['thisisanadmin'] = true;
}

// =================
// = Register Data =
// =================

function ga_register_request($page_name)
{
}

function ga_register_visit($page_name)
{
  global $config, $paths;
  
  // Do not Track Admins
  if ($_SESSION['thisisanadmin'] === true) {
    return;
  }
  
  // This is not an Admin
  $filename = "$page_name.json";
  $location = make_path(array($paths->stats, 'click_count'), true);
  $file = make_path(array($location, $filename));
  $data = new stdClass();
  $data->count = 0;
  
  if (file_exists($file)) {
    $data = json_decode(file_get_contents($file));
  }
  
  $data->count += 1;
  
  file_put_contents($file, json_encode($data));
}