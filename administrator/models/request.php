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
                'load_data' => true
            )
        );

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
		if(!is_null($item->id)) {		
			$id = $item->id;
			// Create a new query object.
			$db = $this->getDbo();
			$query = $db->getQuery(true);
			$query->select('`code_exam`.catid AS `catid`');
			$query->from('`#__labgeneagrogene_requests` AS a');
			$query->select('`code_exam`.title AS `code_exam`');
			$query->join('LEFT', '#__labgeneagrogene_exams AS `code_exam` ON `code_exam`.id = a.`code_exam`');
			$query->where("a.id = $item->id");
			$db->setQuery($query);

			$item->category_exams = $db->loadResult();
		}
        }

        return $item;
    }

    /**
     * save data in table and table related
     *
     * @param array $data
     * @return bool|void
     */
    public function save($data)
    {
        return parent::save($data);
    }
}
