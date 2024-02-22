<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Ugc_new
 * @author     Matt Illston <matt.illston@mrzen.com>
 * @copyright  2023 Matt Illston
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Ugc\Component\Ugc_new\Administrator\Table;
// No direct access
defined('_JEXEC') or die;

use \Joomla\Utilities\ArrayHelper;
use \Joomla\CMS\Factory;
use \Joomla\CMS\Access\Access;
use \Joomla\CMS\Language\Text;
use \Joomla\CMS\Table\Table as Table;
use \Joomla\CMS\Versioning\VersionableTableInterface;
use Joomla\CMS\Tag\TaggableTableInterface;
use Joomla\CMS\Tag\TaggableTableTrait;
use \Joomla\Database\DatabaseDriver;
use \Joomla\CMS\Filter\OutputFilter;
use \Joomla\CMS\Filesystem\File;
use \Joomla\Registry\Registry;
use \Ugc\Component\Ugc_new\Administrator\Helper\Ugc_newHelper;
use \Joomla\CMS\Helper\ContentHelper;


/**
 * Review table
 *
 * @since 1.0.0
 */
class ReviewTable extends Table implements VersionableTableInterface, TaggableTableInterface
{
	use TaggableTableTrait;

	/**
     * Indicates that columns fully support the NULL value in the database
     *
     * @var    boolean
     * @since  4.0.0
     */
    protected $_supportNullValue = true;

	
	/**
	 * Constructor
	 *
	 * @param   JDatabase  &$db  A database connector object
	 */
	public function __construct(DatabaseDriver $db)
	{
		$this->typeAlias = 'com_ugc_new.review';
		parent::__construct('#__ugc_reviews', 'id', $db);
		$this->setColumnAlias('published', 'state');
		
	}

	/**
	 * Get the type alias for the history table
	 *
	 * @return  string  The alias as described above
	 *
	 * @since   1.0.0
	 */
	public function getTypeAlias()
	{
		return $this->typeAlias;
	}

	/**
	 * Overloaded bind function to pre-process the params.
	 *
	 * @param   array  $array   Named array
	 * @param   mixed  $ignore  Optional array or list of parameters to ignore
	 *
	 * @return  boolean  True on success.
	 *
	 * @see     Table:bind
	 * @since   1.0.0
	 * @throws  \InvalidArgumentException
	 */
	public function bind($array, $ignore = '')
	{
		$date = Factory::getDate();
		$task = Factory::getApplication()->input->get('task');
		$user = Factory::getApplication()->getIdentity();
		
		$input = Factory::getApplication()->input;
		$task = $input->getString('task', '');

		if ($array['id'] == 0 && empty($array['created_by']))
		{
			$array['created_by'] = Factory::getUser()->id;
		}

		if ($array['id'] == 0 && empty($array['modified_by']))
		{
			$array['modified_by'] = Factory::getUser()->id;
		}

		if ($task == 'apply' || $task == 'save')
		{
			$array['modified_by'] = Factory::getUser()->id;
		}

		if ($array['id'] == 0)
		{
			$array['created_at'] = $date->toSql();
		}

		if($array['rating'] === '')
		{
			$array['rating'] = NULL;
			$this->rating = NULL;
		}
		// Support for multi file field: image1
		if (!empty($array['image1']))
		{
			if (is_array($array['image1']))
			{
				$array['image1'] = implode(',', $array['image1']);
			}
			elseif (strpos($array['image1'], ',') != false)
			{
				$array['image1'] = explode(',', $array['image1']);
			}
		}
		else
		{
			$array['image1'] = '';
		}

		// Support for multi file field: image2
		if (!empty($array['image2']))
		{
			if (is_array($array['image2']))
			{
				$array['image2'] = implode(',', $array['image2']);
			}
			elseif (strpos($array['image2'], ',') != false)
			{
				$array['image2'] = explode(',', $array['image2']);
			}
		}
		else
		{
			$array['image2'] = '';
		}

		// Support for multi file field: image3
		if (!empty($array['image3']))
		{
			if (is_array($array['image3']))
			{
				$array['image3'] = implode(',', $array['image3']);
			}
			elseif (strpos($array['image3'], ',') != false)
			{
				$array['image3'] = explode(',', $array['image3']);
			}
		}
		else
		{
			$array['image3'] = '';
		}

		// Support for multi file field: image4
		if (!empty($array['image4']))
		{
			if (is_array($array['image4']))
			{
				$array['image4'] = implode(',', $array['image4']);
			}
			elseif (strpos($array['image4'], ',') != false)
			{
				$array['image4'] = explode(',', $array['image4']);
			}
		}
		else
		{
			$array['image4'] = '';
		}

		// Support for multi file field: image5
		if (!empty($array['image5']))
		{
			if (is_array($array['image5']))
			{
				$array['image5'] = implode(',', $array['image5']);
			}
			elseif (strpos($array['image5'], ',') != false)
			{
				$array['image5'] = explode(',', $array['image5']);
			}
		}
		else
		{
			$array['image5'] = '';
		}

		// Support for multi file field: image6
		if (!empty($array['image6']))
		{
			if (is_array($array['image6']))
			{
				$array['image6'] = implode(',', $array['image6']);
			}
			elseif (strpos($array['image6'], ',') != false)
			{
				$array['image6'] = explode(',', $array['image6']);
			}
		}
		else
		{
			$array['image6'] = '';
		}

		// Support for multi file field: image7
		if (!empty($array['image7']))
		{
			if (is_array($array['image7']))
			{
				$array['image7'] = implode(',', $array['image7']);
			}
			elseif (strpos($array['image7'], ',') != false)
			{
				$array['image7'] = explode(',', $array['image7']);
			}
		}
		else
		{
			$array['image7'] = '';
		}

		// Support for multi file field: image8
		if (!empty($array['image8']))
		{
			if (is_array($array['image8']))
			{
				$array['image8'] = implode(',', $array['image8']);
			}
			elseif (strpos($array['image8'], ',') != false)
			{
				$array['image8'] = explode(',', $array['image8']);
			}
		}
		else
		{
			$array['image8'] = '';
		}

		// Support for multi file field: image9
		if (!empty($array['image9']))
		{
			if (is_array($array['image9']))
			{
				$array['image9'] = implode(',', $array['image9']);
			}
			elseif (strpos($array['image9'], ',') != false)
			{
				$array['image9'] = explode(',', $array['image9']);
			}
		}
		else
		{
			$array['image9'] = '';
		}

		// Support for multi file field: image10
		if (!empty($array['image10']))
		{
			if (is_array($array['image10']))
			{
				$array['image10'] = implode(',', $array['image10']);
			}
			elseif (strpos($array['image10'], ',') != false)
			{
				$array['image10'] = explode(',', $array['image10']);
			}
		}
		else
		{
			$array['image10'] = '';
		}


		if (isset($array['params']) && is_array($array['params']))
		{
			$registry = new Registry;
			$registry->loadArray($array['params']);
			$array['params'] = (string) $registry;
		}

		if (isset($array['metadata']) && is_array($array['metadata']))
		{
			$registry = new Registry;
			$registry->loadArray($array['metadata']);
			$array['metadata'] = (string) $registry;
		}

		if (!$user->authorise('core.admin', 'com_ugc_new.review.' . $array['id']))
		{
			$actions         = Access::getActionsFromFile(
				JPATH_ADMINISTRATOR . '/components/com_ugc_new/access.xml',
				"/access/section[@name='review']/"
			);
			$default_actions = Access::getAssetRules('com_ugc_new.review.' . $array['id'])->getData();
			$array_jaccess   = array();

			foreach ($actions as $action)
			{
				if (key_exists($action->name, $default_actions))
				{
					$array_jaccess[$action->name] = $default_actions[$action->name];
				}
			}

			$array['rules'] = $this->JAccessRulestoArray($array_jaccess);
		}

		// Bind the rules for ACL where supported.
		if (isset($array['rules']) && is_array($array['rules']))
		{
			$this->setRules($array['rules']);
		}

		return parent::bind($array, $ignore);
	}

	/**
	 * Method to store a row in the database from the Table instance properties.
	 *
	 * If a primary key value is set the row with that primary key value will be updated with the instance property values.
	 * If no primary key value is set a new row will be inserted into the database with the properties from the Table instance.
	 *
	 * @param   boolean  $updateNulls  True to update fields even if they are null.
	 *
	 * @return  boolean  True on success.
	 *
	 * @since   1.0.0
	 */
	public function store($updateNulls = true)
	{
		
		return parent::store($updateNulls);
	}

	/**
	 * This function convert an array of Access objects into an rules array.
	 *
	 * @param   array  $jaccessrules  An array of Access objects.
	 *
	 * @return  array
	 */
	private function JAccessRulestoArray($jaccessrules)
	{
		$rules = array();

		foreach ($jaccessrules as $action => $jaccess)
		{
			$actions = array();

			if ($jaccess)
			{
				foreach ($jaccess->getData() as $group => $allow)
				{
					$actions[$group] = ((bool)$allow);
				}
			}

			$rules[$action] = $actions;
		}

		return $rules;
	}

	/**
	 * Overloaded check function
	 *
	 * @return bool
	 */
	public function check()
	{
		// If there is an ordering column and this is a new row then get the next ordering value
		if (property_exists($this, 'ordering') && $this->id == 0)
		{
			$this->ordering = self::getNextOrder();
		}
		
		
		// Support multi file field: image1
		$app = Factory::getApplication();
		$files = $app->input->files->get('jform', array(), 'raw');
		$array = $app->input->get('jform', array(), 'ARRAY');
		if (empty($files['image1'][0])){
			$temp = $files;
			$files = array();
			$files['image1'][] = $temp['image1'];
		}

		if ($files['image1'][0]['size'] > 0)
		{
			// Deleting existing files
			$oldFiles = Ugc_newHelper::getFiles($this->id, $this->_tbl, 'image1');

			foreach ($oldFiles as $f)
			{
				$oldFile = JPATH_ROOT . '/ugc/images/' . $f;

				if (file_exists($oldFile) && !is_dir($oldFile))
				{
					unlink($oldFile);
				}
			}

			$this->image1 = "";

			foreach ($files['image1'] as $singleFile )
			{
				jimport('joomla.filesystem.file');

				// Check if the server found any error.
				$fileError = $singleFile['error'];
				$message = '';

				if ($fileError > 0 && $fileError != 4)
				{
					switch ($fileError)
					{
						case 1:
							$message = Text::_('File size exceeds allowed by the server');
							break;
						case 2:
							$message = Text::_('File size exceeds allowed by the html form');
							break;
						case 3:
							$message = Text::_('Partial upload error');
							break;
					}

					if ($message != '')
					{
						$app->enqueueMessage($message, 'warning');

						return false;
					}
				}
				elseif ($fileError == 4)
				{
					if (isset($array['image1']))
					{
						$this->image1 = $array['image1'];
					}
				}
				else
				{

					// Check for filetype
					$okMIMETypes = 'image/png,image/jpeg';
					$validMIMEArray = explode(',', $okMIMETypes);
					$fileMime = $singleFile['type'];

					if (!in_array($fileMime, $validMIMEArray))
					{
						$app->enqueueMessage('This filetype is not allowed', 'warning');

						return false;
					}

					// Replace any special characters in the filename
					jimport('joomla.filesystem.file');
					$filename = File::stripExt($singleFile['name']);
					$extension = File::getExt($singleFile['name']);
					$filename = preg_replace("/[^A-Za-z0-9]/i", "-", $filename);
					$filename = $filename . '.' . $extension;
					$uploadPath = JPATH_ROOT . '/ugc/images/' . $filename;
					$fileTemp = $singleFile['tmp_name'];

					if (!File::exists($uploadPath))
					{
						if (!File::upload($fileTemp, $uploadPath))
						{
							$app->enqueueMessage('Error moving file', 'warning');

							return false;
						}
					}

					$this->image1 .= (!empty($this->image1)) ? "," : "";
					$this->image1 .= $filename;
				}
			}
		}
		else
		{
			$this->image1 .= $array['image1_hidden'];
		}
		// Support multi file field: image2
		$app = Factory::getApplication();
		$files = $app->input->files->get('jform', array(), 'raw');
		$array = $app->input->get('jform', array(), 'ARRAY');
		if (empty($files['image2'][0])){
			$temp = $files;
			$files = array();
			$files['image2'][] = $temp['image2'];
		}

		if ($files['image2'][0]['size'] > 0)
		{
			// Deleting existing files
			$oldFiles = Ugc_newHelper::getFiles($this->id, $this->_tbl, 'image2');

			foreach ($oldFiles as $f)
			{
				$oldFile = JPATH_ROOT . '/ugc/images/' . $f;

				if (file_exists($oldFile) && !is_dir($oldFile))
				{
					unlink($oldFile);
				}
			}

			$this->image2 = "";

			foreach ($files['image2'] as $singleFile )
			{
				jimport('joomla.filesystem.file');

				// Check if the server found any error.
				$fileError = $singleFile['error'];
				$message = '';

				if ($fileError > 0 && $fileError != 4)
				{
					switch ($fileError)
					{
						case 1:
							$message = Text::_('File size exceeds allowed by the server');
							break;
						case 2:
							$message = Text::_('File size exceeds allowed by the html form');
							break;
						case 3:
							$message = Text::_('Partial upload error');
							break;
					}

					if ($message != '')
					{
						$app->enqueueMessage($message, 'warning');

						return false;
					}
				}
				elseif ($fileError == 4)
				{
					if (isset($array['image2']))
					{
						$this->image2 = $array['image2'];
					}
				}
				else
				{

					// Check for filetype
					$okMIMETypes = 'image/png,image/jpeg';
					$validMIMEArray = explode(',', $okMIMETypes);
					$fileMime = $singleFile['type'];

					if (!in_array($fileMime, $validMIMEArray))
					{
						$app->enqueueMessage('This filetype is not allowed', 'warning');

						return false;
					}

					// Replace any special characters in the filename
					jimport('joomla.filesystem.file');
					$filename = File::stripExt($singleFile['name']);
					$extension = File::getExt($singleFile['name']);
					$filename = preg_replace("/[^A-Za-z0-9]/i", "-", $filename);
					$filename = $filename . '.' . $extension;
					$uploadPath = JPATH_ROOT . '/ugc/images/' . $filename;
					$fileTemp = $singleFile['tmp_name'];

					if (!File::exists($uploadPath))
					{
						if (!File::upload($fileTemp, $uploadPath))
						{
							$app->enqueueMessage('Error moving file', 'warning');

							return false;
						}
					}

					$this->image2 .= (!empty($this->image2)) ? "," : "";
					$this->image2 .= $filename;
				}
			}
		}
		else
		{
			$this->image2 .= $array['image2_hidden'];
		}
		// Support multi file field: image3
		$app = Factory::getApplication();
		$files = $app->input->files->get('jform', array(), 'raw');
		$array = $app->input->get('jform', array(), 'ARRAY');
		if (empty($files['image3'][0])){
			$temp = $files;
			$files = array();
			$files['image3'][] = $temp['image3'];
		}

		if ($files['image3'][0]['size'] > 0)
		{
			// Deleting existing files
			$oldFiles = Ugc_newHelper::getFiles($this->id, $this->_tbl, 'image3');

			foreach ($oldFiles as $f)
			{
				$oldFile = JPATH_ROOT . '/ugc/images/' . $f;

				if (file_exists($oldFile) && !is_dir($oldFile))
				{
					unlink($oldFile);
				}
			}

			$this->image3 = "";

			foreach ($files['image3'] as $singleFile )
			{
				jimport('joomla.filesystem.file');

				// Check if the server found any error.
				$fileError = $singleFile['error'];
				$message = '';

				if ($fileError > 0 && $fileError != 4)
				{
					switch ($fileError)
					{
						case 1:
							$message = Text::_('File size exceeds allowed by the server');
							break;
						case 2:
							$message = Text::_('File size exceeds allowed by the html form');
							break;
						case 3:
							$message = Text::_('Partial upload error');
							break;
					}

					if ($message != '')
					{
						$app->enqueueMessage($message, 'warning');

						return false;
					}
				}
				elseif ($fileError == 4)
				{
					if (isset($array['image3']))
					{
						$this->image3 = $array['image3'];
					}
				}
				else
				{

					// Check for filetype
					$okMIMETypes = 'image/png,image/jpeg';
					$validMIMEArray = explode(',', $okMIMETypes);
					$fileMime = $singleFile['type'];

					if (!in_array($fileMime, $validMIMEArray))
					{
						$app->enqueueMessage('This filetype is not allowed', 'warning');

						return false;
					}

					// Replace any special characters in the filename
					jimport('joomla.filesystem.file');
					$filename = File::stripExt($singleFile['name']);
					$extension = File::getExt($singleFile['name']);
					$filename = preg_replace("/[^A-Za-z0-9]/i", "-", $filename);
					$filename = $filename . '.' . $extension;
					$uploadPath = JPATH_ROOT . '/ugc/images/' . $filename;
					$fileTemp = $singleFile['tmp_name'];

					if (!File::exists($uploadPath))
					{
						if (!File::upload($fileTemp, $uploadPath))
						{
							$app->enqueueMessage('Error moving file', 'warning');

							return false;
						}
					}

					$this->image3 .= (!empty($this->image3)) ? "," : "";
					$this->image3 .= $filename;
				}
			}
		}
		else
		{
			$this->image3 .= $array['image3_hidden'];
		}
		// Support multi file field: image4
		$app = Factory::getApplication();
		$files = $app->input->files->get('jform', array(), 'raw');
		$array = $app->input->get('jform', array(), 'ARRAY');
		if (empty($files['image4'][0])){
			$temp = $files;
			$files = array();
			$files['image4'][] = $temp['image4'];
		}

		if ($files['image4'][0]['size'] > 0)
		{
			// Deleting existing files
			$oldFiles = Ugc_newHelper::getFiles($this->id, $this->_tbl, 'image4');

			foreach ($oldFiles as $f)
			{
				$oldFile = JPATH_ROOT . '/ugc/images/' . $f;

				if (file_exists($oldFile) && !is_dir($oldFile))
				{
					unlink($oldFile);
				}
			}

			$this->image4 = "";

			foreach ($files['image4'] as $singleFile )
			{
				jimport('joomla.filesystem.file');

				// Check if the server found any error.
				$fileError = $singleFile['error'];
				$message = '';

				if ($fileError > 0 && $fileError != 4)
				{
					switch ($fileError)
					{
						case 1:
							$message = Text::_('File size exceeds allowed by the server');
							break;
						case 2:
							$message = Text::_('File size exceeds allowed by the html form');
							break;
						case 3:
							$message = Text::_('Partial upload error');
							break;
					}

					if ($message != '')
					{
						$app->enqueueMessage($message, 'warning');

						return false;
					}
				}
				elseif ($fileError == 4)
				{
					if (isset($array['image4']))
					{
						$this->image4 = $array['image4'];
					}
				}
				else
				{

					// Check for filetype
					$okMIMETypes = 'image/png,image/jpeg';
					$validMIMEArray = explode(',', $okMIMETypes);
					$fileMime = $singleFile['type'];

					if (!in_array($fileMime, $validMIMEArray))
					{
						$app->enqueueMessage('This filetype is not allowed', 'warning');

						return false;
					}

					// Replace any special characters in the filename
					jimport('joomla.filesystem.file');
					$filename = File::stripExt($singleFile['name']);
					$extension = File::getExt($singleFile['name']);
					$filename = preg_replace("/[^A-Za-z0-9]/i", "-", $filename);
					$filename = $filename . '.' . $extension;
					$uploadPath = JPATH_ROOT . '/ugc/images/' . $filename;
					$fileTemp = $singleFile['tmp_name'];

					if (!File::exists($uploadPath))
					{
						if (!File::upload($fileTemp, $uploadPath))
						{
							$app->enqueueMessage('Error moving file', 'warning');

							return false;
						}
					}

					$this->image4 .= (!empty($this->image4)) ? "," : "";
					$this->image4 .= $filename;
				}
			}
		}
		else
		{
			$this->image4 .= $array['image4_hidden'];
		}
		// Support multi file field: image5
		$app = Factory::getApplication();
		$files = $app->input->files->get('jform', array(), 'raw');
		$array = $app->input->get('jform', array(), 'ARRAY');
		if (empty($files['image5'][0])){
			$temp = $files;
			$files = array();
			$files['image5'][] = $temp['image5'];
		}

		if ($files['image5'][0]['size'] > 0)
		{
			// Deleting existing files
			$oldFiles = Ugc_newHelper::getFiles($this->id, $this->_tbl, 'image5');

			foreach ($oldFiles as $f)
			{
				$oldFile = JPATH_ROOT . '/ugc/images/' . $f;

				if (file_exists($oldFile) && !is_dir($oldFile))
				{
					unlink($oldFile);
				}
			}

			$this->image5 = "";

			foreach ($files['image5'] as $singleFile )
			{
				jimport('joomla.filesystem.file');

				// Check if the server found any error.
				$fileError = $singleFile['error'];
				$message = '';

				if ($fileError > 0 && $fileError != 4)
				{
					switch ($fileError)
					{
						case 1:
							$message = Text::_('File size exceeds allowed by the server');
							break;
						case 2:
							$message = Text::_('File size exceeds allowed by the html form');
							break;
						case 3:
							$message = Text::_('Partial upload error');
							break;
					}

					if ($message != '')
					{
						$app->enqueueMessage($message, 'warning');

						return false;
					}
				}
				elseif ($fileError == 4)
				{
					if (isset($array['image5']))
					{
						$this->image5 = $array['image5'];
					}
				}
				else
				{

					// Check for filetype
					$okMIMETypes = 'image/png,image/jpeg';
					$validMIMEArray = explode(',', $okMIMETypes);
					$fileMime = $singleFile['type'];

					if (!in_array($fileMime, $validMIMEArray))
					{
						$app->enqueueMessage('This filetype is not allowed', 'warning');

						return false;
					}

					// Replace any special characters in the filename
					jimport('joomla.filesystem.file');
					$filename = File::stripExt($singleFile['name']);
					$extension = File::getExt($singleFile['name']);
					$filename = preg_replace("/[^A-Za-z0-9]/i", "-", $filename);
					$filename = $filename . '.' . $extension;
					$uploadPath = JPATH_ROOT . '/ugc/images/' . $filename;
					$fileTemp = $singleFile['tmp_name'];

					if (!File::exists($uploadPath))
					{
						if (!File::upload($fileTemp, $uploadPath))
						{
							$app->enqueueMessage('Error moving file', 'warning');

							return false;
						}
					}

					$this->image5 .= (!empty($this->image5)) ? "," : "";
					$this->image5 .= $filename;
				}
			}
		}
		else
		{
			$this->image5 .= $array['image5_hidden'];
		}
		// Support multi file field: image6
		$app = Factory::getApplication();
		$files = $app->input->files->get('jform', array(), 'raw');
		$array = $app->input->get('jform', array(), 'ARRAY');
		if (empty($files['image6'][0])){
			$temp = $files;
			$files = array();
			$files['image6'][] = $temp['image6'];
		}

		if ($files['image6'][0]['size'] > 0)
		{
			// Deleting existing files
			$oldFiles = Ugc_newHelper::getFiles($this->id, $this->_tbl, 'image6');

			foreach ($oldFiles as $f)
			{
				$oldFile = JPATH_ROOT . '/ugc/images/' . $f;

				if (file_exists($oldFile) && !is_dir($oldFile))
				{
					unlink($oldFile);
				}
			}

			$this->image6 = "";

			foreach ($files['image6'] as $singleFile )
			{
				jimport('joomla.filesystem.file');

				// Check if the server found any error.
				$fileError = $singleFile['error'];
				$message = '';

				if ($fileError > 0 && $fileError != 4)
				{
					switch ($fileError)
					{
						case 1:
							$message = Text::_('File size exceeds allowed by the server');
							break;
						case 2:
							$message = Text::_('File size exceeds allowed by the html form');
							break;
						case 3:
							$message = Text::_('Partial upload error');
							break;
					}

					if ($message != '')
					{
						$app->enqueueMessage($message, 'warning');

						return false;
					}
				}
				elseif ($fileError == 4)
				{
					if (isset($array['image6']))
					{
						$this->image6 = $array['image6'];
					}
				}
				else
				{

					// Check for filetype
					$okMIMETypes = 'image/png,image/jpeg';
					$validMIMEArray = explode(',', $okMIMETypes);
					$fileMime = $singleFile['type'];

					if (!in_array($fileMime, $validMIMEArray))
					{
						$app->enqueueMessage('This filetype is not allowed', 'warning');

						return false;
					}

					// Replace any special characters in the filename
					jimport('joomla.filesystem.file');
					$filename = File::stripExt($singleFile['name']);
					$extension = File::getExt($singleFile['name']);
					$filename = preg_replace("/[^A-Za-z0-9]/i", "-", $filename);
					$filename = $filename . '.' . $extension;
					$uploadPath = JPATH_ROOT . '/ugc/images/' . $filename;
					$fileTemp = $singleFile['tmp_name'];

					if (!File::exists($uploadPath))
					{
						if (!File::upload($fileTemp, $uploadPath))
						{
							$app->enqueueMessage('Error moving file', 'warning');

							return false;
						}
					}

					$this->image6 .= (!empty($this->image6)) ? "," : "";
					$this->image6 .= $filename;
				}
			}
		}
		else
		{
			$this->image6 .= $array['image6_hidden'];
		}
		// Support multi file field: image7
		$app = Factory::getApplication();
		$files = $app->input->files->get('jform', array(), 'raw');
		$array = $app->input->get('jform', array(), 'ARRAY');
		if (empty($files['image7'][0])){
			$temp = $files;
			$files = array();
			$files['image7'][] = $temp['image7'];
		}

		if ($files['image7'][0]['size'] > 0)
		{
			// Deleting existing files
			$oldFiles = Ugc_newHelper::getFiles($this->id, $this->_tbl, 'image7');

			foreach ($oldFiles as $f)
			{
				$oldFile = JPATH_ROOT . '/ugc/images/' . $f;

				if (file_exists($oldFile) && !is_dir($oldFile))
				{
					unlink($oldFile);
				}
			}

			$this->image7 = "";

			foreach ($files['image7'] as $singleFile )
			{
				jimport('joomla.filesystem.file');

				// Check if the server found any error.
				$fileError = $singleFile['error'];
				$message = '';

				if ($fileError > 0 && $fileError != 4)
				{
					switch ($fileError)
					{
						case 1:
							$message = Text::_('File size exceeds allowed by the server');
							break;
						case 2:
							$message = Text::_('File size exceeds allowed by the html form');
							break;
						case 3:
							$message = Text::_('Partial upload error');
							break;
					}

					if ($message != '')
					{
						$app->enqueueMessage($message, 'warning');

						return false;
					}
				}
				elseif ($fileError == 4)
				{
					if (isset($array['image7']))
					{
						$this->image7 = $array['image7'];
					}
				}
				else
				{

					// Check for filetype
					$okMIMETypes = 'image/png,image/jpeg';
					$validMIMEArray = explode(',', $okMIMETypes);
					$fileMime = $singleFile['type'];

					if (!in_array($fileMime, $validMIMEArray))
					{
						$app->enqueueMessage('This filetype is not allowed', 'warning');

						return false;
					}

					// Replace any special characters in the filename
					jimport('joomla.filesystem.file');
					$filename = File::stripExt($singleFile['name']);
					$extension = File::getExt($singleFile['name']);
					$filename = preg_replace("/[^A-Za-z0-9]/i", "-", $filename);
					$filename = $filename . '.' . $extension;
					$uploadPath = JPATH_ROOT . '/ugc/images/' . $filename;
					$fileTemp = $singleFile['tmp_name'];

					if (!File::exists($uploadPath))
					{
						if (!File::upload($fileTemp, $uploadPath))
						{
							$app->enqueueMessage('Error moving file', 'warning');

							return false;
						}
					}

					$this->image7 .= (!empty($this->image7)) ? "," : "";
					$this->image7 .= $filename;
				}
			}
		}
		else
		{
			$this->image7 .= $array['image7_hidden'];
		}
		// Support multi file field: image8
		$app = Factory::getApplication();
		$files = $app->input->files->get('jform', array(), 'raw');
		$array = $app->input->get('jform', array(), 'ARRAY');
		if (empty($files['image8'][0])){
			$temp = $files;
			$files = array();
			$files['image8'][] = $temp['image8'];
		}

		if ($files['image8'][0]['size'] > 0)
		{
			// Deleting existing files
			$oldFiles = Ugc_newHelper::getFiles($this->id, $this->_tbl, 'image8');

			foreach ($oldFiles as $f)
			{
				$oldFile = JPATH_ROOT . '/ugc/images/' . $f;

				if (file_exists($oldFile) && !is_dir($oldFile))
				{
					unlink($oldFile);
				}
			}

			$this->image8 = "";

			foreach ($files['image8'] as $singleFile )
			{
				jimport('joomla.filesystem.file');

				// Check if the server found any error.
				$fileError = $singleFile['error'];
				$message = '';

				if ($fileError > 0 && $fileError != 4)
				{
					switch ($fileError)
					{
						case 1:
							$message = Text::_('File size exceeds allowed by the server');
							break;
						case 2:
							$message = Text::_('File size exceeds allowed by the html form');
							break;
						case 3:
							$message = Text::_('Partial upload error');
							break;
					}

					if ($message != '')
					{
						$app->enqueueMessage($message, 'warning');

						return false;
					}
				}
				elseif ($fileError == 4)
				{
					if (isset($array['image8']))
					{
						$this->image8 = $array['image8'];
					}
				}
				else
				{

					// Check for filetype
					$okMIMETypes = 'image/png,image/jpeg';
					$validMIMEArray = explode(',', $okMIMETypes);
					$fileMime = $singleFile['type'];

					if (!in_array($fileMime, $validMIMEArray))
					{
						$app->enqueueMessage('This filetype is not allowed', 'warning');

						return false;
					}

					// Replace any special characters in the filename
					jimport('joomla.filesystem.file');
					$filename = File::stripExt($singleFile['name']);
					$extension = File::getExt($singleFile['name']);
					$filename = preg_replace("/[^A-Za-z0-9]/i", "-", $filename);
					$filename = $filename . '.' . $extension;
					$uploadPath = JPATH_ROOT . '/ugc/images/' . $filename;
					$fileTemp = $singleFile['tmp_name'];

					if (!File::exists($uploadPath))
					{
						if (!File::upload($fileTemp, $uploadPath))
						{
							$app->enqueueMessage('Error moving file', 'warning');

							return false;
						}
					}

					$this->image8 .= (!empty($this->image8)) ? "," : "";
					$this->image8 .= $filename;
				}
			}
		}
		else
		{
			$this->image8 .= $array['image8_hidden'];
		}
		// Support multi file field: image9
		$app = Factory::getApplication();
		$files = $app->input->files->get('jform', array(), 'raw');
		$array = $app->input->get('jform', array(), 'ARRAY');
		if (empty($files['image9'][0])){
			$temp = $files;
			$files = array();
			$files['image9'][] = $temp['image9'];
		}

		if ($files['image9'][0]['size'] > 0)
		{
			// Deleting existing files
			$oldFiles = Ugc_newHelper::getFiles($this->id, $this->_tbl, 'image9');

			foreach ($oldFiles as $f)
			{
				$oldFile = JPATH_ROOT . '/ugc/images/' . $f;

				if (file_exists($oldFile) && !is_dir($oldFile))
				{
					unlink($oldFile);
				}
			}

			$this->image9 = "";

			foreach ($files['image9'] as $singleFile )
			{
				jimport('joomla.filesystem.file');

				// Check if the server found any error.
				$fileError = $singleFile['error'];
				$message = '';

				if ($fileError > 0 && $fileError != 4)
				{
					switch ($fileError)
					{
						case 1:
							$message = Text::_('File size exceeds allowed by the server');
							break;
						case 2:
							$message = Text::_('File size exceeds allowed by the html form');
							break;
						case 3:
							$message = Text::_('Partial upload error');
							break;
					}

					if ($message != '')
					{
						$app->enqueueMessage($message, 'warning');

						return false;
					}
				}
				elseif ($fileError == 4)
				{
					if (isset($array['image9']))
					{
						$this->image9 = $array['image9'];
					}
				}
				else
				{

					// Check for filetype
					$okMIMETypes = 'image/png,image/jpeg';
					$validMIMEArray = explode(',', $okMIMETypes);
					$fileMime = $singleFile['type'];

					if (!in_array($fileMime, $validMIMEArray))
					{
						$app->enqueueMessage('This filetype is not allowed', 'warning');

						return false;
					}

					// Replace any special characters in the filename
					jimport('joomla.filesystem.file');
					$filename = File::stripExt($singleFile['name']);
					$extension = File::getExt($singleFile['name']);
					$filename = preg_replace("/[^A-Za-z0-9]/i", "-", $filename);
					$filename = $filename . '.' . $extension;
					$uploadPath = JPATH_ROOT . '/ugc/images/' . $filename;
					$fileTemp = $singleFile['tmp_name'];

					if (!File::exists($uploadPath))
					{
						if (!File::upload($fileTemp, $uploadPath))
						{
							$app->enqueueMessage('Error moving file', 'warning');

							return false;
						}
					}

					$this->image9 .= (!empty($this->image9)) ? "," : "";
					$this->image9 .= $filename;
				}
			}
		}
		else
		{
			$this->image9 .= $array['image9_hidden'];
		}
		// Support multi file field: image10
		$app = Factory::getApplication();
		$files = $app->input->files->get('jform', array(), 'raw');
		$array = $app->input->get('jform', array(), 'ARRAY');
		if (empty($files['image10'][0])){
			$temp = $files;
			$files = array();
			$files['image10'][] = $temp['image10'];
		}

		if ($files['image10'][0]['size'] > 0)
		{
			// Deleting existing files
			$oldFiles = Ugc_newHelper::getFiles($this->id, $this->_tbl, 'image10');

			foreach ($oldFiles as $f)
			{
				$oldFile = JPATH_ROOT . '/ugc/images/' . $f;

				if (file_exists($oldFile) && !is_dir($oldFile))
				{
					unlink($oldFile);
				}
			}

			$this->image10 = "";

			foreach ($files['image10'] as $singleFile )
			{
				jimport('joomla.filesystem.file');

				// Check if the server found any error.
				$fileError = $singleFile['error'];
				$message = '';

				if ($fileError > 0 && $fileError != 4)
				{
					switch ($fileError)
					{
						case 1:
							$message = Text::_('File size exceeds allowed by the server');
							break;
						case 2:
							$message = Text::_('File size exceeds allowed by the html form');
							break;
						case 3:
							$message = Text::_('Partial upload error');
							break;
					}

					if ($message != '')
					{
						$app->enqueueMessage($message, 'warning');

						return false;
					}
				}
				elseif ($fileError == 4)
				{
					if (isset($array['image10']))
					{
						$this->image10 = $array['image10'];
					}
				}
				else
				{

					// Check for filetype
					$okMIMETypes = 'image/png,image/jpeg';
					$validMIMEArray = explode(',', $okMIMETypes);
					$fileMime = $singleFile['type'];

					if (!in_array($fileMime, $validMIMEArray))
					{
						$app->enqueueMessage('This filetype is not allowed', 'warning');

						return false;
					}

					// Replace any special characters in the filename
					jimport('joomla.filesystem.file');
					$filename = File::stripExt($singleFile['name']);
					$extension = File::getExt($singleFile['name']);
					$filename = preg_replace("/[^A-Za-z0-9]/i", "-", $filename);
					$filename = $filename . '.' . $extension;
					$uploadPath = JPATH_ROOT . '/ugc/images/' . $filename;
					$fileTemp = $singleFile['tmp_name'];

					if (!File::exists($uploadPath))
					{
						if (!File::upload($fileTemp, $uploadPath))
						{
							$app->enqueueMessage('Error moving file', 'warning');

							return false;
						}
					}

					$this->image10 .= (!empty($this->image10)) ? "," : "";
					$this->image10 .= $filename;
				}
			}
		}
		else
		{
			$this->image10 .= $array['image10_hidden'];
		}

		return parent::check();
	}

	/**
	 * Define a namespaced asset name for inclusion in the #__assets table
	 *
	 * @return string The asset name
	 *
	 * @see Table::_getAssetName
	 */
	protected function _getAssetName()
	{
		$k = $this->_tbl_key;

		return $this->typeAlias . '.' . (int) $this->$k;
	}

	/**
	 * Returns the parent asset's id. If you have a tree structure, retrieve the parent's id using the external key field
	 *
	 * @param   Table   $table  Table name
	 * @param   integer  $id     Id
	 *
	 * @see Table::_getAssetParentId
	 *
	 * @return mixed The id on success, false on failure.
	 */
	protected function _getAssetParentId($table = null, $id = null)
	{
		// We will retrieve the parent-asset from the Asset-table
		$assetParent = Table::getInstance('Asset');

		// Default: if no asset-parent can be found we take the global asset
		$assetParentId = $assetParent->getRootId();

		// The item has the component as asset-parent
		$assetParent->loadByName('com_ugc_new');

		// Return the found asset-parent-id
		if ($assetParent->id)
		{
			$assetParentId = $assetParent->id;
		}

		return $assetParentId;
	}

	//XXX_CUSTOM_TABLE_FUNCTION

	
    /**
     * Delete a record by id
     *
     * @param   mixed  $pk  Primary key value to delete. Optional
     *
     * @return bool
     */
    public function delete($pk = null)
    {
        $this->load($pk);
        $result = parent::delete($pk);
        
		if ($result)
		{
			jimport('joomla.filesystem.file');

			$checkImageVariableType = gettype($this->image1);

			switch ($checkImageVariableType)
			{
			case 'string':
				File::delete(JPATH_ROOT . '/ugc/images/' . $this->image1);
			break;
			default:
			foreach ($this->image1 as $image1File)
			{
				File::delete(JPATH_ROOT . '/ugc/images/' . $image1File);
			}
			}
			jimport('joomla.filesystem.file');

			$checkImageVariableType = gettype($this->image2);

			switch ($checkImageVariableType)
			{
			case 'string':
				File::delete(JPATH_ROOT . '/ugc/images/' . $this->image2);
			break;
			default:
			foreach ($this->image2 as $image2File)
			{
				File::delete(JPATH_ROOT . '/ugc/images/' . $image2File);
			}
			}
			jimport('joomla.filesystem.file');

			$checkImageVariableType = gettype($this->image3);

			switch ($checkImageVariableType)
			{
			case 'string':
				File::delete(JPATH_ROOT . '/ugc/images/' . $this->image3);
			break;
			default:
			foreach ($this->image3 as $image3File)
			{
				File::delete(JPATH_ROOT . '/ugc/images/' . $image3File);
			}
			}
			jimport('joomla.filesystem.file');

			$checkImageVariableType = gettype($this->image4);

			switch ($checkImageVariableType)
			{
			case 'string':
				File::delete(JPATH_ROOT . '/ugc/images/' . $this->image4);
			break;
			default:
			foreach ($this->image4 as $image4File)
			{
				File::delete(JPATH_ROOT . '/ugc/images/' . $image4File);
			}
			}
			jimport('joomla.filesystem.file');

			$checkImageVariableType = gettype($this->image5);

			switch ($checkImageVariableType)
			{
			case 'string':
				File::delete(JPATH_ROOT . '/ugc/images/' . $this->image5);
			break;
			default:
			foreach ($this->image5 as $image5File)
			{
				File::delete(JPATH_ROOT . '/ugc/images/' . $image5File);
			}
			}
			jimport('joomla.filesystem.file');

			$checkImageVariableType = gettype($this->image6);

			switch ($checkImageVariableType)
			{
			case 'string':
				File::delete(JPATH_ROOT . '/ugc/images/' . $this->image6);
			break;
			default:
			foreach ($this->image6 as $image6File)
			{
				File::delete(JPATH_ROOT . '/ugc/images/' . $image6File);
			}
			}
			jimport('joomla.filesystem.file');

			$checkImageVariableType = gettype($this->image7);

			switch ($checkImageVariableType)
			{
			case 'string':
				File::delete(JPATH_ROOT . '/ugc/images/' . $this->image7);
			break;
			default:
			foreach ($this->image7 as $image7File)
			{
				File::delete(JPATH_ROOT . '/ugc/images/' . $image7File);
			}
			}
			jimport('joomla.filesystem.file');

			$checkImageVariableType = gettype($this->image8);

			switch ($checkImageVariableType)
			{
			case 'string':
				File::delete(JPATH_ROOT . '/ugc/images/' . $this->image8);
			break;
			default:
			foreach ($this->image8 as $image8File)
			{
				File::delete(JPATH_ROOT . '/ugc/images/' . $image8File);
			}
			}
			jimport('joomla.filesystem.file');

			$checkImageVariableType = gettype($this->image9);

			switch ($checkImageVariableType)
			{
			case 'string':
				File::delete(JPATH_ROOT . '/ugc/images/' . $this->image9);
			break;
			default:
			foreach ($this->image9 as $image9File)
			{
				File::delete(JPATH_ROOT . '/ugc/images/' . $image9File);
			}
			}
			jimport('joomla.filesystem.file');

			$checkImageVariableType = gettype($this->image10);

			switch ($checkImageVariableType)
			{
			case 'string':
				File::delete(JPATH_ROOT . '/ugc/images/' . $this->image10);
			break;
			default:
			foreach ($this->image10 as $image10File)
			{
				File::delete(JPATH_ROOT . '/ugc/images/' . $image10File);
			}
			}
		}

        return $result;
    }
}
