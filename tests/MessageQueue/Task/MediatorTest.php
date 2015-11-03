<?php
/**
 *
 * @author Dirk Merten
 */

namespace tests\dmerten\MessageQueue\Task;


use dmerten\MessageQueue\Task\Mediator;

class MediatorTest extends \PHPUnit_Framework_TestCase {

	public function testSendEvent() {
		$this->markTestSkipped('TODO');
		/**
		$connection = $this->getMockBuilder('\PhpAmqpLib\Connection\AMQPStreamConnection')->disableOriginalConstructor()->getMock();
		$channel = $this->getMockBuilder('\PhpAmqpLib\Channel\AMQPChannel')->disableOriginalConstructor()->getMock();
		$channel->expects($this->once())->method('basic_publish');

		$connection->expects($this->once())->method('channel')->will($this->returnValue($channel));
		$mediatior = new Mediator($connection);
		$mediatior->sendEvent('foo', new RefreshFundCache());
		 * **/
	}

}
