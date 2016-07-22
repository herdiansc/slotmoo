<?php
App::uses('PrivateMessage', 'Model');

/**
 * PrivateMessage Test Case
 *
 */
class PrivateMessageTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.private_message',
		'app.user',
		'app.follow',
		'app.keyword',
		'app.keyword_listing',
		'app.listing',
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
		$this->PrivateMessage = ClassRegistry::init('PrivateMessage');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PrivateMessage);

		parent::tearDown();
	}

}
