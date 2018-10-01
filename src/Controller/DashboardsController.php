<?php
namespace App\Controller;

use Cake\Event\Event;

class DashboardsController extends AppController
{
	private $tableReport;
	
	public function beforeFilter(Event $event)
	{
		parent::beforeFilter($event);
		$this->tableReport = $this->getTableLocatorName('Reports');
	}
	
	/**
	 * This index action load dashboard content
	 */
	public function index()
	{
		$roleName = $this->getInfoUser('role')['name'];
		$menus = $this->Dashboard->getMenuList(
			$this->getInfoUser('id'), $roleName
		);
		
		$reports = $this->Paginator->paginate(
			$this->tableReport->getReportForDashboard($this->getInfoUser())
		);
		
		$this->set(compact('menus', 'reports', 'roleName', 'messageNumbers'));
	}
	
	/**
	 * Use ajax load menu content
	 *
	 * @param $typeReport
	 */
	public function get($typeReport)
	{
		$this->viewBuilder()->enableAutoLayout(false);
		
		$reports = $this->tableReport->getReportForDashboard(
			$this->getInfoUser(), ['load-type' => $typeReport]
		);
		$reports = $this->Paginator->paginate($reports);
		
		$this->set(compact('reports'));
		$this->render('/Element/Dashboards/report');
	}
	
	/**
	 * Use ajax load menu content
	 *
	 * @param $keyWord
	 */
	public function search($keyWord = '')
	{
		$this->viewBuilder()->enableAutoLayout(false);
		
		$reports = $this->tableReport->getReportForDashboard(
			$this->getInfoUser(), ['search' => $keyWord]
		);
		$reports = $this->Paginator->paginate($reports);
		
		$this->set(compact('reports'));
		$this->render('/Element/Dashboards/report');
	}
	
	/**
	 * @param $id
	 * @return null
	 */
	public function read($id)
	{
		$this->autoRender = false;
		
		$reports = $this->tableReport->findById($id)->firstOrFail();
		
		if (!$this->request->is(['ajax'])) {
			return null;
		}
		
		$this->tableReport->patchEntity($reports, $this->request->getData());

		$this->tableReport->save($reports);
	}
	
}