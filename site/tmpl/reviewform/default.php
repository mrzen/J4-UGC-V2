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
<div class="container zen-card p-4 mx-auto my-5">
<div class="review-edit front-end-edit">
	<?php if (!$canEdit) : ?>
		<h3>
		<?php throw new \Exception(Text::_('COM_UGC_NEW_ERROR_MESSAGE_NOT_AUTHORISED'), 403); ?>
		</h3>
	<?php else : ?>
		<form id="form-review"
			  action="<?php echo Route::_('index.php?option=com_ugc_new&task=reviewform.save'); ?>"
			  method="post" class="form-validate form-horizontal" enctype="multipart/form-data">
			
	<input type="hidden" name="jform[id]" value="<?php echo isset($this->item->id) ? $this->item->id : ''; ?>" />

	<input type="hidden" name="jform[state]" value="<?php echo isset($this->item->state) ? $this->item->state : ''; ?>" />

	<input type="hidden" name="jform[ordering]" value="<?php echo isset($this->item->ordering) ? $this->item->ordering : ''; ?>" />

	<input type="hidden" name="jform[checked_out]" value="<?php echo isset($this->item->checked_out) ? $this->item->checked_out : ''; ?>" />

	<input type="hidden" name="jform[checked_out_time]" value="<?php echo isset($this->item->checked_out_time) ? $this->item->checked_out_time : ''; ?>" />
	
	<h4>Trip Information</h4>
	<div class="my-3">
		<?php echo $this->form->renderField('trip_code'); ?>
	</div>

	<div class="my-3">
		<?php echo $this->form->renderField('rating'); ?>
	</div>

	<div class="my-3">
		<?php echo $this->form->renderField('review_title'); ?>
	</div>

	<div class="my-3">
		<?php echo $this->form->renderField('review_content'); ?>
	</div>

	<div class="my-3">
		<?php echo $this->form->renderField('country'); ?>
	</div>


	<h4>Your Information</h4>

	<div class="my-3 d-none">
		<?php echo $this->form->renderField('user_id'); ?>
	</div>

	<div class="my-3">
		<?php echo $this->form->renderField('user_name'); ?>
	</div>

	<div class="my-3">
		<?php echo $this->form->renderField('user_location'); ?>
	</div>


	<div class="media-upload collapse mt-3" id="mediaUpload">
		<div class="bg-light p-5">
			<h4>Upload Media from your Trip</h4>
			<div class="my-3">
				<h6 class="zen-text zen-text--primary zen-text--letter-space-lg zen-uppercase">
						IMAGES
				</h6>
				<div id="image1-wrapper">
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
				</div>

				<div id="image2-wrapper">
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
				</div>

				<div id="image3-wrapper">
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
				</div>

				<div id="image4-wrapper">
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
				</div>

				<div id="image5-wrapper">
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
				</div>

				<div id="image6-wrapper">
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
				</div>

				<div id="image7-wrapper">
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
				</div>

				<div id="image8-wrapper">
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
				</div>

				<div id="image9-wrapper">
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
				</div>

				<div id="image10-wrapper">
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
				</div>


				<h6 class="mt-5 zen-text zen-text--primary zen-text--letter-space-lg zen-uppercase">
						VIDEOS
				</h6>
				
				<div class="my-3">
					<?php echo $this->form->renderField('videos'); ?>
				</div>



			</div>
		</div>
	</div>

	<button class="zen-btn zen-btn--outlined-primary mt-3" type="button" data-bs-toggle="collapse" data-bs-target="#mediaUpload" aria-expanded="false" aria-controls="mediaUpload">
						Add Images or Videos to my review
				</button>

	<div id="thankYouModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Thank You!</h5>
                        </div>
                        <div class="modal-body">
                            <p>
                                <?php echo JText::_('ZEN_REVIEWS_FORM_THANKYOU'); ?>
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>


	<?php echo HTMLHelper::_('uitab.endTab'); ?>
			<div class="control-group mt-4">
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

			<script>

document.addEventListener('DOMContentLoaded', function () {
		document.querySelector('#form-review').addEventListener('submit', function (event) {
				$('#thankYouModal').modal('show');

				// prevent default for a few seconds
				event.preventDefault();

				setTimeout(function () {
						document.querySelector('#form-review').submit();
				}, 5000);
		});
		// if the user closes the modal also submit the form 
		$('#thankYouModal').on('hidden.bs.modal', function (e) {
				document.querySelector('#form-review').submit();
		});
});

document.querySelector("#jform_trip_code").value = "<?=$holidayCode;?>";
document.querySelector("#jform_user_id").value = "<?=$userId;?>";
document.querySelector("#jform_user_name").value = "<?=$userName;?>";
document.querySelector("#jform_country").value = "<?=$country ? $country : '';?>";

// script for hiding un-filled image uploader fields
var image2Wrapper = document.getElementById("image2-wrapper");
var image3Wrapper = document.getElementById("image3-wrapper");
var image4Wrapper = document.getElementById("image4-wrapper");
var image5Wrapper = document.getElementById("image5-wrapper");
var image6Wrapper = document.getElementById("image6-wrapper");
var image7Wrapper = document.getElementById("image7-wrapper");
var image8Wrapper = document.getElementById("image8-wrapper");
var image9Wrapper = document.getElementById("image9-wrapper");
var image10Wrapper = document.getElementById("image10-wrapper");

var image1Input = document.getElementById("jform_image1");
var image2Input = document.getElementById("jform_image2");
var image3Input = document.getElementById("jform_image3");
var image4Input = document.getElementById("jform_image4");
var image5Input = document.getElementById("jform_image5");
var image6Input = document.getElementById("jform_image6");
var image7Input = document.getElementById("jform_image7");
var image8Input = document.getElementById("jform_image8");
var image9Input = document.getElementById("jform_image9");
var image10Input = document.getElementById("jform_image10");

image2Wrapper.style.display = "none";
image3Wrapper.style.display = "none";
image4Wrapper.style.display = "none";
image5Wrapper.style.display = "none";
image6Wrapper.style.display = "none";
image7Wrapper.style.display = "none";
image8Wrapper.style.display = "none";
image9Wrapper.style.display = "none";
image10Wrapper.style.display = "none";

image1Input.addEventListener("change", function() { 
		if (this.classList.contains('valid')) { image2Wrapper.style.display = "block"; }
});

image2Input.addEventListener("change", function() {
		if (this.classList.contains('valid')) { image3Wrapper.style.display = "block"; }
});

image3Input.addEventListener("change", function() {
		if (this.classList.contains('valid')) { image4Wrapper.style.display = "block"; }
});

image4Input.addEventListener("change", function() {
		if (this.classList.contains('valid')) { image5Wrapper.style.display = "block"; }
});

image5Input.addEventListener("change", function() {
		if (this.classList.contains('valid')) { image6Wrapper.style.display = "block"; }
});

image6Input.addEventListener("change", function() {
		if (this.classList.contains('valid')) { image7Wrapper.style.display = "block"; }
});

image7Input.addEventListener("change", function() {
		if (this.classList.contains('valid')) { image8Wrapper.style.display = "block"; }
});

image8Input.addEventListener("change", function() {
		if (this.classList.contains('valid')) { image9Wrapper.style.display = "block"; }
});

image9Input.addEventListener("change", function() {
		if (this.classList.contains('valid')) { image10Wrapper.style.display = "block"; }
});

</script>
</div>

			<input type="hidden" name="option" value="com_ugc_new"/>
			<input type="hidden" name="task"
				   value="reviewform.save"/>
			<?php echo HTMLHelper::_('form.token'); ?>
		</form>
	<?php endif; ?>
</div>
