<?php
/**
 * @version     1.0.0
 * @package     com_labgeneagrogene
 * @copyright   Copyright (C) LabGene 2015. Todos os direitos reservados.
 * @license     GNU General Public License versão 2 ou posterior; consulte o arquivo License. txt
 * @author      Pedro Augusto <pams.pedro@gmail.com> - http://ther.com.br/
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controller');

class LabgeneagrogeneController extends JControllerLegacy {

    /**
     * Method to display a view.
     *
     * @param	boolean			$cachable	If true, the view output will be cached
     * @param	array			$urlparams	An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
     *
     * @return	JController		This object to support chaining.
     * @since	1.5
     */
    public function display($cachable = false, $urlparams = false)
    {
        $view = JFactory::getApplication()->input->getCmd('view', 'requests');
        JFactory::getApplication()->input->set('view', $view);

        parent::display($cachable, $urlparams);

        return $this;
    }

    public function populateExams()
    {
        $inputArray = $this->input->post->getArray();
        JModelLegacy::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR . '/models', 'LabgeneagrogeneModel');
        $model = JModelLegacy::getInstance('Exams','LabgeneagrogeneModel');
        $exams = $model->getExamsInCategory($inputArray['category']);

        echo json_encode($exams);

        jexit();
    }
}
