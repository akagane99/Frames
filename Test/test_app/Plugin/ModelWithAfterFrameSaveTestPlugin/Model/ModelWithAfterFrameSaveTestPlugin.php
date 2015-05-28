<?php
/**
 * ModelWithAfterFrameSaveTestPlugin Model of test_app
 *
 * @author Jun Nishikawa <topaz2@m0n0m0n0.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 **/

/**
 * ModelWithAfterFrameSaveTestPlugin Model
 */
class ModelWithAfterFrameSaveTestPlugin extends Model {

/**
 * afterFrameSave hook
 */
	public function afterFrameSave() {
		$this->set('test', 'I have been rendered.');
	}
}
