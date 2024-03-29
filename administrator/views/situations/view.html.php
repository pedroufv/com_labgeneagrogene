<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Labgeneagrogene
 * @author     Pedro Augusto <pams.pedro@gmail.com>
 * @copyright  Copyright (C) LabGene 2015. Todos os direitos reservados.
 * @license    GNU General Public License versão 2 ou posterior; consulte o arquivo License. txt
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

/**
 * View class for a list of Labgeneagrogene.
 *
 * @since  1.6
 */
class LabgeneagrogeneViewSituations extends JViewLegacy
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
		LabgeneagrogeneHelper::addSubmenu('situations');

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
        $state = $this->get('State');
        $canDo = LabgeneagrogeneHelper::getActions($state->get('filter.category_id'));

        JToolBarHelper::title(JText::_('COM_LABGENEAGROGENE_SITUATIONS'), 'tags');

        // Check if the form exists before showing the add/edit buttons
        $formPath = JPATH_COMPONENT_ADMINISTRATOR . '/views/situation';

        if (file_exists($formPath)) {
            if ($canDo->get('core.create')) {
                JToolBarHelper::addNew('situation.add', 'JTOOLBAR_NEW');
            }

            if ($canDo->get('core.edit') && isset($this->items[0])) {
                JToolBarHelper::editList('situation.edit', 'JTOOLBAR_EDIT');
            }
        }

        if ($canDo->get('core.edit.state'))
        {
            if (isset($this->items[0]->state)) {
                JToolBarHelper::divider();
                JToolBarHelper::custom('situations.publish', 'publish.png', 'publish_f2.png', 'JTOOLBAR_PUBLISH', true);
                JToolBarHelper::custom('situations.unpublish', 'unpublish.png', 'unpublish_f2.png', 'JTOOLBAR_UNPUBLISH', true);
            }
            elseif (isset($this->items[0])) {
                // If this component does not use state then show a direct delete button as we can not trash
                JToolBarHelper::deleteList('', 'situations.delete', 'JTOOLBAR_DELETE');
            }

            if (isset($this->items[0]->state)) {
                JToolBarHelper::divider();
                JToolBarHelper::archiveList('situations.archive', 'JTOOLBAR_ARCHIVE');
            }

            if (isset($this->items[0]->checked_out)) {
                JToolBarHelper::custom('situations.checkin', 'checkin.png', 'checkin_f2.png', 'JTOOLBAR_CHECKIN', true);
            }
        }

        // Show trash and delete for components that uses the state field
        if (isset($this->items[0]->state)) {
            if ($state->get('filter.state') == -2 && $canDo->get('core.delete'))  {
                JToolBarHelper::deleteList('', 'containers.delete', 'JTOOLBAR_EMPTY_TRASH');
                JToolBarHelper::divider();
            } elseif ($canDo->get('core.edit.state')) {
                JToolBarHelper::trash('containers.trash', 'JTOOLBAR_TRASH');
                JToolBarHelper::divider();
            }
        }

        if ($canDo->get('core.admin')) {
            JToolBarHelper::preferences('com_labgeneagrogene');
        }

        // Set sidebar action - New in 3.0
        JHtmlSidebar::setAction('index.php?option=com_labgeneagrogene&view=situations');

        JHtmlSidebar::addFilter(
            JText::_('JOPTION_SELECT_PUBLISHED'),
            'filter_published',
            JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), "value", "text", $this->state->get('filter.state'), true)
        );
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
			'a.`title`' => JText::_('COM_LABGENEAGROGENE_SITUATION'),
			'a.`description`' => JText::_('COM_LABGENEAGROGENE_DESCRIPTION'),
			'a.`ordering`' => JText::_('JGRID_HEADING_ORDERING'),
			'a.`state`' => JText::_('JSTATUS'),
		);
	}
}

