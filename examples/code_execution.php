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
<h1>PHP Code Execution Lib</h1>
<p>Executes Code</p>

<div class="note">
		<span>
		This library executes PHP code dynamically with fine-grained control.<br/>
		<br/>
		Some features:<br/>
		<ul style="display:inline-block; text-align:left;">
			<li>Execute PHP code via `eval`.</li>
			<li>Execute PHP code via temporary include files.</li>
			<li>Capture output, return values, and modified variables.</li>
			<li>Inject external variables into executed code.</li>
			<li>Ignore undefined variable errors when needed.</li>
			<li>Safely handle execution failures.</li>
		</ul>
		</span>
</div>

<h2>Usage:</h2>

<h5>Execute PHP Code based in eval:</h5>
<div>Executes HTML with PHP code.</div>
<div class="code short">
	<textarea readonly>
include dirname(__DIR__) . "/lib/app.php";
include get_lib("phpscript.PHPScriptHandler");

$contents = 'Hello&lt;?= " My"; ?&gt; World';
$output = PHPScriptHandler::parseContent($contents);
echo "output: $output<br/>";
	</textarea>
</div>
<div class="code output one-line">
	<textarea readonly>
output: Hello My World
	</textarea>
</div>

<h5>Execute PHP Code with error control:</h5>
<div>Executes HTML with PHP code but ignore errors if a PHP variable is not defined.</div>
<div class="code">
	<textarea readonly>
include dirname(__DIR__) . "/lib/app.php";
include get_lib("phpscript.PHPScriptHandler");

$contents = '&lt;? 
	$path .= "Foo"; 
	echo "Hello World"; 
	return 234;
?&gt;. Some other html...';
$return_values = array();
$external_vars = array(
	"path" => "/tmp/kj2213"
);
$ignore_undefined_vars_error = true; //if true then PHPScriptHandler::parseContent sets the error handler to 'ignore_undefined_var_error_handler' function.

$output = PHPScriptHandler::parseContent($contents, $external_vars, $return_values, $ignore_undefined_vars_error);
echo "output: $output<br/>";
echo "external_vars: " . print_r($external_vars, true) . "<br/>";
echo "return_values: " . print_r($return_values, true) . "<br/>";

function ignore_undefined_var_error_handler($errno, $errstr, $errfile, $errline) {
	$is_undefined_var_error = preg_match('/^(Undefined array key|Undefined global variable|Undefined variable|Trying to access array offset on value of type null|Trying to access array offset on null)/', $errstr)
	
	if ($is_undefined_var_error)
		return true; //true to ignore error. Don't execute PHP internal error handler, this is, ignore it.
	else
		return error_handler($errno, $errstr, $errfile, $errline);
}
	</textarea>
</div>
<div class="code output short">
	<textarea readonly>
output: Hello World. Some other html...
external_vars: array(
	"path" => "/tmp/kj2213Foo"
)
return_values: array(234)
	</textarea>
</div>

<h5>Execute PHP Code based in include file:</h5>
<div>The difference between this method and the parseContent method, is that, if there is an error in some php statement of the $contents, this method returns an empty result, because the error will be catched with no return string. Instead of the parseContent method, that executes each php statement separately returning the rest of the result and only giving error in the catched php statement with error.</div>
<div class="code">
	<textarea readonly>
include dirname(__DIR__) . "/lib/app.php";
include get_lib("phpscript.PHPScriptHandler");

$contents = '&lt;? 
	$_GET["bar"] = "Foo";
?&gt;Some html...';
$output = PHPScriptHandler::parseContentWithIncludeFile($contents, $external_vars = array(), $return_values = array(), $ignore_undefined_vars_error = false);
echo "output: $output<br/>";
echo "external_vars: " . print_r($external_vars, true) . "<br/>";
echo "return_values: " . print_r($return_values, true) . "<br/>";
echo "_GET: " . print_r($_GET, true) . "<br/>";
	</textarea>
</div>
<div class="code output short">
	<textarea readonly>
output: Hello World. Some other html...
external_vars: array()
return_values: array()
_GET: array(
	"bar" => "Foo"
)
	</textarea>
</div>

