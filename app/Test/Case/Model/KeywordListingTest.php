<?php
App::uses('KeywordListing', 'Model');

/**
 * KeywordListing Test Case
 *
 */
class KeywordListingTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.keyword_listing',
		'app.keyword',
		'app.listing',
		'app.user',
		'app.category',
		'app.image_listing'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->KeywordListing = ClassRegistry::init('KeywordListing');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->KeywordListing);

		parent::tearDown();
	}

}
