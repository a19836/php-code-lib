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
<h1>PHP Beautifier Lib</h1>
<p>Beautify Code</p>

<div class="note">
		<span>
		This library improves PHP code readability automatically.<br/>
		It does not beautify HTML! It simply beautifies PHP code.<br/>
		<br/>
		Some features:<br/>
		<ul style="display:inline-block; text-align:left;">
			<li>Beautify PHP code embedded in HTML.</li>
			<li>Properly indent PHP blocks.</li>
			<li>Improve readability without changing logic.</li>
			<li>Detect formatting issues and report them.</li>
		</ul>
		</span>
</div>

<h5>Usage:</h5>
<div class="code">
	<textarea readonly>
include dirname(__DIR__) . "/lib/app.php";
include get_lib("phpscript.PHPCodeBeautifier");

$contents = '<h1>test</h1>Hello &lt;? $x=0;if(false){return true;}$x = "World"; ?&gt;...';

$PHPCodeBeautifier = new PHPCodeBeautifier();
$pretty_contents = $PHPCodeBeautifier->beautifyCode($contents);

$status = $PHPCodeBeautifier->getStatus(); //boolean
$error = $PHPCodeBeautifier->getError(); //Exception | null error while formatting the code
$issues = $PHPCodeBeautifier->getIssues(); //array, textual description of code formatting problems

echo $pretty_contents;
	</textarea>
</div>
<div class="code output short">
	<textarea readonly>
Hello &lt;?php
$x = 0;
if (false) {
	return true;
}
$x = "World";
?&gt;...
	</textarea>
</div>
