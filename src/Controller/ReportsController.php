<?php
namespace App\Controller;

use Cake\Event\Event;

class ReportsController extends AppController
{
	public function beforeFilter(Event $event)
	{
		$this->getEventManager()->off($this->Csrf);
		parent::beforeFilter($event);
	}
	
	public function index()
	{
		$reports = $this->Reports->getReportFollowUser($this->getInfoUser());
		$reports = $this->Paginator->paginate($reports);
		
		$this->set(compact('reports'));
	}
	
	/**
	 * @return \Cake\Http\Response|null
	 */
	public function add()
	{
		$this->getListInfoForViewAction();
		
		$reports = $this->Reports->newEntity();
		$formats = $this->getTableLocatorName('Formats')->find();

		if (!$this->request->is('post')) {
			$this->set(compact('reports', 'formats'));
			return null;
		}
		
		if ($this->Reports->save($this->dataInsertDefault($reports))) {
			$this->Flash->success(__('Your form format has been saved.'));
			
			return $this->redirect(['action' => 'index']);
		}
		
		$this->Flash->error(__('Unable to add your form format.'));
		
		$this->set(compact('reports', 'formats'));
	}
	
	/**
	 * @param $id
	 * @return \Cake\Http\Response|null
	 */
	public function edit($id)
	{
		$this->getListInfoForViewAction();
		
		$reports = $this->Reports->findById($id)->firstOrFail();
		$formats = $this->getTableLocatorName('Formats')->find();
		
		if (!$this->request->is(['post', 'put'])) {
			$this->set(compact('reports', 'formats'));
			
			return null;
		}
		
		$reports->user_read = 0;
		$this->Reports->patchEntity($reports, $this->request->getData());
		
		if ($this->Reports->save($reports)) {
			$this->Flash->success(__('Your format has been updated.'));
			
			return $this->redirect(['action' => 'index']);
		}
		
		$this->Flash->error(__('Unable to update your format.'));
		
		$this->set(compact('reports', 'formats'));
	}
	
	/**
	 * Get info selectbox for report view actions
	 */
	private function getListInfoForViewAction()
	{
		$userProvinces = $this->getTableLocatorName('Users')->getUserList(
			[
				'Users.province_id' => $this->getInfoUserRelated('province', 'id'),
				'Users.id <>'   => $this->getInfoUser('id'),
				'Users.role_id' => 2
			]
		);
		
		$userDistricts = $this->getTableLocatorName('Users')->getUserList(
			[
				'Users.district_id' => $this->getInfoUserRelated('district', 'id'),
				'Users.id <>'   => $this->getInfoUser('id'),
				'Users.role_id' => 1
			]
		);
		
		$this->set(compact('userProvinces', 'userDistricts'));
		
	}
	
	/**
	 * @param $reports
	 * @return mixed
	 */
	private function dataInsertDefault($reports)
	{
		$reports = $this->Reports->patchEntity($reports, $this->request->getData());
		
		$reports->user_id = $this->Auth->user('id');
		$reports->ward_id = $this->Auth->user('ward_id');
		$reports->province_id = $this->Auth->user('province_id');
		$reports->district_id = $this->Auth->user('district_id');
		
		return $reports;
	}
	
	/**
	 * @param $id
	 */
	public function view($id)
	{
		$reports = $this->Reports->get($id);
		$formats = $this->getTableLocatorName('Formats')->find();
		
		$this->set(compact('reports', 'formats'));
	}
	
	/**
	 * @param $id
	 * @return \Cake\Http\Response|null
	 */
	public function delete($id)
	{
		$report = $this->Reports->findById($id)->firstOrFail();
		
		if ($this->Reports->delete($report)) {
			$this->Flash->success(__('The {0} article has been deleted.', $report->name));
			return $this->redirect(['action' => 'index']);
		}
	}
	
	/**
	 * @param $id
	 * @return \Cake\Http\Response
	 */
	public function get($id)
	{
		$this->autoRender = false;
		$format = $this->getTableLocatorName('Formats')->getInfoFormatWithId($id);
		
		return $this->getResponseJson($format);
	}
}