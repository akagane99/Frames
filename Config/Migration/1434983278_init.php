<?php
/**
 * Init migration
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

/**
 * Init migration
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\Frames\Config\Migration
 */
class Init extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'init';

/**
 * Actions to be performed
 *
 * @var array $migration
 */
	public $migration = array(
		'up' => array(
			'create_table' => array(
				'frames' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
					'language_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 6, 'unsigned' => false),
					'room_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
					'box_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
					'plugin_key' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
					'block_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
					'key' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Key of the frame.', 'charset' => 'utf8'),
					'name' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Name of the frame.', 'charset' => 'utf8'),
					'header_type' => array('type' => 'string', 'null' => false, 'default' => 'default', 'collate' => 'utf8_general_ci', 'comment' => 'Header type of the frame.', 'charset' => 'utf8'),
					'translation_engine' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
					'is_first_auto_translation' => array('type' => 'boolean', 'null' => false, 'default' => null),
					'is_auto_translated' => array('type' => 'boolean', 'null' => false, 'default' => null),
					'weight' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'comment' => 'Display order.'),
					'is_deleted' => array('type' => 'boolean', 'null' => false, 'default' => null),
					'created_user' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
					'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
					'modified_user' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
					'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB'),
				),
			),
		),
		'down' => array(
			'drop_table' => array(
				'frames',
			),
		),
	);

/**
 * Before migration callback
 *
 * @param string $direction Direction of migration process (up or down)
 * @return bool Should process continue
 */
	public function before($direction) {
		return true;
	}

/**
 * After migration callback
 *
 * @param string $direction Direction of migration process (up or down)
 * @return bool Should process continue
 */
	public function after($direction) {
		return true;
	}
}
