<?php
namespace dmerten\MessageQueue;

use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;

/**
 *
 * @author Dirk Merten
 */
abstract class Connection
{

	/**
	 * @var AMQPStreamConnection
	 */
	protected $connection;
	/**
	 * @var AMQPChannel
	 */
	protected $channel;


	/**
	 * @param AMQPStreamConnection $connection
	 */
	public function __construct(AMQPStreamConnection $connection)
	{
		$this->connection = $connection;
		$this->configureChannel();
	}

	/**
	 * @return void
	 */
	public function __destruct()
	{
		$this->channel->close();
		$this->connection->close();
	}

	/**
	 * @return void
	 */
	protected function configureChannel()
	{
		$this->channel = $this->connection->channel();
	}

}
