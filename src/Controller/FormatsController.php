<?php

namespace App\Controller;

use Cake\Event\Event;

class FormatsController extends AppController
{
	public function beforeFilter(Event $event)
	{
		parent::beforeFilter($event);
	}
	
	public function index()
	{
		$format = $this->Paginator->paginate($this->Formats->find()->contain(['Users']));
		$this->set(compact('format'));
	}
	
	/**
	 * @return \Cake\Http\Response|null
	 */
	public function add()
	{
		$formFormat = $this->Formats->newEntity();
		
		if (!$this->request->is('post')) {
			$this->set(compact('formFormat'));
			
			return null;
		}
		
		$formFormat = $this->Formats->patchEntity($formFormat, $this->request->getData());
		
		$formFormat->type = 1;
		$formFormat->user_id = $this->Auth->user('id');
		
		if ($this->Formats->save($formFormat)) {
			$this->Flash->success(__('Your form format has been saved.'));
			return $this->redirect(['action' => 'index']);
		}
		
		$this->Flash->error(__('Unable to add your form format.'));
		
		$this->set(compact('formFormat'));
	}
	
	/**
	 * @param $id
	 * @return \Cake\Http\Response|null
	 */
	public function edit($id)
	{
		$formFormat = $this->Formats->findById($id)->firstOrFail();
		
		if (!$this->request->is(['post', 'put'])) {
			$this->set(compact('formFormat'));
			
			return null;
		}
		
		$this->Formats->patchEntity($formFormat, $this->request->getData());
		
		if ($this->Formats->save($formFormat)) {
			$this->Flash->success(__('Your format has been updated.'));
			return $this->redirect(['action' => 'index']);
		}
		
		$this->Flash->error(__('Unable to update your format.'));
		
		$this->set(compact('formFormat'));
	}

	/**
	 * @param $id
	 * @return \Cake\Http\Response|null
	 */
	public function delete($id)
	{
		$format = $this->Formats->findById($id)->firstOrFail();

		if ($this->Formats->delete($format)) {
			$this->Flash->success(__('The {0} article has been deleted.', $format->name));
			return $this->redirect(['action' => 'index']);
		}
	}
}