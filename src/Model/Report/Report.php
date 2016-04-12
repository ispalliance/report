<?php

namespace Tlapnet\Report\Model\Report;

use Tlapnet\Report\Exceptions\Logic\InvalidStateException;
use Tlapnet\Report\Model\Subreport\Metadata;
use Tlapnet\Report\Model\Subreport\Subreport;
use Tlapnet\Report\Utils\Suggestions;

class Report
{

	/** @var mixed */
	protected $rid;

	/** @var Subreport[] */
	protected $subreports = [];

	/** @var Metadata */
	protected $metadata;

	/**
	 * @param mixed $rid
	 */
	public function __construct($rid)
	{
		$this->rid = $rid;
		$this->metadata = new Metadata();
	}

	/**
	 * @return mixed
	 */
	public function getRid()
	{
		return $this->rid;
	}

	/**
	 * @param Subreport $subreport
	 */
	public function addSubreport(Subreport $subreport)
	{
		$this->subreports[$subreport->getSid()] = $subreport;
	}

	/**
	 * @return Subreport[]
	 */
	public function getSubreports()
	{
		return $this->subreports;
	}

	/**
	 * @param string $sid
	 * @return Subreport
	 */
	public function getSubreport($sid)
	{
		if ($this->hasSubreport($sid)) {
			return $this->subreports[$sid];
		}

		$hint = Suggestions::getSuggestion(array_map(function (Subreport $subreport) {
			return $subreport->getSid();
		}, $this->subreports), $sid);

		throw new InvalidStateException("Subreport '$sid' not found" . ($hint ? ", did you mean '$hint'?" : '.'));
	}

	/**
	 * @param string $bid
	 * @return bool
	 */
	public function hasSubreport($bid)
	{
		return isset($this->subreports[$bid]);
	}

	/**
	 * METADATA ****************************************************************
	 */

	/**
	 * @param string $key
	 * @param mixed $value
	 */
	public function setOption($key, $value)
	{
		$this->metadata->set($key, $value);
	}

	/**
	 * @param string $key
	 * @param mixed $default
	 * @return mixed
	 */
	public function getOption($key, $default = NULL)
	{
		if (func_num_args() < 2) {
			return $this->metadata->get($key);
		} else {
			return $this->metadata->get($key, $default);
		}
	}

	/**
	 * @param string $key
	 * @return bool
	 */
	public function hasOption($key)
	{
		return $this->metadata->has($key);
	}


}