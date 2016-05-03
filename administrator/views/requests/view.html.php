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

/**
 * View class for a list of Labgeneagrogene.
 */
class LabgeneagrogeneViewRequests extends JViewLegacy
{
    /**
     * List of update items.
     *
     * @var     array
     */
    protected $items;

    /**
     * List pagination.
     *
     * @var     JPagination
     */
    protected $pagination;

    /**
     * The model state.
     *
     * @var     JObject
     */
    protected $state;

    /**
     * Display the view
     */
    public function display($tpl = null)
    {
        try {
            $this->state = $this->get('State');
            $this->items = $this->get('Items');
            $this->pagination = $this->get('Pagination');
        } catch (Exception $e)  {
            JErrorPage::render($e);
            return false;
        }

        // Load the submenu.
        LabgeneagrogeneHelper::addSubmenu('requests');

        $this->addToolbar();
        $this->sidebar = JHtmlSidebar::render();

        parent::display($tpl);
    }

    /**
     * Add the page title and toolbar.
     *
     * @since	1.6
     */
    protected function addToolbar()
    {
        // Initialise variables.
        $state = $this->get('State');
        $canDo = LabgeneagrogeneHelper::getActions();

        JToolBarHelper::title(JText::_('COM_LABGENEAGROGENE_REQUESTS'), 'file-2');

        if ($canDo->get('core.create'))
        {
            JToolbarHelper::addNew('request.add');
        }

        if (($canDo->get('core.edit')) || ($canDo->get('core.edit.own')))
        {
            JToolbarHelper::editList('request.edit');
        }

        if ($canDo->get('core.edit.state'))
        {
            JToolbarHelper::publish('request.publish', 'JTOOLBAR_PUBLISH', true);
            JToolbarHelper::unpublish('request.unpublish', 'JTOOLBAR_UNPUBLISH', true);
            JToolbarHelper::archiveList('request.archive');
            JToolbarHelper::checkin('request.checkin');
        }

        if ($canDo->get('core.delete'))
        {
            JToolbarHelper::deleteList('', 'request.delete', 'JTOOLBAR_EMPTY_TRASH');
        }
        elseif ($canDo->get('core.edit.state'))
        {
            JToolbarHelper::trash('request.trash');
        }

        //Show trash and delete for components that uses the state field
        if (isset($this->items[0]->state)) {
            if ($state->get('filter.state') == -2 && $canDo->get('core.delete')) {
                JToolBarHelper::deleteList('', 'request.delete', 'JTOOLBAR_EMPTY_TRASH');
                JToolBarHelper::divider();
            } else if ($canDo->get('core.edit.state')) {
                JToolBarHelper::trash('request.trash', 'JTOOLBAR_TRASH');
                JToolBarHelper::divider();
            }
        }

        if ($canDo->get('core.admin')) {
            JToolBarHelper::preferences('com_labgeneagrogene');
        }

        //Set sidebar action - New in 3.0
        JHtmlSidebar::setAction('index.php?option=com_labgeneagrogene&view=constitution');

        $this->extra_sidebar = '';

        JFormHelper::addFieldPath(JPATH_COMPONENT . '/models/fields');
    }

    /**
     * Method to order fields
     *
     * @return array
     */
    protected function getSortFields()
    {
        return array(
            'a.`id`' => JText::_('JGRID_HEADING_ID'),
            'a.`ordering`' => JText::_('JGRID_HEADING_ORDERING'),
            'a.`state`' => JText::_('JSTATUS'),
        );
    }
}

