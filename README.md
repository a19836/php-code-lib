# PHP Code Lib

> Original Repos:   
> - PHP Code Lib: https://github.com/a19836/php-code-lib/   
> - Bloxtor: https://github.com/a19836/bloxtor/

## Overview

**PHP Code Lib** is a comprehensive library for analyzing, validating, executing, editing, beautifying, and obfuscating PHP code.  
It is designed for advanced code introspection, automation, refactoring, security hardening, and developer tooling.

This library allows you to safely inspect and manipulate PHP source code at a structural level. You can extract classes, properties, methods, functions, namespaces, comments, and dependencies from files, folders, raw strings, or tokens. It also provides powerful utilities to validate syntax, execute code in controlled environments, beautify formatting, and obfuscate source code for distribution or protection.   

The library allows you to:   
- Parse PHP code into structured components (classes, methods, properties, functions).
- Extract namespaces, use statements, includes, and comments.
- Edit PHP source code programmatically.
- Validate PHP syntax safely with multiple strategies.
- Execute PHP code securely with error control.
- Beautify PHP code for readability.
- Obfuscate PHP code to protect intellectual property.
- Work with PHP embedded in HTML.
- Operate on single files, folders, or recursive directory structures.

This library provides a powerful foundation for building advanced PHP developer tools, code automation platforms, and secure execution environments.

To see a working example, open [index.php](index.php) on your server.

---

## Typical Use Cases

- Static code analysis tools
- Low-code / no-code platforms: currently being used on [Bloxtor](https://www.bloxtor.com)
- PHP IDE extensions
- Code generators like [Bloxtor](https://www.bloxtor.com)
- Secure execution sandboxes
- Automated refactoring tools
- Code obfuscation and IP protection
- Documentation and API extractors

---

## PHP Code Lib Tools

### PHP Code Parser

Parse PHP code into logical components for inspection and automation.

Some features:
- Detect classes from files, folders, or raw strings.
- Parse PHP tokens using `token_get_all`.
- Extract class metadata (name, namespace, path).
- Retrieve class properties, methods, and functions.
- Extract function/method code or raw bodies.
- Read namespaces, use statements, and includes.
- Extract and remove comments or PHPDoc blocks.

### PHP Code Editor

Edit PHP code components programmatically.

Some features:
- Add, edit, rename, or remove classes.
- Add or remove class properties.
- Add, edit, rename, or remove functions and methods.
- Modify namespaces, use statements, and includes.
- Edit class and function comments.
- Inject inline code into files or functions.

### PHP Code Validator

Validate PHP code safely in different execution modes.

Some features:
- Validate raw PHP code syntax.
- Validate PHP embedded inside HTML.
- Validate code without executing it (syntax-only).
- Validate code by executing it with controlled error handling.
- Validate PHP code via URL execution.
- Validate PHP code via command line (CLI).

### PHP Code Execution

Execute PHP code dynamically with fine-grained control.

Some features:
- Execute PHP code via `eval`.
- Execute PHP code via temporary include files.
- Capture output, return values, and modified variables.
- Inject external variables into executed code.
- Ignore undefined variable errors when needed.
- Safely handle execution failures.

### PHP Code Beautifier

Improve PHP code readability automatically.

Some features:
- Beautify PHP code embedded in HTML.
- Properly indent PHP blocks.
- Improve readability without changing logic.
- Detect formatting issues and report them.

### PHP Code Obfuscator

Protect your PHP source code by converting it into non-readable code.

Some features:
- Obfuscate classes, methods, properties, and functions.
- Strip comments and PHPDoc blocks.
- Obfuscate variable names and strings.
- Apply per-file, per-class, or per-method rules.
- Preserve functionality while hiding implementation details.
- Ignore specific files, folders, or serialized content.
- Add copyright headers to obfuscated files.

---

## Usage

### Validate Code:

See more examples [here](examples/code_validation.php)

```php
include __DIR__ . "/lib/app.php";
include get_lib("phpscript.PHPScriptHandler");

$is_valid_1 = PHPScriptHandler::isValidPHPCode('echo "Foo";return false;', $error_message_1 = "");
$is_valid_2 = PHPScriptHandler::isValidPHPContents('Hello&lt;?= " My"; ?&gt; World', $error_message_2 = "");

echo $is_valid_1 && $is_valid_2 ? "OK" : "$error_message_1\n$error_message_2";
```

### Execute Code:

See more examples [here](examples/code_execution.php)

```php
include __DIR__ . "/lib/app.php";
include get_lib("phpscript.PHPScriptHandler");

$contents = 'Hello&lt;?= " My"; ?&gt; World';
$output = PHPScriptHandler::parseContent($contents);
```

### Beautify Code:

See more examples [here](examples/code_beautify.php)

```php
include __DIR__ . "/lib/app.php";
include get_lib("phpscript.PHPCodeBeautifier");

$PHPCodeBeautifier = new PHPCodeBeautifier();

$contents = 'Hello &lt;? $x=0;if(false){return true;}$x = "World"; ?&gt;...';
$pretty_contents = $PHPCodeBeautifier->beautifyCode($contents);
```

### Parse Code:

See more examples [here](examples/code_parser.php)

```php
include __DIR__ . "/lib/app.php";
include get_lib("phpscript.PHPCodePrintingHandler");

$classes = PHPCodePrintingHandler::getPHPClassesFromFile($file_path); //Get classes from file
$classes_by_file_path = PHPCodePrintingHandler::getPHPClassesFromFolderRecursively($folder_path); //Get classes from folder and sub-folders

//... To get other components, read more at `examples/code_parser.php`
```

### Edit Code:

See more examples [here](examples/code_edition.php)

```php
include __DIR__ . "/lib/app.php";
include get_lib("phpscript.PHPCodePrintingHandler");

$status = PHPCodePrintingHandler::addClassToFile($file_path, $class_settings);
$status = PHPCodePrintingHandler::editClassFromFile($file_path, $old_class_settings, $new_class_settings);
$status = PHPCodePrintingHandler::renameClassFromFile($file_path, $old_class_path, $new_class_path);
$status = PHPCodePrintingHandler::removeClassFromFile($file_path, $class_path);

//... To edit other components, read more at `examples/code_edition.php`
```

### Obfuscate Code:

See more examples [here](examples/code_obfuscation.php)

```php
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
```

