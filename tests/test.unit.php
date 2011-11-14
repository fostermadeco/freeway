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
	function mock($array){
	
		Mock::generatePartial(
			'Freeway_ext',
			'MockFreeway_ext',
			$array
		);

		return new MockFreeway_ext();

	}
	
	function setup_Freeway_ext()
	{
	
		$this->mock = $this->mock(array(
			'setup', 
			'should_execute', 
			'load_routes', 
			'remove_and_store_params', 
			'uri_matches_pattern',
			'store_original_uri',
			'parse_new_uri_from_route',
			'rebuild_uri_for_parsing',
			'output_freeway_data'
		));

	}

	function test_sets_up_but_doesnt_execute()
	{

		$this->setup_Freeway_ext();
		$this->mock->returns('should_execute', false);
		$this->mock->expectOnce('setup');
		$this->mock->expectNever('store_original_uri');
		$this->mock->expectNever('parse_new_uri_from_route');
		$this->mock->Freeway_ext();

	}

	function test_sets_up_executes_doesnt_parse()
	{

		$this->setup_Freeway_ext();
		$this->mock->returns('should_execute', true);
		$this->mock->returns('uri_matches_pattern', false);
		$this->mock->expectOnce('store_original_uri');
		$this->mock->expectNever('parse_new_uri_from_route');
		$this->mock->Freeway_ext();

	}

	function test_sets_up_executes_parses()
	{

		$this->setup_Freeway_ext();
		$this->mock->returns('should_execute', true);
		$this->mock->returns('uri_matches_pattern', true);
		$this->mock->expectOnce('parse_new_uri_from_route');
		$this->mock->Freeway_ext();

	}

}

?>
