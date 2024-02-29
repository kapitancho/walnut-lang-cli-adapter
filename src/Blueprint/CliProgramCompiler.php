<?php

namespace Walnut\Lang\NativeConnector\Cli\Blueprint;

use Walnut\Lang\Blueprint\Compilation\Source;

interface CliProgramCompiler {
	public function compileCliProgram(
        Source $source,
        string $entryPointName = 'main'
    ): CliEntryPoint;
}