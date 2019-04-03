<?php

namespace Unit;

class RecursiveRequire
{
	const REGEX_ANY_DOT_PHP = '/^.+\.php$/i';

	private $pathToRootDir;
	private $filenameRegex;

	public function __construct(
		$pathToRootDir,
		$filenameRegex = self::REGEX_ANY_DOT_PHP
	) {
		$this->pathToRootDir = $pathToRootDir;
		$this->filenameRegex = $filenameRegex;
	}

	public function requireAll($once = true)
	{
		$dirIterator = new \RecursiveDirectoryIterator($this->pathToRootDir);
		$recursiveIterator = new \RecursiveIteratorIterator($dirIterator);
		$filesIterator = new \RegexIterator($recursiveIterator, $this->filenameRegex, \RecursiveRegexIterator::GET_MATCH);

		$matches = iterator_to_array($filesIterator);
		
		foreach ($matches as list($file)) {
			$once ? require_once($file) : require($file);
		}
	}
}