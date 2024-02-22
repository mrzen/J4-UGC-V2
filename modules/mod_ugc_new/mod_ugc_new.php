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

use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ModuleHelper;
use Ugc\Module\Ugc_new\Site\Helper\Ugc_newHelper;

$wa = Factory::getApplication()->getDocument()->getWebAssetManager();
$wr = $wa->getRegistry();
$wr->addRegistryFile('media/mod_ugc_new/joomla.asset.json');
$wa->useStyle('mod_ugc_new.style')
    ->useScript('mod_ugc_new.script');

require ModuleHelper::getLayoutPath('mod_ugc_new', $params->get('content_type', 'blank'));
