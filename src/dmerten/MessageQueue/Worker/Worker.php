<?php
namespace dmerten\MessageQueue\Worker;

use dmerten\MessageQueue\Connection;
use dmerten\MessageQueue\Listener;
use dmerten\MessageQueue\Worker\Dispatcher\Dispatcher;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

/**
 *
 * @author Dirk Merten
 */
class Worker extends Connection {
	/**
	 * @var Dispatcher
	 */
	private $dispatcher;
	/**
	 * @var \Attrax_Logger_LoggerInterface
	 */
	private $logger = null;

	/**
	 * @param AMQPStreamConnection $connection
	 * @param Dispatcher $dispatcher
	 * @param $logger
	 */
	public function __construct(AMQPStreamConnection $connection, Dispatcher $dispatcher, $logger = null) {
		$this->logger = $logger;
		$this->dispatcher = $dispatcher;
		parent::__construct($connection);
	}

	/**
	 * @param Listener $listener
	 */
	public function registerListener(Listener $listener) {
		$this->dispatcher->registerListener($listener);
	}

	/**
	 * @param $queueName
	 */
	public function listen($queueName) {
		$this->log('debug', 'Listen to queue ' . $queueName);
		$this->channel->basic_consume($queueName, '', false, false, false, false, [$this, 'dispatch']);

		while (count($this->channel->callbacks)) {
			$this->channel->wait();
		}
	}

	/**
	 * @return void
	 */
	protected function configureChannel() {
		$this->log('debug', 'Configure channel');
		parent::configureChannel();
		$this->channel->basic_qos(null, 1, null);
	}


	/**
	 * @param AMQPMessage $message
	 */
	public function dispatch(AMQPMessage $message) {
		$this->log('debug', 'Dispatching message');
		try {
			$this->dispatcher->dispatch($message);
		} catch(\RuntimeException $e) {
			$this->log('debug', 'Message body is invalid. Skipping message');
		}

		$message->delivery_info['channel']->basic_ack($message->delivery_info['delivery_tag']);
		$this->log('debug', 'Message dispatched');
	}

	/**
	 * @param string $type
	 * @param string $message
	 */
	private function log($type, $message) {
		if ($this->logger !== null) {
			$this->logger->log($type, $message);
		}
	}

}
