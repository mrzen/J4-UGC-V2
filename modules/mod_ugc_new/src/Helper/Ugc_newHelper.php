<?php

/**
 * @version     CVS: 1.0.0
 * @package     com_ugc_new
 * @subpackage  mod_ugc_new
 * @author      Matt Illston <matt.illston@mrzen.com>
 * @copyright   2023 Matt Illston
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Ugc\Module\Ugc_new\Site\Helper;

\defined('_JEXEC') or die;

use \Joomla\CMS\Factory;
use \Joomla\CMS\Language\Text;
use \Joomla\CMS\Language\Language;
use \Joomla\CMS\User\UserFactoryInterface;

/**
 * Helper for mod_ugc_new
 *
 * @package     com_ugc_new
 * @subpackage  mod_ugc_new
 * @since       1.0.0
 */
Class Ugc_newHelper
{
	/**
	 * Retrieve component items
	 *
	 * @param   Joomla\Registry\Registry &$params module parameters
	 *
	 * @return array Array with all the elements
	 *
	 * @throws Exception
	 */
	public static function getList(&$params)
	{
		$app   = Factory::getApplication();
		$db    = Factory::getContainer()->get('DatabaseDriver');
		$query = $db->getQuery(true);

		$tableField = explode(':', $params->get('field'));
		$table_name = !empty($tableField[0]) ? $tableField[0] : '';

		/* @var $params Joomla\Registry\Registry */
		$query
			->select('*')
			->from($table_name)
			->where('state = 1');

		$db->setQuery($query, $app->input->getInt('offset', (int) $params->get('offset')), $app->input->getInt('limit', (int) $params->get('limit')));
		$rows = $db->loadObjectList();

		return $rows;
	}

	/**
	 * Retrieve component items
	 *
	 * @param   Joomla\Registry\Registry &$params module parameters
	 *
	 * @return mixed stdClass object if the item was found, null otherwise
	 */
	public static function getItem(&$params)
	{
		$db    = Factory::getContainer()->get('DatabaseDriver');
		$query = $db->getQuery(true);

		/* @var $params Joomla\Registry\Registry */
		$query
			->select('*')
			->from($params->get('item_table'))
			->where('id = ' . intval($params->get('item_id')));

		$db->setQuery($query);
		$element = $db->loadObject();

		return $element;
	}

	/**
	 * Render element
	 *
	 * @param   Joomla\Registry\Registry $table_name  Table name
	 * @param   string                   $field_name  Field name
	 * @param   string                   $field_value Field value
	 *
	 * @return string
	 */
	public static function renderElement($table_name, $field_name, $field_value)
	{
		$result = '';
		
		if(strpos($field_name, ':'))
		{
			$tableField = explode(':', $field_name);
			$table_name = !empty($tableField[0]) ? $tableField[0] : '';
			$field_name = !empty($tableField[1]) ? $tableField[1] : '';
		}
		
		switch ($table_name)
		{
			
		case '#__ugc_reviews':
		switch($field_name){
		case 'id':
		$result = $field_value;
		break;
		case 'created_by':
		$container = \Joomla\CMS\Factory::getContainer();
		$userFactory = $container->get(UserFactoryInterface::class);
		$user = $userFactory->loadUserById($field_value);
		$result = $user->name;
		break;
		case 'modified_by':
		$container = \Joomla\CMS\Factory::getContainer();
		$userFactory = $container->get(UserFactoryInterface::class);
		$user = $userFactory->loadUserById($field_value);
		$result = $user->name;
		break;
		case 'created_at':
		$result = $field_value;
		break;
		case 'trip_code':
		$result = $field_value;
		break;
		case 'rating':
		$result = $field_value;
		break;
		case 'review_title':
		$result = $field_value;
		break;
		case 'review_content':
		$result = $field_value;
		break;
		case 'user_id':
		$result = $field_value;
		break;
		case 'user_name':
		$result = $field_value;
		break;
		case 'user_location':
		$result = $field_value;
		break;
		case 'country':
		$result = $field_value;
		break;
		case 'tags':
		$result = self::loadValueFromExternalTable('#__tags', 'id', 'title', $field_value);
		break;
		case 'videos':
		$result = $field_value;
		break;
		case 'review_reply':
		$result = $field_value;
		break;
		}
		break;
		case '#__ugc_images':
		switch($field_name){
		case 'id':
		$result = $field_value;
		break;
		case 'created_by':
		$container = \Joomla\CMS\Factory::getContainer();
		$userFactory = $container->get(UserFactoryInterface::class);
		$user = $userFactory->loadUserById($field_value);
		$result = $user->name;
		break;
		case 'modified_by':
		$container = \Joomla\CMS\Factory::getContainer();
		$userFactory = $container->get(UserFactoryInterface::class);
		$user = $userFactory->loadUserById($field_value);
		$result = $user->name;
		break;
		case 'review_id':
		$result = self::loadValueFromExternalTable('#__ugc_reviews', 'id', 'id', $field_value);
		break;
		case 'image_path':
		$result = $field_value;
		break;
		case 'title':
		$result = $field_value;
		break;
		case 'created_at':
		$result = $field_value;
		break;
		}
		break;
		}

		return $result;
	}

	/**
	 * Returns the translatable name of the element
	 *
	 * @param   string .................. $table_name table name
	 * @param   string                   $field   Field name
	 *
	 * @return string Translatable name.
	 */
	public static function renderTranslatableHeader($table_name, $field)
	{
		return Text::_(
			'MOD_UGC_NEW_HEADER_FIELD_' . str_replace('#__', '', strtoupper($table_name)) . '_' . strtoupper($field)
		);
	}

	/**
	 * Checks if an element should appear in the table/item view
	 *
	 * @param   string $field name of the field
	 *
	 * @return boolean True if it should appear, false otherwise
	 */
	public static function shouldAppear($field)
	{
		$noHeaderFields = array('checked_out_time', 'checked_out', 'ordering', 'state');

		return !in_array($field, $noHeaderFields);
	}

	

    /**
     * Method to get a value from a external table
     * @param string $source_table Source table name
     * @param string $key_field Source key field 
     * @param string $value_field Source value field
     * @param mixed  $key_value Value for the key field
     * @return mixed The value in the external table or null if it wasn't found
     */
    private static function loadValueFromExternalTable($source_table, $key_field, $value_field, $key_value) {
        $db = Factory::getContainer()->get('DatabaseDriver');
        $query = $db->getQuery(true);

        $query
                ->select($db->quoteName($value_field))
                ->from($source_table)
                ->where($db->quoteName($key_field) . ' = ' . $db->quote($key_value));


        $db->setQuery($query);
        return $db->loadResult();
    }
}
