<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Labgeneagrogene
 * @author     Pedro Augusto <pams.pedro@gmail.com>
 * @copyright  Copyright (C) LabGene 2015. Todos os direitos reservados.
 * @license    GNU General Public License versão 2 ou posterior; consulte o arquivo License. txt
 */

// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');
jimport('joomla.filesystem.file');

/**
 * Labgeneagrogene model.
 *
 * @since  1.6
 */
class LabgeneagrogeneModelRequest extends JModelAdmin
{
    /**
     * @var      string    The prefix to use with controller messages.
     * @since    1.6
     */
    protected $text_prefix = 'COM_LABGENEAGROGENE';

    /**
     * Returns a reference to the a Table object, always creating it.
     *
     * @param   string  $type    The table type to instantiate
     * @param   string  $prefix  A prefix for the table class name. Optional.
     * @param   array   $config  Configuration array for model. Optional.
     *
     * @return    JTable    A database object
     *
     * @since    1.6
     */
    public function getTable($type = 'Request', $prefix = 'LabgeneagrogeneTable', $config = array())
    {
        return JTable::getInstance($type, $prefix, $config);
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
        $form = $this->loadForm(
            'com_labgeneagrogene.request', 'request',
            array('control' => 'jform',
                'load_data' => false
            )
        );

        $examsCheckboxes = $this->getRelatedModel('Exams')->getXmlFieldCheckboxes();
        if($examsCheckboxes) {
            $form->setField($examsCheckboxes);
        }

        @$form->bind($this->loadFormData());

        if (empty($form)) {
            return false;
        }

        return $form;
    }

    /**
     * Method to get the data that should be injected in the form.
     *
     * @return   mixed  The data for the form.
     *
     * @since    1.6
     */
    protected function loadFormData()
    {
        // Check the session for previously entered form data.
        $data = JFactory::getApplication()->getUserState('com_labgeneagrogene.edit.request.data', array());

        if (empty($data)) {
            $data = $this->getItem();
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
     * @since    1.6
     */
    public function getItem($pk = null)
    {
        if ($item = parent::getItem($pk)) {
            $key = $this->getTable()->getKeyName();
            $pk = JFactory::getApplication()->input->getInt($key);
            if($pk) {
                $item->examslist = $this->getRelatedModel('examslist')->getExamsInRequestByCategory($pk);
            }
        }

        return $item;
    }


    /**
     * get model related
     *
     * @param string $name
     * @return JModelLegacy
     */
    private function getRelatedModel($name) {
        $model = JModelLegacy::getInstance($name,'LabgeneagrogeneModel');
        return $model;
    }

    /**
     * save data in table and table related
     *
     * @param array $data
     * @return bool|void
     */
    public function save($data)
    {
        $application = JFactory::getApplication();
        $input = JFactory::getApplication()->input;
        $inputArray = $input->post->getArray();
        $jformArray = $inputArray['jform'];

        $examsListCategory = $jformArray['examslist'];
        $examsList = array();
        foreach($examsListCategory as $category => $exams) {
            foreach($exams as $exam) {
                array_push($examsList, $exam);
            }
        }
        $this->getRelatedModel('Examslist')->save($data['id'], $examsList);

        return parent::save($data);
    }
}
