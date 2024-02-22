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

$elements = Ugc_newHelper::getList($params);

$tableField = explode(':', $params->get('field'));
$table_name = !empty($tableField[0]) ? $tableField[0] : '';
$field_name = !empty($tableField[1]) ? $tableField[1] : '';
?>

<?php if (!empty($elements)) : ?>
	<table class="jcc-table">
		<?php foreach ($elements as $element) : ?>
			<tr>
				<th><?php echo Ugc_newHelper::renderTranslatableHeader($table_name, $field_name); ?></th>
				<td><?php echo Ugc_newHelper::renderElement(
						$table_name, $params->get('field'), $element->{$field_name}
					); ?></td>
			</tr>
		<?php endforeach; ?>
	</table>
<?php endif;
