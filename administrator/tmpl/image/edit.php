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
	method="post" enctype="multipart/form-data" name="adminForm" id="image-form" class="form-validate form-horizontal">

	
	<?php echo HTMLHelper::_('uitab.startTabSet', 'myTab', array('active' => 'image')); ?>
	<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'image', Text::_('COM_UGC_NEW_TAB_IMAGE', true)); ?>
	<div class="row-fluid">
		<div class="col-md-12 form-horizontal">
			<fieldset class="adminform">
				<legend><?php echo Text::_('COM_UGC_NEW_FIELDSET_IMAGE'); ?></legend>
				<?php echo $this->form->renderField('review_id'); ?>
				<?php echo $this->form->renderField('image_path'); ?>
				<?php echo $this->form->renderField('title'); ?>
				<?php echo $this->form->renderField('created_at'); ?>
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

	<?php if (Factory::getApplication()->getIdentity()->authorise('core.admin','ugc_new')) : ?>
	<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'permissions', Text::_('JGLOBAL_ACTION_PERMISSIONS_LABEL', true)); ?>
		<?php echo $this->form->getInput('rules'); ?>
	<?php echo HTMLHelper::_('uitab.endTab'); ?>
<?php endif; ?>
	<?php echo HTMLHelper::_('uitab.endTabSet'); ?>

	<input type="hidden" name="task" value=""/>
	<?php echo HTMLHelper::_('form.token'); ?>

</form>
