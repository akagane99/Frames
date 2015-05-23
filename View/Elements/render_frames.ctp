<?php
/**
 * Render frames element.
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */
echo $this->Html->script('/frames/js/frames.js', false);

foreach ($frames as $frame) {
	if (strlen($frame['plugin_key']) === 0) {
		continue;
	}

	$defaultAction = 'index';
	if (isset($pluginMap[$frame['plugin_key']]) && $pluginMap[$frame['plugin_key']]['default_action'] !== '') {
		$defaultAction = $pluginMap[$frame['plugin_key']]['default_action'];
	}
	$defaultController = $frame['plugin_key'];

	$url = $frame['plugin_key'] . DS . $defaultController . DS . $defaultAction . DS . $frame['id'];
	if (Page::isSetting()) {
		$url = Page::SETTING_MODE_WORD . DS . $url;
	}

	$view = $this->requestAction($url, array('return'));
	if (! Page::isSetting() && strlen($view) === 0) {
		continue;
	}

	echo $this->element('Frames.frame', array(
			'frame' => $frame,
			'view' => $view
		));
}
