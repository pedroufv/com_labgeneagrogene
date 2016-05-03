<?php
/**
 * @version     1.0.0
 * @package     com_labgeneagrogene
 * @copyright   Copyright (C) LabGene 2015. Todos os direitos reservados.
 * @license     GNU General Public License versão 2 ou posterior; consulte o arquivo License. txt
 * @author      Pedro Augusto <pams.pedro@gmail.com> - http://ther.com.br/
 */

defined('_JEXEC') or die;

// Include dependancies
jimport('joomla.application.component.controller');

JLoader::register('LabgeneagrogeneFrontendHelper', JPATH_COMPONENT . '/helpers/labgeneagrogene.php');

// Execute the task.
$controller = JControllerLegacy::getInstance('Labgeneagrogene');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
