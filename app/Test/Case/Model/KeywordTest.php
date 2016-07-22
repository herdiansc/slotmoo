<?php
App::uses('Keyword', 'Model');

/**
 * Keyword Test Case
 *
 */
class KeywordTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.keyword',
		'app.keyword_listing',
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
		$this->Keyword = ClassRegistry::init('Keyword');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Keyword);

		parent::tearDown();
	}

}
