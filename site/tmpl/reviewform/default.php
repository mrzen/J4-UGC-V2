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
use \Ugc\Component\Ugc_new\Site\Helper\Ugc_newHelper;

$wa = $this->document->getWebAssetManager();
$wa->useScript('keepalive')
	->useScript('form.validate');
HTMLHelper::_('bootstrap.tooltip');

// Load admin language file
$lang = Factory::getLanguage();
$lang->load('com_ugc_new', JPATH_SITE);

$user    = Factory::getApplication()->getIdentity();
$canEdit = Ugc_newHelper::canUserEdit($this->item, $user);


?>

<div class="review-edit front-end-edit">
	<?php if (!$canEdit) : ?>
		<h3>
		<?php throw new \Exception(Text::_('COM_UGC_NEW_ERROR_MESSAGE_NOT_AUTHORISED'), 403); ?>
		</h3>
	<?php else : ?>
		<?php if (!empty($this->item->id)): ?>
			<h1><?php echo Text::sprintf('COM_UGC_NEW_EDIT_ITEM_TITLE', $this->item->id); ?></h1>
		<?php else: ?>
			<h1><?php echo Text::_('COM_UGC_NEW_ADD_ITEM_TITLE'); ?></h1>
		<?php endif; ?>

		<form id="form-review"
			  action="<?php echo Route::_('index.php?option=com_ugc_new&task=reviewform.save'); ?>"
			  method="post" class="form-validate form-horizontal" enctype="multipart/form-data">
			
	<input type="hidden" name="jform[id]" value="<?php echo isset($this->item->id) ? $this->item->id : ''; ?>" />

	<input type="hidden" name="jform[state]" value="<?php echo isset($this->item->state) ? $this->item->state : ''; ?>" />

	<input type="hidden" name="jform[ordering]" value="<?php echo isset($this->item->ordering) ? $this->item->ordering : ''; ?>" />

	<input type="hidden" name="jform[checked_out]" value="<?php echo isset($this->item->checked_out) ? $this->item->checked_out : ''; ?>" />

	<input type="hidden" name="jform[checked_out_time]" value="<?php echo isset($this->item->checked_out_time) ? $this->item->checked_out_time : ''; ?>" />

				<?php echo $this->form->getInput('created_by'); ?>
				<?php echo $this->form->getInput('modified_by'); ?>
	<?php echo HTMLHelper::_('uitab.startTabSet', 'myTab', array('active' => 'review')); ?>
	<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'review', Text::_('COM_UGC_NEW_TAB_REVIEW', true)); ?>
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

	<?php echo HTMLHelper::_('uitab.endTab'); ?>
	<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'Media', Text::_('COM_UGC_NEW_TAB_MEDIA', true)); ?>
	<?php echo $this->form->renderField('videos'); ?>

	<?php echo HTMLHelper::_('uitab.endTab'); ?>
	<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'Response', Text::_('COM_UGC_NEW_TAB_RESPONSE', true)); ?>
	<?php echo $this->form->renderField('review_reply'); ?>

	<?php echo HTMLHelper::_('uitab.endTab'); ?>
			<div class="control-group">
				<div class="controls">

					<?php if ($this->canSave): ?>
						<button type="submit" class="validate btn btn-primary">
							<span class="fas fa-check" aria-hidden="true"></span>
							<?php echo Text::_('JSUBMIT'); ?>
						</button>
					<?php endif; ?>
					<a class="btn btn-danger"
					   href="<?php echo Route::_('index.php?option=com_ugc_new&task=reviewform.cancel'); ?>"
					   title="<?php echo Text::_('JCANCEL'); ?>">
					   <span class="fas fa-times" aria-hidden="true"></span>
						<?php echo Text::_('JCANCEL'); ?>
					</a>
				</div>
			</div>

			<input type="hidden" name="option" value="com_ugc_new"/>
			<input type="hidden" name="task"
				   value="reviewform.save"/>
			<?php echo HTMLHelper::_('form.token'); ?>
		</form>
	<?php endif; ?>
</div>
