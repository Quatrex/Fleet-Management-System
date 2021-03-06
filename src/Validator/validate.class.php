<?php

namespace Validator;

class Validate
{
	private $_passed = false,
		$_errors = array();

	public function __construct()
	{
	}

	/**
	 * Check validity
	 * 
	 * @param string $source
	 * @param array $items name => rules array
	 */
	public function check($source, $items = array())
	{
		foreach ($items as $item => $rules) {
			foreach ($rules as $rule => $rule_value) {
				$value = $source[$item];
				$item = htmlentities($item, ENT_QUOTES, 'UTF-8');

				if ($rule === 'required' && empty($value)) {
					$this->addError("{$item} is required");
				} else if (!empty($value)) {
					switch ($rule) {
						case 'min':
							if (strlen($value) < $rule_value) {
								$this->addError("{$item} must be a minimum of {$rule_value} characters.");
							}
							break;
						case 'max':
							if (strlen($value) > $rule_value) {
								$this->addError("{$item} must be a maximum of {$rule_value} characters.");
							}
							break;
						case 'matches':
							if ($value != $source[$rule_value]) {
								$this->addError("{$rule_value} must match {$item}.");
							}
							break;
						case 'unique':
							break;
						case 'regex':
							if (!preg_match(
								$rule_value,
								$value
							)) {
								$this->addError("{$item} is not valid.");
							}
							break;
					}
				}
			}
		}

		if (empty($this->_errors)) {
			$this->_passed = true;
		}

		return $this;
	}

	private function addError($error)
	{
		$this->_errors[] = $error;
	}

	public function errors()
	{
		return $this->_errors;
	}

	public function passed()
	{
		return $this->_passed;
	}
}
