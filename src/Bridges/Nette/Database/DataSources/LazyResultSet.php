<?php

namespace Tlapnet\Report\Bridges\Nette\Database\DataSources;

use Nette\Database\ResultSet;
use Tlapnet\Report\Model\Data\Result;

class LazyResultSet extends Result
{

	/** @var ResultSet */
	private $resultset;

	/**
	 * @param ResultSet $resultset
	 */
	public function __construct(ResultSet $resultset)
	{
		parent::__construct([]);
		$this->resultset = $resultset;
	}

	/**
	 * @return array
	 */
	public function getData()
	{
		return $this->resultset->fetchAll();
	}

}