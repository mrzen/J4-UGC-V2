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
				<?php echo $this->form->renderField('image1'); ?>
				<?php if (!empty($this->item->image1)) : ?>
					<?php $image1Files = array(); ?>
					<?php foreach ((array)$this->item->image1 as $fileSingle) : ?>
						<?php if (!is_array($fileSingle)) : ?>
							<a href="<?php echo Route::_(Uri::root() . 'ugc/images' . DIRECTORY_SEPARATOR . $fileSingle, false);?>"><?php echo $fileSingle; ?></a> | 
							<?php $image1Files[] = $fileSingle; ?>
						<?php endif; ?>
					<?php endforeach; ?>
					<input type="hidden" name="jform[image1_hidden]" id="jform_image1_hidden" value="<?php echo implode(',', $image1Files); ?>" />
				<?php endif; ?>
				<?php echo $this->form->renderField('image2'); ?>
				<?php if (!empty($this->item->image2)) : ?>
					<?php $image2Files = array(); ?>
					<?php foreach ((array)$this->item->image2 as $fileSingle) : ?>
						<?php if (!is_array($fileSingle)) : ?>
							<a href="<?php echo Route::_(Uri::root() . 'ugc/images' . DIRECTORY_SEPARATOR . $fileSingle, false);?>"><?php echo $fileSingle; ?></a> | 
							<?php $image2Files[] = $fileSingle; ?>
						<?php endif; ?>
					<?php endforeach; ?>
					<input type="hidden" name="jform[image2_hidden]" id="jform_image2_hidden" value="<?php echo implode(',', $image2Files); ?>" />
				<?php endif; ?>
				<?php echo $this->form->renderField('image3'); ?>
				<?php if (!empty($this->item->image3)) : ?>
					<?php $image3Files = array(); ?>
					<?php foreach ((array)$this->item->image3 as $fileSingle) : ?>
						<?php if (!is_array($fileSingle)) : ?>
							<a href="<?php echo Route::_(Uri::root() . 'ugc/images' . DIRECTORY_SEPARATOR . $fileSingle, false);?>"><?php echo $fileSingle; ?></a> | 
							<?php $image3Files[] = $fileSingle; ?>
						<?php endif; ?>
					<?php endforeach; ?>
					<input type="hidden" name="jform[image3_hidden]" id="jform_image3_hidden" value="<?php echo implode(',', $image3Files); ?>" />
				<?php endif; ?>
				<?php echo $this->form->renderField('image4'); ?>
				<?php if (!empty($this->item->image4)) : ?>
					<?php $image4Files = array(); ?>
					<?php foreach ((array)$this->item->image4 as $fileSingle) : ?>
						<?php if (!is_array($fileSingle)) : ?>
							<a href="<?php echo Route::_(Uri::root() . 'ugc/images' . DIRECTORY_SEPARATOR . $fileSingle, false);?>"><?php echo $fileSingle; ?></a> | 
							<?php $image4Files[] = $fileSingle; ?>
						<?php endif; ?>
					<?php endforeach; ?>
					<input type="hidden" name="jform[image4_hidden]" id="jform_image4_hidden" value="<?php echo implode(',', $image4Files); ?>" />
				<?php endif; ?>
				<?php echo $this->form->renderField('image5'); ?>
				<?php if (!empty($this->item->image5)) : ?>
					<?php $image5Files = array(); ?>
					<?php foreach ((array)$this->item->image5 as $fileSingle) : ?>
						<?php if (!is_array($fileSingle)) : ?>
							<a href="<?php echo Route::_(Uri::root() . 'ugc/images' . DIRECTORY_SEPARATOR . $fileSingle, false);?>"><?php echo $fileSingle; ?></a> | 
							<?php $image5Files[] = $fileSingle; ?>
						<?php endif; ?>
					<?php endforeach; ?>
					<input type="hidden" name="jform[image5_hidden]" id="jform_image5_hidden" value="<?php echo implode(',', $image5Files); ?>" />
				<?php endif; ?>
				<?php echo $this->form->renderField('image6'); ?>
				<?php if (!empty($this->item->image6)) : ?>
					<?php $image6Files = array(); ?>
					<?php foreach ((array)$this->item->image6 as $fileSingle) : ?>
						<?php if (!is_array($fileSingle)) : ?>
							<a href="<?php echo Route::_(Uri::root() . 'ugc/images' . DIRECTORY_SEPARATOR . $fileSingle, false);?>"><?php echo $fileSingle; ?></a> | 
							<?php $image6Files[] = $fileSingle; ?>
						<?php endif; ?>
					<?php endforeach; ?>
					<input type="hidden" name="jform[image6_hidden]" id="jform_image6_hidden" value="<?php echo implode(',', $image6Files); ?>" />
				<?php endif; ?>
				<?php echo $this->form->renderField('image7'); ?>
				<?php if (!empty($this->item->image7)) : ?>
					<?php $image7Files = array(); ?>
					<?php foreach ((array)$this->item->image7 as $fileSingle) : ?>
						<?php if (!is_array($fileSingle)) : ?>
							<a href="<?php echo Route::_(Uri::root() . 'ugc/images' . DIRECTORY_SEPARATOR . $fileSingle, false);?>"><?php echo $fileSingle; ?></a> | 
							<?php $image7Files[] = $fileSingle; ?>
						<?php endif; ?>
					<?php endforeach; ?>
					<input type="hidden" name="jform[image7_hidden]" id="jform_image7_hidden" value="<?php echo implode(',', $image7Files); ?>" />
				<?php endif; ?>
				<?php echo $this->form->renderField('image8'); ?>
				<?php if (!empty($this->item->image8)) : ?>
					<?php $image8Files = array(); ?>
					<?php foreach ((array)$this->item->image8 as $fileSingle) : ?>
						<?php if (!is_array($fileSingle)) : ?>
							<a href="<?php echo Route::_(Uri::root() . 'ugc/images' . DIRECTORY_SEPARATOR . $fileSingle, false);?>"><?php echo $fileSingle; ?></a> | 
							<?php $image8Files[] = $fileSingle; ?>
						<?php endif; ?>
					<?php endforeach; ?>
					<input type="hidden" name="jform[image8_hidden]" id="jform_image8_hidden" value="<?php echo implode(',', $image8Files); ?>" />
				<?php endif; ?>
				<?php echo $this->form->renderField('image9'); ?>
				<?php if (!empty($this->item->image9)) : ?>
					<?php $image9Files = array(); ?>
					<?php foreach ((array)$this->item->image9 as $fileSingle) : ?>
						<?php if (!is_array($fileSingle)) : ?>
							<a href="<?php echo Route::_(Uri::root() . 'ugc/images' . DIRECTORY_SEPARATOR . $fileSingle, false);?>"><?php echo $fileSingle; ?></a> | 
							<?php $image9Files[] = $fileSingle; ?>
						<?php endif; ?>
					<?php endforeach; ?>
					<input type="hidden" name="jform[image9_hidden]" id="jform_image9_hidden" value="<?php echo implode(',', $image9Files); ?>" />
				<?php endif; ?>
				<?php echo $this->form->renderField('image10'); ?>
				<?php if (!empty($this->item->image10)) : ?>
					<?php $image10Files = array(); ?>
					<?php foreach ((array)$this->item->image10 as $fileSingle) : ?>
						<?php if (!is_array($fileSingle)) : ?>
							<a href="<?php echo Route::_(Uri::root() . 'ugc/images' . DIRECTORY_SEPARATOR . $fileSingle, false);?>"><?php echo $fileSingle; ?></a> | 
							<?php $image10Files[] = $fileSingle; ?>
						<?php endif; ?>
					<?php endforeach; ?>
					<input type="hidden" name="jform[image10_hidden]" id="jform_image10_hidden" value="<?php echo implode(',', $image10Files); ?>" />
				<?php endif; ?>
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
