<?php

$var = '0';
var_dump(!empty($var));
 
$var = 0;
var_dump(!empty($var));

$var = 5;
var_dump(!empty($var));

$var = -5;
var_dump(!empty($var));
 
$var = '';
var_dump(empty($var));
 
$var = FALSE;
var_dump(empty($var));
 
$var = NULL;
var_dump(empty($var));
 
var_dump(empty($bien_khong_ton_tai));