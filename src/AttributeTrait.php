<?php

namespace Jhesyong\Attribute;

trait AttributeTrait
{
	protected $attributeContext = null;

	/**
	 * Return a value => label array
	 *
	 * @return array
	 */
	abstract protected function getOptions($context = null);

	public function setContext($context)
	{
		$this->attributeContext = $context;
	}

	protected function getData()
	{
		$data = $this->getOptions($this->attributeContext);

		$this->attributeContext = null;

		return $data;
	}

	public function hasKey($key)
	{
		$data = $this->getData();

		return array_key_exists($key, $data);
	}

	public function label($key)
	{
		$data = $this->getData();

		if ( ! array_key_exists($key, $data)) {
			return null;
		}

		return $data[$key];
	}

	public function hashArray($withEmpty = false, $emptyMessage = null)
	{
		$data = $this->getData();

		$emptyMessage = $emptyMessage === null ? 'Please Select' : $emptyMessage;

		if ($withEmpty) {
			$data = ['' => $emptyMessage] + $data;
		}

		return $data;
	}

	public function pairArray($withEmpty = false, $emptyMessage = null)
	{
		$data = $this->getData();

		$emptyMessage = $emptyMessage === null ? 'Please Select' : $emptyMessage;

		if ($withEmpty) {
			$data = ['' => $emptyMessage] + $data;
		}

		return array_map(
			function($label, $value) { return ['label' => $label, 'value' => $value]; },
			$data,
			array_keys($data)
		);
	}

	public function keys()
	{
		$data = $this->getData();

		return array_keys($data);
	}
}