<?php
/**
 *
 * @author Dirk Merten
 */

namespace tests\dmerten\MessageQueue\Worker\Dispatcher;

use PhpAmqpLib\Message\AMQPMessage;

class AmqpMessageParserTest extends \PHPUnit_Framework_TestCase
{

	public function testParse()
	{
		$this->markTestSkipped('TODO');
		/**
		 * $parser = new AmqpMessageParser();
		 * $this->assertInstanceOf('dmerten\MessageQueue\Event', $parser->getEventByMessage(new AMQPMessage(serialize(new RefreshFundCache()))));
		 **/
	}


}
