<?php
/**
 *
 * @author Dirk Merten
 */

namespace tests\dmerten\MessageQueue\Worker;


use dmerten\MessageQueue\Worker\Worker;

class WorkerTest extends \PHPUnit_Framework_TestCase {

	public function testDispatch() {
		$connection = $this->getMockBuilder('\PhpAmqpLib\Connection\AMQPStreamConnection')->disableOriginalConstructor()->getMock();
		$channel = $this->getMockBuilder('\PhpAmqpLib\Channel\AMQPChannel')->disableOriginalConstructor()->getMock();

		$connection->expects($this->once())->method('channel')->will($this->returnValue($channel));
		$dispatcher = $this->getMockBuilder('\dmerten\MessageQueue\Worker\Dispatcher\Dispatcher')->disableOriginalConstructor()->getMock();
		$dispatcher->expects($this->once())->method('dispatch');
		$worker = new Worker($connection, $dispatcher);

		$message = $this->getMockBuilder('\PhpAmqpLib\Message\AMQPMessage')->disableOriginalConstructor()->getMock();

		$message->delivery_info['channel'] = new Foo();
		$message->delivery_info['delivery_tag'] = 'foo';

		$worker->dispatch($message);
	}

	public function testDispatchFailed() {
		$connection = $this->getMockBuilder('\PhpAmqpLib\Connection\AMQPStreamConnection')->disableOriginalConstructor()->getMock();
		$channel = $this->getMockBuilder('\PhpAmqpLib\Channel\AMQPChannel')->disableOriginalConstructor()->getMock();

		$connection->expects($this->once())->method('channel')->will($this->returnValue($channel));
		$dispatcher = $this->getMockBuilder('\dmerten\MessageQueue\Worker\Dispatcher\Dispatcher')->disableOriginalConstructor()->getMock();
		$dispatcher->expects($this->once())->method('dispatch')->will($this->throwException(new \RuntimeException()));
		$worker = new Worker($connection, $dispatcher);

		$message = $this->getMockBuilder('\PhpAmqpLib\Message\AMQPMessage')->disableOriginalConstructor()->getMock();

		$message->delivery_info['channel'] = new Foo();
		$message->delivery_info['delivery_tag'] = 'foo';

		$worker->dispatch($message);
	}

}

Class Foo {
	public function basic_ack() {
	}
}
