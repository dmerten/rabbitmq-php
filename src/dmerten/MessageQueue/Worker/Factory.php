<?php
/**
 *
 * @author Dirk Merten
 */

namespace dmerten\MessageQueue\Worker;


use dmerten\MessageQueue\Worker\Dispatcher\AmqpMessageParser;
use dmerten\MessageQueue\Worker\Dispatcher\Dispatcher;
use PhpAmqpLib\Connection\AMQPStreamConnection;

/**
 * Class Factory
 *
 * @package dmerten\MessageQueue\Worker
 */
class Factory {

	/**
	 * @param $host
	 * @param $port
	 * @param $userName
	 * @param $password
	 * @param null $logger
	 * @return Worker
	 */
	public function getWorker($host, $port, $userName, $password, $logger = null) {
		$connection = new AMQPStreamConnection($host, $port, $userName, $password);
		return new Worker($connection, new Dispatcher(new AmqpMessageParser()), $logger);
	}

}
