<?php
App::uses('ListingVisit', 'Model');

/**
 * ListingVisit Test Case
 *
 */
class ListingVisitTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.listing_visit',
		'app.listing',
		'app.user',
		'app.category',
		'app.image_listing',
		'app.comment'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ListingVisit = ClassRegistry::init('ListingVisit');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ListingVisit);

		parent::tearDown();
	}

}
