<?php
namespace App\Controller;

use App\Model\Entity\Thread;
use Cake\Event\Event;

class ThreadsController extends AppController
{
	public function beforeFilter(Event $event)
	{
		parent::beforeFilter($event);
		$this->getEventManager()->off($this->Csrf);
	}
	
	public function index()
	{
		$threads = $this->Threads->find();
		$threads = $this->Paginator->paginate($threads);
	
		$this->set(compact('threads'));
	}
	
	/**
	 * @return \Cake\Http\Response|null
	 */
	public function add()
	{
		$this->setUserManage();
		$threads = $this->Threads->newEntity();
		
		if (!$this->request->is('post')) {
			$this->set(compact('threads'));
			return null;
		}
		
		$threads = $this->Threads->patchEntity($threads, $this->request->getData());
		$threads->status = Thread::STATUS_OPEN;
		$threads->user_send_id = $this->getInfoUser('id');
		
		if ($result = $this->Threads->save($threads)) {
			$this->saveFirstMessage($result->id);
			
			$this->Flash->success(__('Your thread has been saved.'));
			
			return $this->redirect(['action' => 'index']);
		}
		
		$this->Flash->error(__('Unable to add your thread.'));
		
		$this->set(compact('threads'));
	}
	
	
	/**
	 * @param $id
	 * @return \Cake\Http\Response|null
	 */
	public function edit($id)
	{
		$this->setUserManage();
		
		$threads = $this->Threads->findById($id)->firstOrFail();
		
		if (!$this->request->is(['post', 'put'])) {
			$this->set(compact('threads'));
			
			return null;
		}
		
		$threads->user_send_id = $this->getInfoUser('id');
		$this->Threads->patchEntity($threads, $this->request->getData());
		
		if ($this->Threads->save($threads)) {
			$entityMessage = $this->getTableLocatorName('Messages')->findByThreadId($id)->first();
			$this->saveFirstMessage($id, $entityMessage);
			
			$this->Flash->success(__('Your thread has been updated.'));
			
			return $this->redirect(['action' => 'index']);
		}
		
		$this->Flash->error(__('Unable to update your thread.'));
		
		$this->set(compact('threads'));
	}
	
	/**
	 * @param $threadId
	 * @param null $entityMessage
	 */
	protected function saveFirstMessage($threadId, $entityMessage = null)
	{
		$messages = [
			'user_send_id'  => $this->getInfoUser('id'),
			'user_reply_id' => $this->request->getData('user_reply_id'),
			'message'       => $this->request->getData('name'),
			'thread_id'     => $threadId,
		];
		$this->getTableLocatorName('Messages')->saveMessages($messages, $entityMessage);
	}
	
	/**
	 * Get list user manage
	 */
	protected function setUserManage()
	{
		$userManages = $this->getTableLocatorName('Users')
						    ->findByManageId($this->getInfoUser('id'));
		
		$this->set(compact('userManages'));
	}
	
	/**
	 * @param $id
	 */
	public function view($id)
	{
		$threads = $this->Threads->get($id);

		$this->set(compact('threads'));
	}
	
	/**
	 * @param $id
	 * @return \Cake\Http\Response|null
	 */
	public function delete($id)
	{
		$thread = $this->Threads->findById($id)->firstOrFail();
		
		if ($this->Threads->delete($thread)) {
			$this->Flash->success(__('The {0} article has been deleted.', $thread->name));
			return $this->redirect(['action' => 'index']);
		}
	}
	
}