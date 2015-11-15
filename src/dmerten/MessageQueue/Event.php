<?php
/**
 *
 * @author Dirk Merten
 */

namespace dmerten\MessageQueue;


/**
 * Class Event
 *
 * @package dmerten\MessageQueue\Task
 */
abstract class Event
{
	/**
	 * @var array
	 */
	private $params = [];

	/**
	 * Event constructor.
	 *
	 * @param array $params
	 */
	public function __construct(array $params = [])
	{
		$this->params = $params;
	}

	/**
	 * @return int
	 */
	public function getType()
	{
		return get_class($this);
	}

	/**
	 * @return array
	 */
	public function getParams()
	{
		return $this->params;
	}

}
