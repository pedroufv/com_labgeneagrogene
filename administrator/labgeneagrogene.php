<?php
/**
 * @version     1.0.0
 * @package     com_labgeneagrogene
 * @copyright   Copyright (C) LabGene 2015. Todos os direitos reservados.
 * @license     GNU General Public License versão 2 ou posterior; consulte o arquivo License. txt
 * @author      Pedro Augusto <pams.pedro@gmail.com> - http://ther.com.br/
 */

// no direct access
defined('_JEXEC') or die;

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_labgeneagrogene')) {
	throw new Exception(JText::_('JERROR_ALERTNOAUTHOR'));
}

// Register dependent classes.
JLoader::register('LabgeneagrogeneHelper', __DIR__ . '/helpers/labgeneagrogene.php');

$controller	= JControllerLegacy::getInstance('Labgeneagrogene');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
