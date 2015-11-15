<?php
namespace dmerten\MessageQueue;

use dmerten\MessageQueue\Worker\Dispatcher\InvalidEventException;

/**
 *
 * @author Dirk Merten
 */
abstract class Listener
{

	/**
	 * returns  __NAMESPACE_\__CLASS__
	 *
	 * @return string
	 */
	abstract public function getEventType();

	/**
	 * Do your task in this method
	 *
	 * @param Event $event
	 * @return mixed
	 */
	abstract protected function run(Event $event);

	/**
	 * @param Event $event
	 * @return mixed
	 * @throws InvalidEventException
	 */
	public function dispatch(Event $event)
	{
		if ($event->getType() !== $this->getEventType()) {
			throw new InvalidEventException();
		}

		return $this->run($event);
	}

}
