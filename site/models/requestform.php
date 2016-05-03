<?php
/**
 * @version     1.0.0
 * @package     com_labgeneagrogene
 * @copyright   Copyright (C) LabGene 2015. Todos os direitos reservados.
 * @license     GNU General Public License versão 2 ou posterior; consulte o arquivo License. txt
 * @author      Pedro Augusto <pams.pedro@gmail.com> - http://ther.com.br/
 */

// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.modelform');
jimport('joomla.event.dispatcher');

/**
 * Labgeneagrogene model.
 */
class LabgeneagrogeneModelRequestForm extends JModelForm
{
    var $_item = null;

    /**
     * Method to get an ojbect.
     *
     * @param    integer    The id of the object to get.
     *
     * @return    mixed    Object on success, false on failure.
     */
    public function &getData($id = null)
    {
        if ($this->_item === null) {

            $model = $this->getRelatedAdminModel('Request');

            $this->_item = $model->getItem($id);
        }

        return $this->_item;
    }

    /**
     * Method to get the record form.
     *
     * @param   array    $data      An optional array of data for the form to interogate.
     * @param   boolean  $loadData  True if the form is to load its own data (default case), false if not.
     *
     * @return  JForm  A JForm object on success, false on failure
     *
     * @since    1.6
     */
    public function getForm($data = array(), $loadData = true)
    {
        // Get the form.
        $form = $this->loadForm('com_labgeneagrogene.requestform', 'requestform', array(
            'control' => 'jform',
            'load_data' => $loadData
        ));


        if (empty($form)) {
            return false;
        }

        return $form;
    }

    /**
     * Method to get the data that should be injected in the form.
     *
     * @return    mixed    The data for the form.
     * @since    1.6
     */
    protected function loadFormData()
    {
        $data = JFactory::getApplication()->getUserState('com_labgeneagrogene.requests.data', array());

        if (empty($data)) {
            $id = JFactory::getApplication()->input->get('id');
            $data = $this->getData($id);
        }

        return $data;
    }

    /**
     * save data in table
     *
     * @param array $data
     * @return bool|void
     */
    public function save($data)
    {
	$data['state'] = 1;
        $table = $this->getTable('request', 'LabgeneagrogeneTable');
        if ($table->save($data) === true) {
            return $table->id;
        } else {
            return false;
        }
    }

    /**
     * Method to populate object with attributes related.
     *
     * @param   object.
     * @return  void
     */
    public function populateRelated(&$item)
    {
        /*
        if($item->animalsid) {
            $item->animals = $this->getRelatedAdminModel('Animal')->getItem($item->animalsid);
        }

        if($item->clinicsid) {
            $item->clinics = $this->getRelatedAdminModel('Clinic')->getItem($item->clinicsid);
        }

        if($item->id) {
            $item->containerslist = $this->getRelatedAdminModel('containerslist')->getContainersInRequest($item->id);
            $item->examslist = $this->getRelatedAdminModel('examslist')->getExamsInRequestByCategory($item->id);
            $item->totalexams = count($this->getRelatedAdminModel('examslist')->getExamsInRequest($item->id));
        }
        */
    }

    /**
     * get model related
     *
     * @param string $name
     * @return JModelLegacy
     */
    private function getRelatedAdminModel($name)
    {
        JModelLegacy::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR . '/models', 'LabgeneagrogeneModel');
        $model = JModelLegacy::getInstance($name,'LabgeneagrogeneModel');
        return $model;
    }
}
