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
<style>
.code textarea {height:400px;}
.code.short textarea {height:200px;}
</style>

<h1>PHP Obfuscator Lib</h1>
<p>Ofuscate Code</p>

<div class="note">
		<span>
		This library protects your PHP source code by converting it into non-readable code.<br/>
		<br/>
		Some features:<br/>
		<ul style="display:inline-block; text-align:left;">
			<li>Obfuscate classes, methods, properties, and functions.</li>
			<li>Strip comments and PHPDoc blocks.</li>
			<li>Obfuscate variable names and strings.</li>
			<li>Apply per-file, per-class, or per-method rules.</li>
			<li>Preserve functionality while hiding implementation details.</li>
			<li>Ignore specific files, folders, or serialized content.</li>
			<li>Add copyright headers to obfuscated files.</li>
		</ul>
		</span>
</div>

<h5>Usage:</h5>
<div class="code">
	<textarea readonly>
include dirname(__DIR__) . "/lib/app.php";
include get_lib("phpscript.PHPCodeObfuscator");

//set file options to be applied in the obfuscated files
$opts = array(
	"strip_comments" => 1,
	"strip_doc_comments" => 1;
	"copyright" => '/*
* Copyright (c) 2025 Bloxtor (http://bloxtor.com) and Joao Pinto (http://jplpinto.com)
*/'
	//... other configurations
);

//set files settings
$files_settings = array(
	//set default configurations for all files inside of folder
	"/some/folder/" => array(
		1 => array(
			"save_path" => "/tmp/obfuscated_folder/",
			"all_functions" => array("obfuscate_code" => 1),
			"all_properties" => array("obfuscate_name_private" => 1),
			"all_methods" => array("obfuscate_code" => 1, "obfuscate_name_private" => 1),
		),
	),
	
	//overwrite main folder configurations, for class Foo
	"/some/folder/a/Foo.php" => array(
		"Foo" => array(
			"all_properties" => array("obfuscate_name_private" => 0), //do not obfuscate private properties
			"methods" => array(
				"methodNameA" => array("obfuscate_encapsed_string" => 1, "ignore_local_variables" => array('$objs', '$vars')), //obfuscate vars inside of strings, but ignore following variables: '$objs', '$vars'
				"methodNameB" => array("obfuscate_encapsed_string" => 1), //obfuscate all vars inside of strings
				"methodNameC" => array("obfuscate_code" => 0), //do not obfuscate code for this method
			),
		),
	),
	
	//overwrite main folder configurations, for class Bar
	"/some/folder/a/Bar.php" => array(
		"Bar" => array(
			"methods" => array(
				"methodNameA" => array("obfuscate_name" => 0), //Do not obfuscate this method name. Note that this method is private.
			),
		),
	),
	
	//overwrite main folder configurations, for functions inside of following file
	"/some/folder/b/some_utils.php" => array(
		"0" => array(
			"my_function_a" => array("obfuscate_code" => 0), //do not obfuscate code for this function
			"my_function_b" => array("obfuscate_encapsed_string" => 1), //obfuscate all vars inside of strings
		),
	),
	
	//overwrite main folder configurations, for following folder
	"/some/folder/c/" => array(
		1 => array(
			"skip" => true, //Do not run obfuscation for this folder
			//other configurations here...
		)
	),
	
	//... other settings
);

//ignore serialized files
$serialized_files = array( 
	"/some/folder/a/sers/", //ignore folder
	"/some/folder/b/some_serialized_file.ser", //ignore file
);

//ignore warnings for following files
$avoid_warnings_for_files = array(
	"/some/folder/a/Foo.php",
	"/some/folder/a/Bar.php",
);

//obfuscate files
$PHPCodeObfuscator = new PHPCodeObfuscator($files_settings, $serialized_files);
$status = $PHPCodeObfuscator->obfuscateFiles($opts);

$warning_msg = $PHPCodeObfuscator->getIncludesWarningMessage($avoid_warnings_for_files);
$errors = $PHPCodeObfuscator->getErrors();
	</textarea>
</div>
<div class="code output short">
	<textarea readonly>
Example of a obfuscated file:
&lt;?php
/*
 * Copyright (c) 2025 Bloxtor (http://bloxtor.com) and Joao Pinto (http://jplpinto.com)
 */
class BeanProperty { const AK = "2wIDAQAB"; public $name; public $value = false; public $reference = false; public function __construct($v5e813b295b, $v67db1bd535 = false, $v6da63250f5 = false) { $this->name = trim($v5e813b295b); $this->value = $v67db1bd535; $this->reference = $v6da63250f5; $this->f085037e150(); } private function f085037e150() { if(empty($this->name)) { launch_exception(new BeanPropertyException(1, $this->name)); return false; } elseif($this->value && $this->reference) { launch_exception(new BeanPropertyException(2, array($this->value, $this->reference))); return false; } return true; } } ?&gt;
	</textarea>
</div>
