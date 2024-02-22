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

use \Joomla\CMS\Table\Table;
use \Joomla\CMS\Factory;
use \Joomla\CMS\Language\Text;
use \Joomla\CMS\Plugin\PluginHelper;
use \Joomla\CMS\MVC\Model\AdminModel;
use \Joomla\CMS\Helper\TagsHelper;
use \Joomla\CMS\Filter\OutputFilter;

/**
 * Review model.
 *
 * @since  1.0.0
 */
class ReviewModel extends AdminModel
{
	/**
	 * @var    string  The prefix to use with controller messages.
	 *
	 * @since  1.0.0
	 */
	protected $text_prefix = 'COM_UGC_NEW';

	/**
	 * @var    string  Alias to manage history control
	 *
	 * @since  1.0.0
	 */
	public $typeAlias = 'com_ugc_new.review';

	/**
	 * @var    null  Item data
	 *
	 * @since  1.0.0
	 */
	protected $item = null;

	
	

	/**
	 * Returns a reference to the a Table object, always creating it.
	 *
	 * @param   string  $type    The table type to instantiate
	 * @param   string  $prefix  A prefix for the table class name. Optional.
	 * @param   array   $config  Configuration array for model. Optional.
	 *
	 * @return  Table    A database object
	 *
	 * @since   1.0.0
	 */
	public function getTable($type = 'Review', $prefix = 'Administrator', $config = array())
	{
		return parent::getTable($type, $prefix, $config);
	}

	/**
	 * Method to get the record form.
	 *
	 * @param   array    $data      An optional array of data for the form to interogate.
	 * @param   boolean  $loadData  True if the form is to load its own data (default case), false if not.
	 *
	 * @return  \JForm|boolean  A \JForm object on success, false on failure
	 *
	 * @since   1.0.0
	 */
	public function getForm($data = array(), $loadData = true)
	{
		// Initialise variables.
		$app = Factory::getApplication();

		// Get the form.
		$form = $this->loadForm(
								'com_ugc_new.review', 
								'review',
								array(
									'control' => 'jform',
									'load_data' => $loadData 
								)
							);

		

		if (empty($form))
		{
			return false;
		}

		return $form;
	}

	
	/**
	* Method to save the form data.
	*
	* @param   array  $data  The form data.
	*
	* @return  boolean  True on success, False on error.
	*
	* @since   1.6
	*/
	public function save($data)
	{
		$holidayCode = $data['trip_code'];
		// GraphQL Query to get main holiday data
		$client = Factory::getContainer()->get('rezkit.tours');
		$v = $client->query(<<<'GRAPHQL'

		query holiday($holidayCode: String!) {
				holiday(code: $holidayCode) {
					id
					code
					categories {
						name
						parent {
							name
						}
					}
					versions(published: true) {
							id
							name
							code
							locations {
								name
							}
						}
				}
		}
		GRAPHQL
		, ['holidayCode' => $holidayCode,
		] );

		// ----------------------------------------------------
		// Execute fetch of holiday data from GraphQL query
		// ----------------------------------------------------
		$this->holidayData = $v->getData();

		if ($errors = $v->getErrors()) {
			dump($errors);
		}
    // Extract location names and add them to tags
    foreach ($this->holidayData['holiday']['versions'] as $version) {
        foreach ($version['locations'] as $location) {
            $tags[] = '#new#'.$location['name'];
        }
    }

		foreach ($this->holidayData['holiday']['categories'] as $category) {
			$tags[] = '#new#'.$category['name'];
			if (isset($category['parent'])) {
				$tags[] = '#new#'.$category['parent']['name'];
			}
		}

    // If tags exist in $data and it's not an array, convert it to an array
    if (array_key_exists('tags', $data) && !is_array($data['tags']) && !empty($data['tags'])) {
        $data['tags'] = [$data['tags']];
    }

    // Merge extracted tags with existing tags (if any)
    $data['tags'] = array_merge($data['tags'] ?? [], $tags);

    // Call parent save method
    return parent::save($data);
}

	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return  mixed  The data for the form.
	 *
	 * @since   1.0.0
	 */
	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$data = Factory::getApplication()->getUserState('com_ugc_new.edit.review.data', array());

		if (empty($data))
		{
			if ($this->item === null)
			{
				$this->item = $this->getItem();
			}

			$data = $this->item;
			
		}

		return $data;
	}

	/**
	 * Method to get a single record.
	 *
	 * @param   integer  $pk  The id of the primary key.
	 *
	 * @return  mixed    Object on success, false on failure.
	 *
	 * @since   1.0.0
	 */
	public function getItem($pk = null)
	{
		
			if ($item = parent::getItem($pk))
			{
				if (isset($item->params))
				{
					$item->params = json_encode($item->params);
				}
				
			if ( !empty($item->id) ) {
					$tagsHelper = new TagsHelper;
					$item->tags = $tagsHelper->getTagIds($item->id, 'com_ugc_new.review');
				}
				// Do any procesing on fields here if needed
			}

			return $item;
		
	}

	/**
	 * Method to duplicate an Review
	 *
	 * @param   array  &$pks  An array of primary key IDs.
	 *
	 * @return  boolean  True if successful.
	 *
	 * @throws  Exception
	 */
	public function duplicate(&$pks)
	{
		$app = Factory::getApplication();
		$user = $app->getIdentity();

		// Access checks.
		if (!$user->authorise('core.create', 'com_ugc_new'))
		{
			throw new \Exception(Text::_('JERROR_CORE_CREATE_NOT_PERMITTED'));
		}

		$context    = $this->option . '.' . $this->name;

		// Include the plugins for the save events.
		PluginHelper::importPlugin($this->events_map['save']);

		$table = $this->getTable();

		foreach ($pks as $pk)
		{
			
				if ($table->load($pk, true))
				{
					// Reset the id to create a new record.
					$table->id = 0;

					if (!$table->check())
					{
						throw new \Exception($table->getError());
					}
					

					// Trigger the before save event.
					$result = $app->triggerEvent($this->event_before_save, array($context, &$table, true, $table));

					if (in_array(false, $result, true) || !$table->store())
					{
						throw new \Exception($table->getError());
					}

					// Trigger the after save event.
					$app->triggerEvent($this->event_after_save, array($context, &$table, true));
				}
				else
				{
					throw new \Exception($table->getError());
				}
			
		}

		// Clean cache
		$this->cleanCache();

		return true;
	}

	/**
	 * Prepare and sanitise the table prior to saving.
	 *
	 * @param   Table  $table  Table Object
	 *
	 * @return  void
	 *
	 * @since   1.0.0
	 */
	protected function prepareTable($table)
	{
		jimport('joomla.filter.output');

		if (empty($table->id))
		{
			// Set ordering to the last item if not set
			if (@$table->ordering === '')
			{
				$db = $this->getDbo();
				$db->setQuery('SELECT MAX(ordering) FROM #__ugc_reviews');
				$max             = $db->loadResult();
				$table->ordering = $max + 1;
			}
		}
	}
}
