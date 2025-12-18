<?php
/*
 * Copyright (c) 2025 Bloxtor (http://bloxtor.com) and Joao Pinto (http://jplpinto.com)
 * 
 * Multi-licensed: BSD 3-Clause | Apache 2.0 | GNU LGPL v3 | HLNC License (http://bloxtor.com/LICENSE_HLNC.md)
 * Choose one license that best fits your needs.
 *
 * Original PHP Code Lib Repo: https://github.com/a19836/php-code-lib/
 * Original Bloxtor Repo: https://github.com/a19836/bloxtor
 *
 * YOU ARE NOT AUTHORIZED TO MODIFY OR REMOVE ANY PART OF THIS NOTICE!
 */

include_once __DIR__ . "/config.php";

echo $style;
?>
<h1>PHP Code Validator Lib</h1>
<p>Validates Code</p>

<div class="note">
		<span>
		This library validates PHP code safely in different execution modes.<br/>
		<br/>
		Some features:<br/>
		<ul style="display:inline-block; text-align:left;">
			<li>Validate raw PHP code syntax.</li>
			<li>Validate PHP embedded inside HTML.</li>
			<li>Validate code without executing it (syntax-only).</li>
			<li>Validate code by executing it with controlled error handling.</li>
			<li>Validate PHP code via URL execution.</li>
			<li>Validate PHP code via command line (CLI).</li>
		</ul>
		</span>
</div>

<h2>Usage:</h2>

<h5>Validates PHP code:</h5>
<div>Validates a PHP code. The code should not have php tags, but instead should be the php code it-self.<br/>
Note that this function will execute the php code, which may give some PHP errors and stop executing the script.</div>
<div class="code short">
	<textarea readonly>
include dirname(__DIR__) . "/lib/app.php";
include get_lib("phpscript.PHPScriptHandler");

$code = '
	echo "Foo";
	return false;
';
$is_valid = PHPScriptHandler::isValidPHPCode($code, $error_message = "");

echo $is_valid ? "OK" : $error_message;
	</textarea>
</div>

<h5>Validates HTML with PHP code - Do not execute code:</h5>
<div>Note that this function only check the php syntax. Do not executes the code.<br/>
It needs the PhpParser library previous included.</div>
<div class="code short">
	<textarea readonly>
include dirname(__DIR__) . "/lib/app.php";
include get_lib("phpscript.PHPScriptHandler");

$contents = '&lt;? 
	echo "Hello World";
?&gt;. Some other html...';
$is_valid = PHPScriptHandler::isValidPHPContents($contents, $error_message = "");

echo $is_valid ? "OK" : $error_message;
	</textarea>
</div>

<h5>Validates HTML with PHP code, by executing the code:</h5>
<div>Note that this function will execute the php code, which may give some PHP errors and stop executing the script.</div>
<div class="code short">
	<textarea readonly>
include dirname(__DIR__) . "/lib/app.php";
include get_lib("phpscript.PHPScriptHandler");

$contents = '&lt;? 
	//echo $_GET["foo"]; //This will give an error beacause there is no variable: $_GET["foo"]
	echo "Hello World";
?&gt;. Some other html...';
$is_valid = PHPScriptHandler::isValidPHPContents2($contents, $error_message = "");

echo $is_valid ? "OK" : $error_message;
	</textarea>
</div>

<h5>Validates HTML with PHP code from URL:</h5>
<div>Note that this function will execute the php code, which may give some PHP errors and stop executing the script.<br/>
Send $contents to the url page through curl and check if the answer is == 1. Othewise is not valid.<br/>
The idea is to have a file that calls the isValidPHPContentsViaUrl which will call another file (via URL) which will include the php code and echo "1". The first file will check then the request's response and if it is == 1, the code is valid, otherwise it shows the error.</div>
<div class="code short">
	<textarea readonly>
include dirname(__DIR__) . "/lib/app.php";
include get_lib("phpscript.PHPScriptHandler");

$contents = '&lt;? 
	echo "Hello World";
?&gt;';
$is_valid = PHPScriptHandler::isValidPHPContentsViaUrl($url, $contents, $error_message = "", $connection_timeout = 0);

echo $is_valid ? "OK" : $error_message;
	</textarea>
</div>

<h5>Validates HTML with PHP code via command line:</h5>
<div>Note that this function only check the php syntax. Do not executes the code.<br/>
Server must have the php command line defined. Otherwise you can use the methods isValidPHPContents or printPHPContentsViaUrl + isValidPHPContentsViaUrl. </div>
<div class="code short">
	<textarea readonly>
include dirname(__DIR__) . "/lib/app.php";
include get_lib("phpscript.PHPScriptHandler");

$contents = '&lt;? 
	echo $_GET["foo"];
?&gt;';
$is_valid = PHPScriptHandler::isValidPHPContentsViaCommandLine($contents, $error_message = "");

echo $is_valid ? "OK" : $error_message;
	</textarea>
</div>

<h5>Validates and prints PHP Code via url:</h5>
<div>Note that this function will execute the php code, which may give some PHP errors and stop executing the script.<br/>
The idea is use this function together with the isValidPHPContentsViaUrl method, where the url called through the isValidPHPContentsViaUrl method will point to this function.<br/>
To be used for request containing code in 'php://input', this is, this method receives $code from POST, create a temp file with it, include file, catch all outputs and at the end returns "1". If echo 1 is the only thing printed, it means the code is correct.<br/>
Note that this function should not return anything bc if there is a php syntax error, apache will stop executing the code at the "include" line and echo the php error.</div>
<div class="code short">
	<textarea readonly>
include dirname(__DIR__) . "/lib/app.php";
include get_lib("phpscript.PHPScriptHandler");

$is_valid = PHPScriptHandler::printPHPContentsViaUrl();

echo $is_valid ? "OK" : $error_message;
	</textarea>
</div>

