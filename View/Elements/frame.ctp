<?php
/**
 * Element of frame.
 *  - $frame: The frame data
 *  - $view: The plugin view
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */

if ($frame['header_type'] === 'none' && ! Current::isSettingMode()) {
	$panelCss = '';
} elseif (!empty($frame['header_type'])) {
	$panelCss = ' panel panel-' . h($frame['header_type']);
} else {
	$panelCss = ' panel panel-default';
}

?>

<section class="frame<?php echo $panelCss . ' plugin-' . $frame['plugin_key']; ?>">

	<?php if ($frame['name'] || Current::isSettingMode()) : ?>
		<div class="panel-heading clearfix">
			<span>
				<?php echo $frame['name']; ?>
			</span>

			<?php if (Current::isSettingMode()): ?>
				<div class="pull-right">
					<?php echo $this->element('Frames.order_form', array('frame' => $frame)); ?>

					<?php if ($action = Hash::get($this->PageLayout->plugins, $frame['plugin_key'] . '.default_setting_action')) : ?>
						<a class="btn btn-default btn-sm frame-btn pull-left"
						   href="<?php echo $this->NetCommonsHtml->url('/' . $frame['plugin_key'] . '/' . $action . '?frame_id=' . $frame['id']); ?>">
							<span class="glyphicon glyphicon-cog"> </span>
							<span class="sr-only"><?php echo __d('frames', 'Show flame setting'); ?></span>
						</a>
					<?php endif; ?>

					<?php echo $this->element('Frames.delete_form', array('frame' => $frame)); ?>
				</div>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<div class="<?php echo ($panelCss ? 'panel-body ' : ''); ?>block">
		<?php echo $view; ?>
	</div>
</section>
