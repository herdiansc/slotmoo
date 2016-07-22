<?php
App::uses('Listing', 'Model');

/**
 * Listing Test Case
 *
 */
class ListingTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.listing',
		'app.user',
		'app.category'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Listing = ClassRegistry::init('Listing');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Listing);

		parent::tearDown();
	}

}
