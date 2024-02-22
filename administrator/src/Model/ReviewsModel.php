<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Ugc_new
 * @author     Matt Illston <matt.illston@mrzen.com>
 * @copyright  2023 Matt Illston
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Ugc\Component\Ugc_new\Administrator\Model;
// No direct access.
defined('_JEXEC') or die;

use \Joomla\CMS\MVC\Model\ListModel;
use \Joomla\Component\Fields\Administrator\Helper\FieldsHelper;
use \Joomla\CMS\Factory;
use \Joomla\CMS\Language\Text;
use \Joomla\CMS\Helper\TagsHelper;
use \Joomla\Database\ParameterType;
use \Joomla\Utilities\ArrayHelper;
use Ugc\Component\Ugc_new\Administrator\Helper\Ugc_newHelper;

/**
 * Methods supporting a list of Reviews records.
 *
 * @since  1.0.0
 */
class ReviewsModel extends ListModel
{
	/**
	* Constructor.
	*
	* @param   array  $config  An optional associative array of configuration settings.
	*
	* @see        JController
	* @since      1.6
	*/
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id', 'a.id',
				'state', 'a.state',
				'ordering', 'a.ordering',
				'created_by', 'a.created_by',
				'modified_by', 'a.modified_by',
				'created_at', 'a.created_at',
				'trip_code', 'a.trip_code',
				'rating', 'a.rating',
				'review_title', 'a.review_title',
				'review_content', 'a.review_content',
				'user_id', 'a.user_id',
				'user_name', 'a.user_name',
				'user_location', 'a.user_location',
				'country', 'a.country',
				'image1', 'a.image1',
				'image2', 'a.image2',
				'image3', 'a.image3',
				'image4', 'a.image4',
				'image5', 'a.image5',
				'image6', 'a.image6',
				'image7', 'a.image7',
				'image8', 'a.image8',
				'image9', 'a.image9',
				'image10', 'a.image10',
				'videos', 'a.videos',
				'review_reply', 'a.review_reply',
			);
		}

		parent::__construct($config);
	}


	

	

	

	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @param   string  $ordering   Elements order
	 * @param   string  $direction  Order direction
	 *
	 * @return void
	 *
	 * @throws Exception
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		// List state information.
		parent::populateState('', 'ASC');

		$context = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $context);

		// Split context into component and optional section
		if (!empty($context))
		{
			$parts = FieldsHelper::extract($context);

			if ($parts)
			{
				$this->setState('filter.component', $parts[0]);
				$this->setState('filter.section', $parts[1]);
			}
		}
	}

	/**
	 * Method to get a store id based on model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param   string  $id  A prefix for the store id.
	 *
	 * @return  string A store id.
	 *
	 * @since   1.0.0
	 */
	protected function getStoreId($id = '')
	{
		// Compile the store id.
		$id .= ':' . $this->getState('filter.search');
		$id .= ':' . $this->getState('filter.state');

		
		return parent::getStoreId($id);
		
	}

	/**
	 * Build an SQL query to load the list data.
	 *
	 * @return  DatabaseQuery
	 *
	 * @since   1.0.0
	 */
	protected function getListQuery()
	{
		// Create a new query object.
		$db    = $this->getDbo();
		$query = $db->getQuery(true);

		// Select the required fields from the table.
		$query->select(
			$this->getState(
				'list.select', 'DISTINCT a.*'
			)
		);
		$query->from('`#__ugc_reviews` AS a');
		
		// Join over the users for the checked out user
		$query->select("uc.name AS uEditor");
		$query->join("LEFT", "#__users AS uc ON uc.id=a.checked_out");

		// Join over the user field 'created_by'
		$query->select('`created_by`.name AS `created_by`');
		$query->join('LEFT', '#__users AS `created_by` ON `created_by`.id = a.`created_by`');

		// Join over the user field 'modified_by'
		$query->select('`modified_by`.name AS `modified_by`');
		$query->join('LEFT', '#__users AS `modified_by` ON `modified_by`.id = a.`modified_by`');
		// Join over the tags: tags
		$tag = $this->getState('filter.tag');
		// Run simplified query when filtering by one tag.
		if (\is_array($tag) && \count($tag) === 1)
		{
			$tag = $tag[0];
		}
		if ($tag && \is_array($tag))
		{
			$tag = ArrayHelper::toInteger($tag);
			$subQuery = $db->getQuery(true)
				->select('DISTINCT ' . $db->quoteName('content_item_id'))
				->from($db->quoteName('#__contentitem_tag_map'))
				->where(
					[
						$db->quoteName('tag_id') . ' IN (' . implode(',', $query->bindArray($tag)) . ')',
						$db->quoteName('type_alias') . ' = ' . $db->quote('com_ugc_new.review'),
					]
				);
			$query->join(
				'INNER',
				'(' . $subQuery . ') AS ' . $db->quoteName('tagmap')  . ' ON ' . $db->quoteName('tagmap.content_item_id') . ' = ' . $db->quoteName('a.id')
			);
		}
		elseif ($tag = (int) $tag)
		{
			$query->join(
				'INNER',
				$db->quoteName('#__contentitem_tag_map', 'tagmap') . ' ON ' . $db->quoteName('tagmap.content_item_id') . ' = ' . $db->quoteName('a.id')
			)
			->where(
				[
					$db->quoteName('tagmap.tag_id') . ' = :tag',
					$db->quoteName('tagmap.type_alias') . ' = ' . $db->quote('com_ugc_new.review'),
				]
			)
			->bind(':tag', $tag, ParameterType::INTEGER);
		}
		

		// Filter by published state
		$published = $this->getState('filter.state');

		if (is_numeric($published))
		{
			$query->where('a.state = ' . (int) $published);
		}
		elseif (empty($published))
		{
			$query->where('(a.state IN (0, 1))');
		}

		// Filter by search in title
		$search = $this->getState('filter.search');

		if (!empty($search))
		{
			if (stripos($search, 'id:') === 0)
			{
				$query->where('a.id = ' . (int) substr($search, 3));
			}
			else
			{
				$search = $db->Quote('%' . $db->escape($search, true) . '%');
				
			}
		}
		
		// Add the list ordering clause.
		$orderCol  = $this->state->get('list.ordering', '');
		$orderDirn = $this->state->get('list.direction', 'ASC');

		if ($orderCol && $orderDirn)
		{
			$query->order($db->escape($orderCol . ' ' . $orderDirn));
		}

		return $query;
	}

	/**
	 * Get an array of data items
	 *
	 * @return mixed Array of data items on success, false on failure.
	 */
	public function getItems()
	{
		$items = parent::getItems();
		

		return $items;
	}
}
