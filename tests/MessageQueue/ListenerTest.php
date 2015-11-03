<?php
/**
 *
 * @author Dirk Merten
 */

namespace tests\dmerten\MessageQueue;


class ListenerTest extends \PHPUnit_Framework_TestCase {

	public function testDispatch() {
		$stub = $this->getMockForAbstractClass('\dmerten\MessageQueue\Listener');
		$stub->expects($this->once())->method('getEventType')->will($this->returnValue('\dmerten\Test'));
		$event = $this->getMockBuilder('\dmerten\Import\RefreshFundCache')->getMock();
		$event->expects($this->once())->method('getType')->will($this->returnValue('\dmerten\Test'));
		$stub->dispatch($event);
	}

	public function testDispatchFailed() {
		$this->setExpectedException('\dmerten\MessageQueue\Worker\Dispatcher\InvalidEventException');
		$stub = $this->getMockForAbstractClass('\dmerten\MessageQueue\Listener');
		$stub->expects($this->once())->method('getEventType')->will($this->returnValue('\dmerten\Test'));
		$event = $this->getMockBuilder('\dmerten\Import\RefreshFundCache')->getMock();
		$event->expects($this->once())->method('getType')->will($this->returnValue('\dmerten\Import\RefreshFundCache'));
		$stub->dispatch($event);
	}

}
