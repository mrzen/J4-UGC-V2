<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Ugc_new
 * @author     Matt Illston <matt.illston@mrzen.com>
 * @copyright  2023 Matt Illston
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die;

use \Joomla\CMS\HTML\HTMLHelper;
use \Joomla\CMS\Factory;
use \Joomla\CMS\Uri\Uri;
use \Joomla\CMS\Router\Route;
use \Joomla\CMS\Language\Text;

$wa = $this->document->getWebAssetManager();
$wa->useScript('keepalive')
	->useScript('form.validate');
HTMLHelper::_('bootstrap.tooltip');
?>

<form
	action="<?php echo Route::_('index.php?option=com_ugc_new&layout=edit&id=' . (int) $this->item->id); ?>"
	method="post" enctype="multipart/form-data" name="adminForm" id="review-form" class="form-validate form-horizontal">

	
	<?php echo HTMLHelper::_('uitab.startTabSet', 'myTab', array('active' => 'review')); ?>
	<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'review', Text::_('COM_UGC_NEW_TAB_REVIEW', true)); ?>
	<div class="row-fluid">
		<div class="col-md-12 form-horizontal">
			<fieldset class="adminform">
				<legend><?php echo Text::_('COM_UGC_NEW_FIELDSET_REVIEW'); ?></legend>
				<?php echo $this->form->renderField('created_at'); ?>
				<?php echo $this->form->renderField('trip_code'); ?>
				<?php echo $this->form->renderField('rating'); ?>
				<?php echo $this->form->renderField('review_title'); ?>
				<?php echo $this->form->renderField('review_content'); ?>
				<?php echo $this->form->renderField('user_id'); ?>
				<?php echo $this->form->renderField('user_name'); ?>
				<?php echo $this->form->renderField('user_location'); ?>
				<?php echo $this->form->renderField('country'); ?>
				<?php echo $this->form->renderField('tags'); ?>
			</fieldset>
		</div>
	</div>
	<?php echo HTMLHelper::_('uitab.endTab'); ?>
	<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'Media', Text::_('COM_UGC_NEW_TAB_MEDIA', true)); ?>
	<div class="row-fluid">
		<div class="col-md-12 form-horizontal">
			<fieldset class="adminform">
				<legend><?php echo Text::_('COM_UGC_NEW_FIELDSET_MEDIA'); ?></legend>
				<?php echo $this->form->renderField('videos'); ?>
			</fieldset>
		</div>
	</div>
	<?php echo HTMLHelper::_('uitab.endTab'); ?>
	<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'Response', Text::_('COM_UGC_NEW_TAB_RESPONSE', true)); ?>
	<div class="row-fluid">
		<div class="col-md-12 form-horizontal">
			<fieldset class="adminform">
				<legend><?php echo Text::_('COM_UGC_NEW_FIELDSET_RESPONSE'); ?></legend>
				<?php echo $this->form->renderField('review_reply'); ?>
			</fieldset>
		</div>
	</div>
	<?php echo HTMLHelper::_('uitab.endTab'); ?>
	<input type="hidden" name="jform[id]" value="<?php echo $this->item->id; ?>" />
	<input type="hidden" name="jform[state]" value="<?php echo $this->item->state; ?>" />
	<input type="hidden" name="jform[ordering]" value="<?php echo $this->item->ordering; ?>" />
	<input type="hidden" name="jform[checked_out]" value="<?php echo $this->item->checked_out; ?>" />
	<input type="hidden" name="jform[checked_out_time]" value="<?php echo $this->item->checked_out_time; ?>" />
	<?php echo $this->form->renderField('created_by'); ?>
	<?php echo $this->form->renderField('modified_by'); ?>

	
	<?php echo HTMLHelper::_('uitab.endTabSet'); ?>

	<input type="hidden" name="task" value=""/>
	<?php echo HTMLHelper::_('form.token'); ?>

</form>
