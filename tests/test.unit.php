<?php

/**
 * Tests for Freeway.
 *
 * @package Freeway Testee tests
 * @author Doug Avery <doug.avery@viget.com>
 */

if (!class_exists('Freeway_unit_test')) { require_once PATH_THIRD.'freeway/ext.freeway'.EXT; }

class Freeway_unit_test extends Testee_unit_test_case {
	
	private $_test;
	
	function setUp()
	{
		$this->_test = new Testee_test();
	}
	
	
	function tearDown()
	{
		// Do nothing.
	}
	
	/*
	 *
	 Getting to knowwww Simpletest:
	 
	 $mock_object->returns('should_execute', false);
	 $mock_object->expect('should_execute', array(params));
	 $mock_object->expectOnce('should_execute');
	 $mock_object->expectNever('should_execute');
	 $mock_object->getCallCount('should_execute');
	 $mock_object->assertEqual(true, false);
	 $mock_object->assertNotEqual(true, false);

	*/
	
	function test_Freeway_ext()
	{

		Mock::generatePartial(
			'Freeway_ext',
			'MockFreeway_ext',
			array('setup', 'should_execute')
		);

		$mock_object = new MockFreeway_ext();
		$mock_object->expectOnce('setup');
		$mock_object->Freeway_ext();

	}

}

?>
