<?php
App::uses('Follow', 'Model');

/**
 * Follow Test Case
 *
 */
class FollowTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.follow',
		'app.keyword',
		'app.keyword_listing',
		'app.listing',
		'app.user',
		'app.image_listing',
		'app.comment',
		'app.listing_visit'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Follow = ClassRegistry::init('Follow');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Follow);

		parent::tearDown();
	}

}
