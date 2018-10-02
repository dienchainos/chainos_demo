<?php
namespace App\Controller;

use App\Model\Entity\Message;
use Cake\Event\Event;

class MessagesController extends AppController
{
	public function beforeFilter(Event $event)
	{
		parent::beforeFilter($event);
		$this->getEventManager()->off($this->Csrf);
	}
	
	public function index()
	{
		$threads  = $this->getDataThread();
		$threadId = isset($this->getDataThread()->first()->id) ? $this->getDataThread()->first()->id : '';
		$messages = $this->getDataMessages($threadId);
		
		$this->set(compact('messages', 'threads', 'threadId'));
	}
	
	/**
	 * @return array
	 */
	public function add()
	{
		if (!$this->request->is(['ajax'])) {
			return [];
		}
		
		$this->viewBuilder()->enableAutoLayout(false);
		
		$messages = $this->Messages->newEntity();
		$userSendId = $this->request->getData('user_send_id');
		$messages->type = $userSendId == $this->getInfoUser('id') ? Message::STATUS_SEND : Message::STATUS_REPLY;
		$messages->is_read = Message::STATUS_IS_NOT_READ;
		$messages->user_send_id = $this->getInfoUser('id');
		$messages = $this->Messages->patchEntity($messages, $this->request->getData());
		
		if ($this->Messages->save($messages)) {
			new \ErrorException();
		}

		$messages = $this->getListMessagePerThread($this->request->getData('thread_id'));
		
		$this->set(compact('messages'));
		$this->render('/Element/Messages/messages');
	}
	
	/**
	 * Load ajax list message and message thread
	 */
	public function get()
	{
		if (!$this->request->is(['ajax'])) {
			return [];
		}
		
		$this->viewBuilder()->enableAutoLayout(false);
		
		$threads  = $this->getDataThread();
		$messages = $this->getDataMessages($this->request->getData('thread_id'));
		$threadId = empty($this->request->getData('thread_id'))
			? isset( $this->getDataThread()->first()->id) ?  $this->getDataThread()->first()->id : ''
			: $this->request->getData('thread_id');
		
		$this->set(compact('messages', 'threads', 'threadId'));
		$this->render('/Element/Messages/view');
	}
	
	/**
	 * Search thread
	 * @return array
	 */
	public function search()
	{
		if (!$this->request->is(['ajax'])) {
			return [];
		}
	
		$this->viewBuilder()->enableAutoLayout(false);
		$threads  = $this->getDataThread()->where(['name LIKE ' => $this->request->getData('search') . '%']);
		
		$this->set(compact('messages', 'threads', 'threadId'));
		$this->render('/Element/Messages/threads');
	}
	
	/**
	 * @return array
	 */
	public function updateMsgRead()
	{
		if (!$this->request->is(['ajax'])) {
			return [];
		}
		
		$this->autoRender = false;

		$this->Messages->query()
			->update()
			->set(['is_read' => Message::STATUS_IS_READ])
			->where([
				'Messages.type <>'      => $this->request->getData('user_screen'),
				'Messages.thread_id' => $this->request->getData('thread_id')
			])
			->execute();
	}
	
	/**
	 * @param $threadId
	 * @return array
	 */
	public function getMessage($threadId)
	{
		if (!$this->request->is(['ajax'])) {
			return [];
		}
		
		$this->viewBuilder()->enableAutoLayout(false);
		$messages = $this->getListMessagePerThread($threadId);
		
		$this->set(compact('messages'));
		$this->render('/Element/Messages/messages');
	}
	
	/**
	 * @param $threadId
	 * @return mixed
	 */
	private function getListMessagePerThread($threadId)
	{
		$messages = $this->Messages->geLastMsgThreadPerUser(
			$this->getInfoUser('id'),
			$threadId
		);
		
		return $messages;
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
	
	/**
	 * @return mixed
	 */
	private function getDataThread()
	{
		return $this->getTableLocatorName('Threads')
			->getMessagesPerThread($this->getInfoUser('id'));
		
	}
	
	/**
	 * @param $threadId
	 * @return mixed
	 */
	private function getDataMessages($threadId)
	{
		return empty($threadId)
			? $this->Messages->newEntity()
			: $this->getListMessagePerThread($threadId);
	}
	
	
}