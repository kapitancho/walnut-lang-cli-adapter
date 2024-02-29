<?php

use Walnut\Lang\Blueprint\Compilation\Source;
use Walnut\Lang\Implementation\Registry\ProgramBuilderFactory;
use Walnut\Lang\NativeConnector\Cli\Implementation\CliProgramCompilerAdapter;
use Walnut\Lang\Implementation\Compilation\ProgramCompilationContext;

require_once __DIR__ . '/vendor/autoload.php';

$input = $argv ?? [];
array_shift($input);
$source = array_shift($input);
$sources = [];

$sourceRoot = __DIR__ . '/walnut-src';

foreach(glob("$sourceRoot/*.nut") as $sourceFile) {
	$sources[] = str_replace('.nut', '', basename($sourceFile));
}
if (!in_array($source, $sources, true)) {
	$source = 'demo-cli';
}

$content = (new CliProgramCompilerAdapter(
    new ProgramCompilationContext(
        new ProgramBuilderFactory()
    )
))->compileCliProgram(
    new Source($sourceRoot, $source)
)->execute(... $input);

echo $content;
