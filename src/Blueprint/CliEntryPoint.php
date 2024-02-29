<?php

namespace Walnut\Lang\NativeConnector\Cli\Blueprint;

interface CliEntryPoint {
	public function execute(string ... $values): string;
}