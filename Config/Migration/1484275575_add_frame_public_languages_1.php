<?php
/**
 * frame_public_languagesの追加
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsMigration', 'NetCommons.Config/Migration');

/**
 * frame_public_languagesの追加
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\Frames\Config\Migration
 */
class AddFramePublic1 extends NetCommonsMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'add_frame_public_languages_1';

/**
 * Actions to be performed
 *
 * @var array $migration
 */
	public $migration = array(
		'up' => array(
		),
		'down' => array(
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
		$Frame = $this->generateModel('Frame');
		$FramePublic = $this->generateModel('FramePublicLanguage');

		if ($direction === 'up') {
			$sql = 'INSERT INTO ' . $FramePublic->tablePrefix . $FramePublic->table .
					' SELECT ' .
						'Frame.id, \'0\', Frame.id, 1, ' .
						'Frame.created_user, Frame.created, Frame.modified_user, Frame.modified' .
					' FROM ' . $Frame->tablePrefix . $Frame->table . ' ' . $Frame->alias;
			$FramePublic->query($sql);
		}
		return true;
	}
}
