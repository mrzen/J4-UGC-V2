<?php
/**
 * @package    Com_Ugc_new
 * @author     Matt Illston <matt.illston@mrzen.com>
 * @copyright  2023 Matt Illston
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Router\ApiRouter;

/**
 * Web Services adapter for ugc_new.
 *
 * @since  1.0.0
 */
class PlgWebservicesUgc_new extends CMSPlugin
{
	public function onBeforeApiRoute(&$router)
	{
		
		$router->createCRUDRoutes('v1/ugc_new/images', 'images', ['component' => 'com_ugc_new']);
	}
}
