<?php
/*
 * Copyright (c) 2025 Bloxtor (http://bloxtor.com) and Joao Pinto (http://jplpinto.com)
 * 
 * Multi-licensed: BSD 3-Clause | Apache 2.0 | GNU LGPL v3 | HLNC License (http://bloxtor.com/LICENSE_HLNC.md)
 * Choose one license that best fits your needs.
 *
 * Original PHP Code Lib Repo: https://github.com/a19836/phpcodelib/
 * Original Bloxtor Repo: https://github.com/a19836/bloxtor
 *
 * YOU ARE NOT AUTHORIZED TO MODIFY OR REMOVE ANY PART OF THIS NOTICE!
 */

include_once __DIR__ . "/examples/config.php";

echo $style;
?>
<h1>PHP Code Lib</h1>
<p>Validate, Execute, Obfuscate Beautify, Parse and Edit PHP Code</p>

<div class="note">
		<span>
		This library validates, execute, obfuscates, beautifies, parses and edit PHP code.<br/>
		With this library, users can get the classes, properties, methods, function from a file, get comments from a method, remove comments from a specific code or edit other code components, beautify PHP-HTML-CSS-JS code, obfuscate code, check if code is valid, execute code in a secure way and much more...<br/>
		<br/>
		This library analyzes, validates, executes, edits, beautifies, and obfuscates PHP code.<br/>  
		It is designed for advanced code introspection, automation, refactoring, security hardening, and developer tooling.<br/>
		<br/>
		This library allows you to safely inspect and manipulate PHP source code at a structural level. You can extract classes, properties, methods, functions, namespaces, comments, and dependencies from files, folders, raw strings, or tokens. It also provides powerful utilities to validate syntax, execute code in controlled environments, beautify formatting, and obfuscate source code for distribution or protection.   <br/>
		<br/>
		The library allows you to:<br/>
		<ul style="display:inline-block; text-align:left;">
			<li>Parse PHP code into structured components (classes, methods, properties, functions).</li>
			<li>Extract namespaces, use statements, includes, and comments.</li>
			<li>Edit PHP source code programmatically.</li>
			<li>Validate PHP syntax safely with multiple strategies.</li>
			<li>Execute PHP code securely with error control.</li>
			<li>Beautify PHP code for readability.</li>
			<li>Obfuscate PHP code to protect intellectual property.</li>
			<li>Work with PHP embedded in HTML.</li>
			<li>Operate on single files, folders, or recursive directory structures.</li>
		</ul>
		<br/>
		This library provides a powerful foundation for building advanced PHP developer tools, code automation platforms, and secure execution environments.
		</span>
</div>

<div style="text-align:center;">
	<div style="display:inline-block; text-align:left;">
		<div>Some tutorials:</div>
		<ul>
			<li><a href="examples/code_validation.php" target="code_validation">PHP Code Validator Lib</a>: Learn how to validate code before before execution.</li>
			<li><a href="examples/code_execution.php" target="code_execution">PHP Code Execution Lib</a>: Learn how to execute code in a secure way.</li>
			<li><a href="examples/code_beautify.php" target="code_beautify">PHP Code Beautifier Lib</a>: Learn how to indent code to make it more user-friendly and readable.</li>
			<li><a href="examples/code_parser.php" target="code_parser">PHP Code Parser Lib</a>: Learn how to parse code into components, like names and types of classes, properties, methods, comments...</li>
			<li><a href="examples/code_edition.php" target="code_edition">PHP Code Editor Lib</a>: Learn how to edit code components, like names and types of classes, properties, methods, comments...</li>
			<li><a href="examples/code_obfuscation.php" target="code_obfuscation">PHP Code Obfuscator Lib</a>: Learn how to convert code into non-readable code.</li>
		</ul>
	</div>
</div>

<h2>Usage:</h2>

<h5>Validate code:</h5>
<div>See more examples <a href="examples/code_validation.php" target="code_validation">here</a>.</div>
<div class="code short">
	<textarea readonly>
include __DIR__ . "/lib/app.php";
include get_lib("phpscript.PHPScriptHandler");

$is_valid_1 = PHPScriptHandler::isValidPHPCode('echo "Foo";return false;', $error_message_1 = "");
$is_valid_2 = PHPScriptHandler::isValidPHPContents('Hello&lt;?= " My"; ?&gt; World', $error_message_2 = "");

echo $is_valid_1 && $is_valid_2 ? "OK" : "$error_message_1\n$error_message_2";
	</textarea>
</div>

<h5>Execute code:</h5>
<div>See more examples <a href="examples/code_execution.php" target="code_execution">here</a>.</div>
<div class="code short">
	<textarea readonly>
include __DIR__ . "/lib/app.php";
include get_lib("phpscript.PHPScriptHandler");

$contents = 'Hello&lt;?= " My"; ?&gt; World';
$output = PHPScriptHandler::parseContent($contents);
	</textarea>
</div>

<h5>Beautify code:</h5>
<div>See more examples <a href="examples/code_beautify.php" target="code_beautify">here</a>.</div>
<div class="code short">
	<textarea readonly>
include __DIR__ . "/lib/app.php";
include get_lib("phpscript.PHPCodeBeautifier");

$PHPCodeBeautifier = new PHPCodeBeautifier();

$contents = 'Hello &lt;? $x=0;if(false){return true;}$x = "World"; ?&gt;...';
$pretty_contents = $PHPCodeBeautifier->beautifyCode($contents);
	</textarea>
</div>

<h5>Parse Code</h5>
<div>See more examples <a href="examples/code_parser.php" target="code_parser">here</a>.</div>
<div class="code short">
	<textarea readonly>
include __DIR__ . "/lib/app.php";
include get_lib("phpscript.PHPCodePrintingHandler");

$classes = PHPCodePrintingHandler::getPHPClassesFromFile($file_path); //Get classes from file
$classes_by_file_path = PHPCodePrintingHandler::getPHPClassesFromFolderRecursively($folder_path); //Get classes from folder and sub-folders

//... To get other components, read more at `examples/code_parser.php`
	</textarea>
</div>

<h5>Edit Code</h5>
<div>See more examples <a href="examples/code_edition.php" target="code_edition">here</a>.</div>
<div class="code short">
	<textarea readonly>
include __DIR__ . "/lib/app.php";
include get_lib("phpscript.PHPCodePrintingHandler");

$status = PHPCodePrintingHandler::addClassToFile($file_path, $class_settings);
$status = PHPCodePrintingHandler::editClassFromFile($file_path, $old_class_settings, $new_class_settings);
$status = PHPCodePrintingHandler::renameClassFromFile($file_path, $old_class_path, $new_class_path);
$status = PHPCodePrintingHandler::removeClassFromFile($file_path, $class_path);

//... To edit other components, read more at `examples/code_edition.php`
	</textarea>
</div>

<h5>Obfuscate Code</h5>
<div>See more examples <a href="examples/code_obfuscation.php" target="code_obfuscation">here</a>.</div>
<div class="code">
	<textarea readonly>
include __DIR__ . "/lib/app.php";
include get_lib("phpscript.PHPCodeObfuscator");

$files_settings = array(
	//set default configurations for all files inside of folder
	"/some/folder/" => array(
		1 => array(
			"save_path" => "/tmp/obfuscated_folder/",
			"all_functions" => array("obfuscate_code" => 1),
			"all_properties" => array("obfuscate_name_private" => 1),
			"all_methods" => array("obfuscate_code" => 1, "obfuscate_name_private" => 1),
		),
	)
);
$PHPCodeObfuscator = new PHPCodeObfuscator($files_settings);
$status = $PHPCodeObfuscator->obfuscateFiles(null);
	</textarea>
</div>
