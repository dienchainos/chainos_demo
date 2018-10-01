<?php
namespace App\Controller;

use Cake\Event\Event;

class RolesController extends AppController
{
	public function beforeFilter(Event $event)
	{
		parent::beforeFilter($event);
		$this->getEventManager()->off($this->Csrf);
	}
	
	public function index()
	{
		$roles = $this->Roles->find();
		$roles = $this->Paginator->paginate($roles);
	
		$this->set(compact('roles'));
	}
	
	/**
	 * @return \Cake\Http\Response|null
	 */
	public function add()
	{
		$roles = $this->Roles->newEntity();
		
		if (!$this->request->is('post')) {
			$this->set(compact('roles'));
			return null;
		}
		
		$roles = $this->Roles->patchEntity($roles, $this->request->getData());
		
		$roles->type = 1;
		$roles->user_id = $this->Auth->user('id');
		
		if ($this->Roles->save($roles)) {
			$this->Flash->success(__('Your role has been saved.'));
			
			return $this->redirect(['action' => 'index']);
		}
		
		$this->Flash->error(__('Unable to add your role.'));
		
		$this->set(compact('roles'));
	}
	
	/**
	 * @param $id
	 * @return \Cake\Http\Response|null
	 */
	public function edit($id)
	{
		$roles = $this->Roles->findById($id)->firstOrFail();
		
		if (!$this->request->is(['post', 'put'])) {
			$this->set(compact('roles'));
			
			return null;
		}
		
		$this->Roles->patchEntity($roles, $this->request->getData());
		
		if ($this->Roles->save($roles)) {
			$this->Flash->success(__('Your role has been updated.'));
			
			return $this->redirect(['action' => 'index']);
		}
		
		$this->Flash->error(__('Unable to update your role.'));
		
		$this->set(compact('roles'));
	}
	
	/**
	 * @param $id
	 */
	public function view($id)
	{
		$roles = $this->Roles->get($id);

		$this->set(compact('roles'));
	}
	
	/**
	 * @param $id
	 * @return \Cake\Http\Response|null
	 */
	public function delete($id)
	{
		$role = $this->Roles->findById($id)->firstOrFail();
		
		if ($this->Roles->delete($role)) {
			$this->Flash->success(__('The {0} article has been deleted.', $role->name));
			return $this->redirect(['action' => 'index']);
		}
	}
	
}