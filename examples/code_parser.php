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
<h1>PHP Code Parser Lib</h1>
<p>Parse Code Components</p>

<div class="note">
		<span>
		This library parses PHP code into logical components for inspection and automation.<br/>
		<br/>
		Some features:<br/>
		<ul style="display:inline-block; text-align:left;">
			<li>Detect classes from files, folders, or raw strings.</li>
			<li>Parse PHP tokens using `token_get_all`.</li>
			<li>Extract class metadata (name, namespace, path).</li>
			<li>Retrieve class properties, methods, and functions.</li>
			<li>Extract function/method code or raw bodies.</li>
			<li>Read namespaces, use statements, and includes.</li>
			<li>Extract and remove comments or PHPDoc blocks.</li>
		</ul>
		</span>
</div>

<h2>Usage</h2>

<h5>Init:</h5>
<div class="code short">
	<textarea readonly>
include dirname(__DIR__) . "/lib/app.php";
include get_lib("phpscript.PHPCodePrintingHandler");

$folder_path = "/tmp/php";
$file_path = "$folder_path/test.php";
$code = file_get_contents($file_path); //some php code, encapsulated with php tags
	</textarea>
</div>

<h5>Get Classes:</h5>
<div class="code short">
	<textarea readonly>
$classes_by_file_path = PHPCodePrintingHandler::getPHPClassesFromFolder($folder_path); //Get classes from folder - only 1 level
$classes_by_file_path = PHPCodePrintingHandler::getPHPClassesFromFolderRecursively($folder_path); //Get classes from folder and sub-folders - all levels
$classes = PHPCodePrintingHandler::getPHPClassesFromFile($file_path); //Get classes from file
$classes = PHPCodePrintingHandler::getPHPClassesFromString($code); //Get classes from code

$tokens = token_get_all($code);
$classes = PHPCodePrintingHandler::getPHPClassesFromTokens($tokens); //Get classes from tokens
	</textarea>
</div>

<h5>Get Class Components:</h5>
<div class="code">
	<textarea readonly>
if (key($classes) == 0)
	next($classes);

$class_path = key($classes);
$class_name = $classes[$class_path]["name"];

$array = PHPCodePrintingHandler::decoupleClassNameWithNameSpace($class_path); //Return array("class_name" => $class_path, "namespace" => $namespace, "name" => $class_name)

$class_path = PHPCodePrintingHandler::prepareClassNameWithNameSpace($class_name, $namespace = ""); //Return string class name together with namespace
$class_path = PHPCodePrintingHandler::getClassPathFromClassName($file_path, $class_name); //The $class_name may be without namespace.

$class_components = PHPCodePrintingHandler::getClassOfFile($file_path); //get class components with the same name than the file name
$class_components = PHPCodePrintingHandler::getClassFromFile($file_path, $class_path); //Get class components from file.
$class_components = PHPCodePrintingHandler::getClassFromPHPClasses($classes, $class_path); //Get class components from classes array.
$class_components = PHPCodePrintingHandler::searchClassFromPHPClasses($classes, $class_path); //Search class in classes and return its components.
	</textarea>
</div>

<h5>Get Class Properties:</h5>
<div class="code short">
	<textarea readonly>
$property_components = PHPCodePrintingHandler::getClassPropertyFromFile($file_path, $class_path, $prop_name);
$properties_components = PHPCodePrintingHandler::getClassPropertiesFromFile($file_path, $class_path);
$properties_components = PHPCodePrintingHandler::getClassPropertiesFromString($contents, $class_path);
	</textarea>
</div>

<h5>Get Function/Method Components:</h5>
<div class="code short">
	<textarea readonly>
//If is a class method, instead of a function, then set the correspondent $class_path var.
$function_components = PHPCodePrintingHandler::getFunctionFromFile($file_path, $func_name, $class_path = 0);
$function_components = PHPCodePrintingHandler::getFunctionFromString($code, $func_name, $class_path = 0);
$function_components = PHPCodePrintingHandler::getFunctionCodeFromFile($file_path, $func_name, $class_path = 0, $raw = false);
$function_components = PHPCodePrintingHandler::getFunctionCodeFromString($code, $func_name, $class_path = 0, $raw = false);
	</textarea>
</div>

<h5>Get Namespaces/Uses/Includes:</h5>
<div class="code">
	<textarea readonly>
//Namespaces
$namespaces = PHPCodePrintingHandler::getNamespacesFromFile($file_path); //Return array with namespaces names

//Uses
$uses = PHPCodePrintingHandler::getUsesFromFile($file_path); //Return associative array key-value pair, where keys are use-name and values are use-alias

//Includes
$includes_components = PHPCodePrintingHandler::getIncludesFromFile($file_path); //Return array with other arrays like: array($code_or_path, $is_once)
	</textarea>
</div>

<h5>Get Comments:</h5>
<div class="code short">
	<textarea readonly>
$comments = $class_components["comments"];
$doc_comments = $class_components["doc_comments"];

$code = PHPCodePrintingHandler::getCodeWithoutCommentsFromFile($file_path);
$code = PHPCodePrintingHandler::getCodeWithoutComments($code);
	</textarea>
</div>
