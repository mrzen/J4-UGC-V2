<?php
/**
 * @version     CVS: 1.0.0
 * @package     com_ugc_new
 * @subpackage  mod_ugc_new
 * @author      Matt Illston <matt.illston@mrzen.com>
 * @copyright   2023 Matt Illston
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

use Ugc\Module\Ugc_new\Site\Helper\Ugc_newHelper;

$element = Ugc_newHelper::getItem($params);
?>

<?php if (!empty($element)) : ?>
	<div>
		<?php $fields = get_object_vars($element); ?>
		<?php foreach ($fields as $field_name => $field_value) : ?>
			<?php if (Ugc_newHelper::shouldAppear($field_name)): ?>
				<div class="row">
					<div class="span4">
						<strong><?php echo Ugc_newHelper::renderTranslatableHeader($params->get('item_table'), $field_name); ?></strong>
					</div>
					<div
						class="span8"><?php echo Ugc_newHelper::renderElement($params->get('item_table'), $field_name, $field_value); ?></div>
				</div>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
<?php endif;
