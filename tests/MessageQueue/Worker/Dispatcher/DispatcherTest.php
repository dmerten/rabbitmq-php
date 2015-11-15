<?php
/**
 *
 * @author Dirk Merten
 */

namespace tests\dmerten\MessageQueue\Worker\Dispatcher;


use dmerten\MessageQueue\Worker\Dispatcher\Dispatcher;
use dmerten\MessageQueue\Worker\Dispatcher\InvalidEventException;
use PhpAmqpLib\Message\AMQPMessage;

class DispatcherTest extends \PHPUnit_Framework_TestCase
{


	public function testRegisterListener()
	{
		$this->markTestSkipped('TODO');
		/**
		 * $event = new RefreshFundCache();
		 * $parser = $this->getMockBuilder('\dmerten\MessageQueue\Worker\Dispatcher\AmqpMessageParser')->disableOriginalConstructor()->getMock();
		 * $parser->expects($this->once())->method('getEventByMessage')->will($this->returnValue($event));
		 * $dispatcher = new Dispatcher($parser);
		 *
		 * $listener = $this->getMockBuilder('\dmerten\Import\FundCache')->disableOriginalConstructor()->getMock();
		 * $listener->expects($this->once())->method('getEventType')->will($this->returnValue($event->getType()));
		 * $listener->expects($this->once())->method('dispatch');
		 * $dispatcher->registerListener($listener);
		 *
		 * $message = $this->getMessage();
		 * $dispatcher->dispatch($message);
		 * **/
	}

	/**
	 * @return AMQPMessage
	 */
	private function getMessage()
	{
		$event = new RefreshFundCache();
		$message = new AMQPMessage(serialize($event));
		return $message;
	}

	public function testInvalidMessage()
	{
		$this->setExpectedException('\RuntimeException');
		$parser = $this->getMockBuilder('\dmerten\MessageQueue\Worker\Dispatcher\AmqpMessageParser')->disableOriginalConstructor()->getMock();
		$parser->expects($this->once())->method('getEventByMessage')->will($this->throwException(new InvalidEventException()));
		$dispatcher = new Dispatcher($parser);
		$dispatcher->dispatch(new AMQPMessage());
	}
}
