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

/**
 * Methods supporting a list of Labgeneagrogene records.
 *
 * @since  1.6
 */
class LabgeneagrogeneModelRequests extends JModelList
{
	/**
	 * Constructor.
	 *
	 * @param    array    An optional associative array of configuration settings.
	 * @see      JController
	 * @since    1.6
	 */
	public function __construct($config = array())
    {
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
					'id', 'a.`id`',
					'situetionsid', 'a.`situationsid`',
					'ordering', 'a.`ordering`',
					'state', 'a.`state`',
					'created_by', 'a.`created_by`',
			);
		}

		parent::__construct($config);
	}

	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		// Initialise variables.
		$app = JFactory::getApplication('administrator');

		// Load the filter state.
		$search = $app->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		$published = $app->getUserStateFromRequest($this->context . '.filter.state', 'filter_published', '', 'string');
		$this->setState('filter.state', $published);

		$this->setState('filter.situationsid', $app->getUserStateFromRequest($this->context.'.filter.situationsid', 'filter_situationsid', '', 'string'));

		// Load the parameters.
		$params = JComponentHelper::getParams('com_labgeneagrogene');
		$this->setState('params', $params);

		// List state information.
		parent::populateState('a.id', 'asc');
	}

	/**
	 * Method to get a store id based on model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param	string		$id	A prefix for the store id.
	 * @return	string		A store id.
	 * @since	1.6
	 */
	protected function getStoreId($id = '')
    {
		// Compile the store id.
		$id.= ':' . $this->getState('filter.search');
		$id.= ':' . $this->getState('filter.state');
		$id.= ':' . $this->getState('filter.situationsid');

		return parent::getStoreId($id);
	}

	/**
	 * Build an SQL query to load the list data.
	 *
	 * @return	JDatabaseQuery
	 * @since	1.6
	 */
	protected function getListQuery() {
		// Create a new query object.
		$db = $this->getDbo();
		$query = $db->getQuery(true);

		// Select the required fields from the table.
		$query->select($this->getState('list.select', 'DISTINCT a.*'));
		$query->from('`#__labgeneagrogene_requests` AS a');

		// Join over the 'constitution'
		$query->select('`constitution`.title AS `constitution`');
		$query->join('LEFT', '#__labgeneagrogene_constitutions AS `constitution` ON `constitution`.id = a.`constitution`');
		// Join over the 'situationsid'
		$query->select('`situationsid`.title AS `situationsid`');
		$query->join('LEFT', '#__labgeneagrogene_situations AS `situationsid` ON `situationsid`.id = a.`situationsid`');
		// Join over the users for the checked out user
		$query->select("uc.name AS editor");
		$query->join("LEFT", "#__users AS uc ON uc.id=a.checked_out");
		// Join over the user field 'created_by'
		$query->select('`created_by`.name AS `created_by`');
		$query->join('LEFT', '#__users AS `created_by` ON `created_by`.id = a.`created_by`');

		// Filter by published state
		$published = $this->getState('filter.state');
		if (is_numeric($published)) {
			$query->where('a.state = ' . (int) $published);
		} else if ($published === '') {
			$query->where('(a.state IN (0, 1))');
		}

		$filter_situationsid = $this->state->get("filter.situationsid");
		if ($filter_situationsid) {
			$query->where("a.`situationsid` = '".$db->escape($filter_situationsid)."'");
		}

		// Filter by search in title
		$search = $this->getState('filter.search');
		if (!empty($search)) {
			if (stripos($search, 'id:') === 0) {
				$query->where('a.id = ' . (int) substr($search, 3));
			} else {
				$search = $db->Quote('%' . $db->escape($search, true) . '%');
				$query->where('( a.`product` LIKE '.$search.'  OR  a.`date_reception` LIKE '.$search.' OR `situationsid`.title LIKE '.$search.' OR `constitution`.title LIKE '.$search.' )');
			}
		}

		// Add the list ordering clause.
		$orderCol = $this->state->get('list.ordering');
		$orderDirn = $this->state->get('list.direction');
		if ($orderCol && $orderDirn) {
			$query->order($db->escape($orderCol . ' ' . $orderDirn));
		}

		return $query;
	}

	/**
	 * Method to get a list of requests.
	 *
	 * @return  mixed  An array of data items on success, false on failure.
	 *
	 * @since   3.2
	 */
	public function getItems() {
		$items = parent::getItems();

		return $items;
	}
}
