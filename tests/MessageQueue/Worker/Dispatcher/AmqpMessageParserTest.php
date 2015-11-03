<?php
/**
 *
 * @author Dirk Merten
 */

namespace tests\dmerten\MessageQueue\Worker\Dispatcher;

use dmerten\MessageQueue\Worker\Dispatcher\AmqpMessageParser;
use PhpAmqpLib\Message\AMQPMessage;

class AmqpMessageParserTest extends \PHPUnit_Framework_TestCase {

	public function testParse() {
		$parser = new AmqpMessageParser();
		$this->assertInstanceOf('dmerten\MessageQueue\Event', $parser->getEventByMessage(new AMQPMessage(serialize(new RefreshFundCache()))));
	}


}
