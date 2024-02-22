<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Ugc_new
 * @author     Matt Illston <matt.illston@mrzen.com>
 * @copyright  2023 Matt Illston
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Ugc\Component\Ugc_new\Api\View\Images;

\defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\JsonApiView as BaseApiView;

/**
 * The Images view
 *
 * @since  1.0.0
 */
class JsonApiView extends BaseApiView
{
	/**
	 * The fields to render item in the documents
	 *
	 * @var    array
	 * @since  1.0.0
	 */
	protected $fieldsToRenderItem = [
		'id', 
		'state', 
		'ordering', 
		'image_path', 
		'title', 
		'created_at', 
	];

	/**
	 * The fields to render items in the documents
	 *
	 * @var    array
	 * @since  1.0.0
	 */
	protected $fieldsToRenderList = [
		'id', 
		'state', 
		'ordering', 
		'image_path', 
		'title', 
		'created_at', 
	];
}