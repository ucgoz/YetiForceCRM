<?php
/**
 * Class to change configuration.
 *
 * @copyright YetiForce Sp. z o.o
 * @license   YetiForce Public License 3.0 (licenses/LicenseEN.txt or yetiforce.com)
 * @author    Tomasz Kur <t.kur@yetiforce.com>
 */

namespace App;

/**
 * Changes configuration in files.
 */
class Configurator extends Base
{
	/** @var string[] Paths to files */
	private static $paths = [
		'yetiforce' => 'config/modules/YetiForce.php'
	];

	/** @var string Type of configuration */
	private $type;

	/** @var string Content configuration */
	private $content;

	/**
	 * Constructor.
	 *
	 * @param string $type
	 */
	public function __construct($type)
	{
		$this->type = $type;
	}

	/**
	 * Write configuration to file.
	 */
	public function save()
	{
		$this->content = $fileContent = file_get_contents(self::$paths[$this->type]);
		foreach ($this->getData() as $fieldName => $fieldValue) {
			$replacement = sprintf("'%s' => %s,", $fieldName, Utils::varExport($fieldValue));
			$fileContent = preg_replace('/\'' . $fieldName . '\'[\s]+=>([^\n]+),/', $replacement, $fileContent);
		}
		file_put_contents(self::$paths[$this->type], $fileContent);
		Cache::resetOpcache();
	}

	/**
	 * Revert changes.
	 */
	public function revert()
	{
		if ($this->content) {
			file_put_contents(self::$paths[$this->type], $this->content);
		}
	}
}
