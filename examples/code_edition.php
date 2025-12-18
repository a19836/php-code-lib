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

include_once __DIR__ . "/config.php";

echo $style;
?>
<h1>PHP Code Editor Lib</h1>
<p>Edit Code Components</p>

<div class="note">
		<span>
		This library edits PHP code components programmatically.<br/>
		<br/>
		Some features:<br/>
		<ul style="display:inline-block; text-align:left;">
			<li>Add, edit, rename, or remove classes.</li>
			<li>Add or remove class properties.</li>
			<li>Add, edit, rename, or remove functions and methods.</li>
			<li>Modify namespaces, use statements, and includes.</li>
			<li>Edit class and function comments.</li>
			<li>Inject inline code into files or functions.</li>
		</ul>
		</span>
</div>

<h2>Usage:</h2>

<h5>Init:</h5>
<div class="code short">
	<textarea readonly>
include dirname(__DIR__) . "/lib/app.php";
include get_lib("phpscript.PHPCodePrintingHandler");

$file_path = "/tmp/php/test.php";
$code = file_get_contents($file_path); //some php code, encapsulated with php tags
	</textarea>
</div>

<h5>Edit Class:</h5>
<div class="code short">
	<textarea readonly>
$class_code = PHPCodePrintingHandler::getClassString($class_settings);

$status = PHPCodePrintingHandler::addClassToFile($file_path, $class_settings);
$status = PHPCodePrintingHandler::editClassFromFile($file_path, $old_class_settings, $new_class_settings);
$status = PHPCodePrintingHandler::renameClassFromFile($file_path, $old_class_path, $new_class_path);
$status = PHPCodePrintingHandler::removeClassFromFile($file_path, $class_path);
	</textarea>
</div>

<h5>Edit Class Property:</h5>
<div class="code short">
	<textarea readonly>
//Class properties
$prop_code = PHPCodePrintingHandler::getClassPropertyString($property_settings);

$status = PHPCodePrintingHandler::addClassPropertiesToFile($file_path, $class_path, $code);
$status = PHPCodePrintingHandler::removeClassPropertiesFromFile($file_path, $class_path);
	</textarea>
</div>

<h5>Edit Function/Method:</h5>
<div class="code short">
	<textarea readonly>
//If is a class method, instead of a function, then set the correspondent $class_path var.
$code = PHPCodePrintingHandler::getFunctionString($function_settings, $belongs_to_class = false);
$status = PHPCodePrintingHandler::addFunctionToFile($file_path, $function_settings, $class_path = 0);
$status = PHPCodePrintingHandler::editFunctionFromFile($file_path, $old_func_settings, $new_func_settings, $class_path = 0);
$status = PHPCodePrintingHandler::renameFunctionFromFile($file_path, $old_func_name, $new_func_name, $class_path = 0);
$status = PHPCodePrintingHandler::removeFunctionFromFile($file_path, $func_name, $class_path = 0);
	</textarea>
</div>

<h5>Edit Namespace/Use/Include:</h5>
<div class="code">
	<textarea readonly>
//Namespace
$status = PHPCodePrintingHandler::addNamespacesToFile($file_path, $namespaces);
$status = PHPCodePrintingHandler::replaceNamespaceFromFile($file_path, $old_namespace, $new_namespace);
$status = PHPCodePrintingHandler::removeNamespacesFromFile($file_path);
$status = PHPCodePrintingHandler::removeNamespaceFromFile($file_path, $namespace);

//Use
$status = PHPCodePrintingHandler::addUsesToFile($file_path, $uses);
$status = PHPCodePrintingHandler::removeUsesFromFile($file_path);
$status = PHPCodePrintingHandler::removeUseFromFile($file_path, $use);

//Includes
$status = PHPCodePrintingHandler::addIncludesToFile($file_path, $includes);
$status = PHPCodePrintingHandler::removeIncludesFromFile($file_path);
$status = PHPCodePrintingHandler::removeIncludeFromFile($file_path, $include);
	</textarea>
</div>

<h5>Edit Comments:</h5>
<div class="code short">
	<textarea readonly>
//Comments
$status = PHPCodePrintingHandler::editClassCommentsFromFile($file_path, $class_path, $comments);
$status = PHPCodePrintingHandler::editFunctionCommentsFromFile($file_path, $func_name, $comments, $class_path = 0); //If is a class method, instead of a function, then set the correspondent $class_path var.
	</textarea>
</div>

<h5>Edit Inline Code - in functions/methods:</h5>
<div class="code short">
	<textarea readonly>
$status = PHPCodePrintingHandler::addCodeToBeginOfFile($file_path, $code);
$status = PHPCodePrintingHandler::addCodeToBeginOfFileOrAfterFirstNamespace($file_path, $code);
$status = PHPCodePrintingHandler::replaceFunctionCodeFromFile($file_path, $func_name, $code, $class_path = 0); //If is a class method, instead of a function, then set the correspondent $class_path var.
	</textarea>
</div>
