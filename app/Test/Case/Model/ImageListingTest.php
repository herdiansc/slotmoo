<?php
App::uses('ImageListing', 'Model');

/**
 * ImageListing Test Case
 *
 */
class ImageListingTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.image_listing',
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
		$this->ImageListing = ClassRegistry::init('ImageListing');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ImageListing);

		parent::tearDown();
	}

}
