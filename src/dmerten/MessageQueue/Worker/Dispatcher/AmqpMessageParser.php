<?php
/**
 *
 * @author Dirk Merten
 */

namespace dmerten\MessageQueue\Worker\Dispatcher;


use dmerten\MessageQueue\Event;
use PhpAmqpLib\Message\AMQPMessage;

/**
 * Class AmqpMessageParser
 *
 * @package dmerten\MessageQueue\Worker\Dispatcher
 */
class AmqpMessageParser {


	/**
	 * @param AMQPMessage $message
	 * @return \dmerten\MessageQueue\Event
	 * @throws InvalidEventException
	 */
	public function getEventByMessage(AMQPMessage $message) {
		$event = unserialize($message->body);

		if (!($event instanceof Event)) {
			throw new InvalidEventException();
		}

		return $event;
	}

}
