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
        <h1 class="zen-title zen-title--primary my-4">Submit a Holiday Review</h1>
        <p class="lead">
            <?php echo JText::_('ZEN_REVIEWS_FORM_LEAD'); ?>
        </p>
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
            <input type="hidden" name="jform[review_reply]" value="<?php echo isset($this->item->review_reply) ? $this->item->review_reply : ''; ?>" />

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
          
             <div class="my-3">
                <?php echo $this->form->renderField('tags'); ?>
            </div>


            <div class="media-upload collapse mt-3" id="mediaUpload" class="">
                <div class="bg-light p-5">
                    <h4>Upload Media from your Trip</h4>
                    <div class="my-3">
                        <h6 class="zen-text zen-text--primary zen-text--letter-space-lg zen-uppercase">
                            IMAGES
                        </h6>
                        <div id="image1-wrapper">
                            <?php echo $this->form->renderField('image1'); ?>
                        </div>
                    </div>
                    
                    <div class="my-3">
                        <div id="image2-wrapper">
                            <?php echo $this->form->renderField('image2'); ?>
                        </div>
                    </div>
                    
                    <div class="my-3">
                        <div id="image3-wrapper">
                            <?php echo $this->form->renderField('image3'); ?>
                        </div>
                    </div>

                    <div class="my-3">
                        <div id="image4-wrapper">
                            <?php echo $this->form->renderField('image4'); ?>
                        </div>
                    </div>

                    <div class="my-3">
                        <div id="image5-wrapper">
                            <?php echo $this->form->renderField('image5'); ?>
                        </div>
                    </div>

                    <div class="my-3">
                        <div id="image6-wrapper">
                            <?php echo $this->form->renderField('image6'); ?>
                        </div>
                    </div>

                    <div class="my-3">
                        <div id="image7-wrapper">
                            <?php echo $this->form->renderField('image7'); ?>
                        </div>
                    </div>

                    <div class="my-3">
                        <div id="image8-wrapper">
                            <?php echo $this->form->renderField('image8'); ?>
                        </div>
                    </div>

                    <div class="my-3">
                        <div id="image9-wrapper">
                            <?php echo $this->form->renderField('image9'); ?>
                        </div>
                    </div>

                    <div class="my-3">
                        <div id="image10-wrapper">
                            <?php echo $this->form->renderField('image10'); ?>
                        </div>
                    </div>

                    <h6 class="zen-text zen-text--primary zen-text--letter-space-lg zen-uppercase">
                            VIDEOS
                        </h6>
                    <div class="my-3">
                        <?php echo $this->form->renderField('videos'); ?>
                    </div>
                </div>
            </div>
            <button class="zen-btn zen-btn--outlined-primary mt-3" type="button" data-bs-toggle="collapse" data-bs-target="#mediaUpload" aria-expanded="false" aria-controls="mediaUpload">
                Add Images or Videos to my review
            </button>

            <?php echo HTMLHelper::_('uitab.endTab'); ?>
            <div class="control-group my-5">
                <div class="controls">
                    <?php if ($this->canSave): ?>
                        <button type="submit" class="validate btn btn-primary">
                            <?php echo Text::_('JSUBMIT'); ?>
                        </button>
                    <?php endif; ?>
                    <a class="btn btn-danger"
                       href="<?php echo Route::_('index.php?option=com_ugc&task=reviewform.cancel'); ?>"
                       title="<?php echo Text::_('JCANCEL'); ?>">
                        <?php echo Text::_('JCANCEL'); ?>
                    </a>
                </div>
            </div>

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

            <input type="hidden" name="option" value="com_ugc"/>
            <input type="hidden" name="task" value="reviewform.save"/>
            <?php echo HTMLHelper::_('form.token'); ?>
        </form>
    </div>
</div>
