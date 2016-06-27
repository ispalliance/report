<?php

namespace Tlapnet\Report\Model\Parameters\Parameter;

final class SelectParameter extends Parameter
{

	/** @var array */
	private $items = [];

	/** @var bool */
	private $useKeys = TRUE;

	/**
	 * @param string $name
	 */
	public function __construct($name)
	{
		parent::__construct($name, Parameter::TYPE_SELECT);
	}

	/**
	 * GETTERS / SETTERS *******************************************************
	 */

	/**
	 * @return array
	 */
	public function getItems()
	{
		return $this->items;
	}

	/**
	 * @param array $items
	 */
	public function setItems(array $items)
	{
		$this->items = $items;
	}

	/**
	 * @param string $value
	 */
	public function setValue($value)
	{
		$value = trim($value);

		if ($this->useKeys === TRUE) {
			// Set value representing as key
			if (array_key_exists($value, $this->items)) {
				$this->value = $value;
			}
		} else {
			// Set value representing by his key
			if (isset($this->items[$value])) {
				$this->value = $this->items[$value];
			}
		}
	}

	/**
	 * @param bool $use
	 */
	public function setUseKeys($use)
	{
		$this->useKeys = (bool)$use;
	}

	/**
	 * @return boolean
	 */
	public function isUseKeys()
	{
		return $this->useKeys;
	}

}