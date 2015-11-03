<?php
/**
 *
 * @author Dirk Merten
 */

namespace dmerten\MessageQueue\Worker\Dispatcher;


use dmerten\MessageQueue\Listener;
use dmerten\MessageQueue\Event;
use PhpAmqpLib\Message\AMQPMessage;

/**
 * Class Dispatcher
 *
 * @package dmerten\MessageQueue\Worker
 */
class Dispatcher {

	/**
	 * @var Listener[]
	 */
	private $listeners = [];
	/**
	 * @var AmqpMessageParser
	 */
	private $parser;

	/**
	 * Dispatcher constructor.
	 *
	 * @param AmqpMessageParser $parser
	 */
	public function __construct(AmqpMessageParser $parser) {
		$this->parser = $parser;
	}

	/**
	 * @param Listener $listener
	 */
	public function registerListener(Listener $listener) {
		$this->listeners[$listener->getEventType()][] = $listener;
	}


	/**
	 * @param AMQPMessage $amqpMessage
	 */
	public function dispatch(AMQPMessage $amqpMessage) {
		try {
			$event = $this->parser->getEventByMessage($amqpMessage);
			$listeners = $this->getListenersByEventType($event);
			foreach ($listeners as $listener) {
				$listener->dispatch($event);
			}

		} catch (InvalidEventException $ex) {
			throw new \RuntimeException('Can not dispatch message. Message body is invalid');
		}
	}

	/**
	 * @param \dmerten\MessageQueue\Event $event
	 * @return Listener[]
	 */
	private function getListenersByEventType(Event $event) {
		return isset($this->listeners[$event->getType()]) ? $this->listeners[$event->getType()] : [];
	}
}
