<?php

namespace Walnut\Lang\NativeConnector\Cli\Implementation;

use RuntimeException;
use Walnut\Lang\Blueprint\Execution\Program;
use Walnut\Lang\Blueprint\Identifier\VariableNameIdentifier;
use Walnut\Lang\Blueprint\NativeCode\NativeCodeContext;
use Walnut\Lang\Blueprint\Value\StringValue;
use Walnut\Lang\NativeConnector\Cli\Blueprint\CliEntryPoint;

final readonly class CliAdapter implements CliEntryPoint {
	public function __construct(
		private Program $program,
        private NativeCodeContext $nativeCodeContext,
		private string $entryPointName = 'main'
	) {}

	public function execute(string ...$values): string {
		$result = $this->program->callFunction(
			new VariableNameIdentifier($this->entryPointName),
			$this->nativeCodeContext->typeRegistry->array(
                $this->nativeCodeContext->typeRegistry->string()
            ),
			$this->nativeCodeContext->typeRegistry->string(),
			$this->nativeCodeContext->valueRegistry->list(array_map(
				fn(string $value) => $this->nativeCodeContext->valueRegistry->string($value),
				$values
			))
		);
		return $result instanceof StringValue ?
			$result->literalValue() :
			throw new RuntimeException(
				sprintf("Invalid result type: '%s'. String expected", $result::class)
			);
	}

}