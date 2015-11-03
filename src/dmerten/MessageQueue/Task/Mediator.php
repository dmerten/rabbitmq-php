<?php
/**
 *
 * @author Dirk Merten
 */

namespace dmerten\MessageQueue\Task;


use dmerten\MessageQueue\Connection;
use dmerten\MessageQueue\Event;
use PhpAmqpLib\Message\AMQPMessage;

/**
 * Class Mediator
 *
 * @package dmerten\MessageQueue\Task
 */
class Mediator extends Connection {

	/**
	 * @param $queueName
	 * @param Event $event
	 */
	public function sendEvent($queueName, Event $event) {
		$this->channel->basic_publish(new AMQPMessage(serialize($event)), '', $queueName);
	}

}
