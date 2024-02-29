<?php

namespace Walnut\Lang\NativeConnector\Cli\Implementation;

use Walnut\Lang\Blueprint\Compilation\ProgramCompilationContext;
use Walnut\Lang\Blueprint\Compilation\Source;
use Walnut\Lang\NativeConnector\Cli\Blueprint\CliEntryPoint;
use Walnut\Lang\NativeConnector\Cli\Blueprint\CliProgramCompiler;

final readonly class CliProgramCompilerAdapter implements CliProgramCompiler {
	public function __construct(
        private ProgramCompilationContext $programCompilationContext
	) {}

	public function compileCliProgram(Source $source, string $entryPointName = 'main'): CliEntryPoint {
		return new CliAdapter(
            $this->programCompilationContext->compileProgram($source),
            $this->programCompilationContext->nativeCodeContext(),
			$entryPointName
		);
	}
}