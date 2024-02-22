<?php
/**
 * @package    Com_Ugc_new
 * @subpackage Privacy.image
 * @author     Matt Illston <matt.illston@mrzen.com>
 * @copyright  2023 Matt Illston
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\User\User;
use Joomla\Component\Privacy\Administrator\Plugin\PrivacyPlugin;
use Joomla\Component\Privacy\Administrator\Table\RequestTable;

/**
 * Privacy plugin managing Joomla user image data
 *
 * @since  1.0.0
 */
class PlgPrivacyXXX_UCFIRST_COMPONENT_PLUGIN_TABLE_NAME_XXX extends PrivacyPlugin
{
	/**
	 * Processes an export request for image data
	 *
	 * This event will collect data for the image table
	 *
	 * @param   RequestTable  $request  The request record being processed
	 * @param   User          $user     The user account associated with this request if available
	 *
	 * @return  \Joomla\Component\Privacy\Administrator\Export\Domain[]
	 *
	 * @since   1.0.0
	 */
	public function onPrivacyExportRequest(RequestTable $request, User $user = null)
	{
		if (!$user)
		{
			return array();
		}

		$domains   = array();
		$domain    = $this->createDomain('user_image', 'joomla_user_image_data');
		$domains[] = $domain;

		$query = $this->db->getQuery(true)
			->select('*')
			->from($this->db->quoteName('#__ugc_images'))
			->where($this->db->quoteName('created_by') . ' = ' . (int) $user->id);

		$items = $this->db->setQuery($query)->loadObjectList();

		foreach ($items as $item)
		{
			$domain->addItem($this->createItemFromArray((array) $item));
		}

		$domains[] = $this->createCustomFieldsDomain('com_ugc_new.image', $items);

		return $domains;
	}

	/**
	 * Removes the data associated with a remove information request
	 *
	 * This event will pseudoanonymise the image
	 *
	 * @param   RequestTable  $request  The request record being processed
	 * @param   User          $user     The user account associated with this request if available
	 *
	 * @return  void
	 *
	 * @since   1.0.0
	 */
	public function onPrivacyRemoveData(RequestTable $request, User $user = null)
	{
		// This plugin only processes data for registered user accounts
		if (!$user)
		{
			return;
		}

		$db = $this->db;

		$query = $db->getQuery(true);

		$query->clear()
			->delete($db->quoteName('#__ugc_images'))
			->where($this->db->quoteName('created_by') . ' = ' . (int) $user->id);

		$db->setQuery($query)
			->execute();
	}
}
