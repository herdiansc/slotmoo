<?php
App::uses('SiteMessage', 'Model');

/**
 * SiteMessage Test Case
 *
 */
class SiteMessageTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.site_message',
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
		$this->SiteMessage = ClassRegistry::init('SiteMessage');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SiteMessage);

		parent::tearDown();
	}

}
