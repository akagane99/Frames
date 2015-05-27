<?php
/**
 * Frame Model
 *
 * @property Plugin $Plugin
 * @property Block $Block
 * @property Box $Box
 * @property Frame $ParentFrame
 * @property Frame $ChildFrame
 * @property Language $Language
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */

App::uses('FramesAppModel', 'Frames.Model');

/**
 * Summary for Frame Model
 *
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @package NetCommons\Frames\Model
 */
class Frame extends FramesAppModel {

/**
 * use behaviors
 *
 * @var array
 */
	public $actsAs = array(
		'NetCommons.OriginalKey',
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Box' => array(
			'className' => 'Box',
			'foreignKey' => 'box_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Plugin' => array(
			'className' => 'PluginManager.Plugin',
			'foreignKey' => false,
			'conditions' => array('Frame.plugin_key = Plugin.key'),
			'fields' => '',
			'order' => ''
		),
		'Language' => array(
			'className' => 'Language',
			'foreignKey' => 'language_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Block' => array(
			'className' => 'Blocks.Block',
			'foreignKey' => 'block_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * Get query option for containable behavior
 *
 * @return array
 */
	public function getContainableQuery() {
		$query = array(
			'conditions' => array(
				'is_deleted' => false
			),
			'order' => array(
				'Frame.weight'
			),
		);

		return $query;
	}

/**
 * Save frame to master data source
 * Is it better to use before after method?
 * If so, is it okay to use beforeValidate?
 *
 * @param array $data request data
 * @throws Exception
 * @return mixed On success Model::$data if its not empty or true, false on failure
 */
	public function saveFrame($data) {
		$plugin = Inflector::camelize($data[$this->alias]['plugin_key']);
		$model = Inflector::singularize($plugin);
		$this->loadModels([
			$model => $plugin . '.' . $model,
		]);

		$this->setDataSource('master');
		$dataSource = $this->getDataSource();
		$dataSource->begin();

		try {
			if ($data['Frame']['is_deleted']) {
				//削除の場合、カウントDown
				$this->updateAll(
					array('Frame.weight' => 'Frame.weight - 1'),
					array(
						'Frame.weight > ' => $data['Frame']['weight'],
						'Frame.box_id' => $data['Frame']['box_id'],
						'Frame.is_deleted' => false,
					)
				);
				$data['Frame']['weight'] = null;
			} elseif (! isset($data['Frame']['id']) || ! $data['Frame']['id']) {
				//カウントUp
				$this->updateAll(
					array('Frame.weight' => 'Frame.weight + 1'),
					array(
						'Frame.weight >= ' => $data['Frame']['weight'],
						'Frame.box_id' => $data['Frame']['box_id'],
						'Frame.is_deleted' => false,
					)
				);
			}

			$frame = $this->save($data);
			if (! $frame) {
				throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
			}
			if (method_exists($this->{$model}, 'afterFrameSave')) {
				$this->{$model}->afterFrameSave($frame);
			}

			$dataSource->commit();
			return $frame;

		} catch (Exception $ex) {
			$dataSource->rollback();
			CakeLog::error($ex);
			throw $ex;
		}
	}

/**
 * Delete frame from master data source
 * Is it better to use before after method?
 * If so, is it okay to use beforeValidate?
 *
 * @throws Exception
 * @return bool True on success
 */
	public function deleteFrame() {
		$this->setDataSource('master');
		$dataSource = $this->getDataSource();
		$dataSource->begin();

		try {
			if (!$this->delete()) {
				throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
			}

			$dataSource->commit();
			return true;

		} catch (Exception $ex) {
			$dataSource->rollback();
			CakeLog::error($ex);
			throw $ex;
		}
	}

}
