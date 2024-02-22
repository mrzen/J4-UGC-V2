<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Ugc_new
 * @author     Matt Illston <matt.illston@mrzen.com>
 * @copyright  2023 Matt Illston
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Ugc\Component\Ugc_new\Site\Dispatcher;

defined('JPATH_PLATFORM') or die;

use Joomla\CMS\Dispatcher\ComponentDispatcher;
use Joomla\CMS\Language\Text;

/**
 * ComponentDispatcher class for Com_Ugc_new
 *
 * @since  1.0.0
 */
class Dispatcher extends ComponentDispatcher
{
	/**
	 * Dispatch a controller task. Redirecting the user if appropriate.
	 *
	 * @return  void
	 *
	 * @since   1.0.0
	 */
	public function dispatch()
	{
		parent::dispatch();
	}
}
