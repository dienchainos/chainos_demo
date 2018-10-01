<?php

namespace App\Controller;

use Cake\Event\Event;

class UsersController extends AppController
{
	public function beforeFilter(Event $event)
	{
		parent::beforeFilter($event);
	}
	
	public function index()
	{
		$users = $this->Paginator->paginate($this->Users->getUserList());
		
		$this->set(compact('users'));
	}
	
	/**
	 * @param $id
	 */
	public function view()
	{
		$users = $this->Users->getUserList(
			['Users.id' => $this->getInfoUser('id')]
		)->first();
		
		$this->set(compact('users'));
	}
	
	/**
	 * @param null $id
	 * @return \Cake\ORM\Query
	 */
	public function getProvincesList($id = null)
	{
		$result = $this->getTableLocatorName('Provinces')->find();
		
		if (!empty($id)) {
			$result = $result->where(['Provinces.id' => $id]);
		}
		
		return $result;
	}
	
	/**
	 * @param $provinceId
	 * @return mixed
	 */
	public function getDistrictsList($provinceId = null)
	{
		$districts = $this->getTableLocatorName('Districts')->find();
		
		if (!empty($districtId)) {
			$districts = $districts->where(['province_id' => $provinceId]);
		}
		
		return $districts;
	}
	
	/**
	 * @param $districtId
	 * @return mixed
	 */
	public function getWardsList($districtId = null)
	{
		$wards = $this->getTableLocatorName('Wards')->find();
		
		if (!empty($districtId)) {
			$wards = $wards->where(['district_id' => $districtId]);
		}
		
		return $wards;
	}
	
	/**
	 * @return \Cake\Http\Response|null
	 */
	public function add()
	{
		$this->setDataForUserAction();
		
		$users      = $this->Users->newEntity();
		$password   = $this->request->getData('password');
		$rePassword = $this->request->getData('re-password');
		
		if ($rePassword !== $password) {
			$this->set(compact('users', 'districts', 'provinces', 'wards', 'roles'));
			$this->Flash->error(__('Unable to add the user'));
			
			return null;
		}
		
		if (!$this->request->is('post')) {
			$this->set(compact('users', 'districts', 'provinces', 'wards', 'roles'));
			return null;
		}
		
		$user = $this->Users->patchEntity($users, $this->request->getData());
		
		if ($this->Users->save($user)) {
			$this->senMailForUser($users);
			$this->Flash->success(__('The user has been saved.'));
			
			return $this->redirect(['action' => 'index']);
		}
		
		$this->Flash->error(__('Unable to add the user.'));
		
		$this->set(compact('users'));
	}
	
	/**
	 * @param $users
	 */
	protected function senMailForUser($users)
	{
		$message  = 'Info user from <a href="http://chainos.demo/">chainos.demo</a> </br>';
		$message .= '<strong>UserName: </strong>'.$users->username.' </br>';
		$message .= '<strong>Email: </strong>'.$users->email.' </br>';
		$message .= '<strong>Password: </strong>'. $this->request->getData('password') .' </br>';
		
		$resposeSend = $this->AppMail->setOptions([
			'to'      => $users->email,
			'message' => $message
		])->sendMail($message);
		
		$resposeSend ? $this->Flash->success(__('User info send success.')) : $this->Flash->error(__('Send mail error.'));
	}
	
	/**
	 * @param $id
	 * @return \Cake\Http\Response|null
	 */
	public function edit($id)
	{
		$this->setDataForUserAction();
		$users = $this->Users->findById($id)->firstOrFail();
		
		if (!$this->request->is(['post', 'put'])) {
			$this->set(compact('users', 'districts', 'provinces', 'wards', 'roles'));
			
			return null;
		}
		
		$this->Users->patchEntity($users, $this->request->getData());
		
		if ($this->Users->save($users)) {
			$this->Flash->success(__('Your format has been updated.'));
			
			return $this->redirect(['action' => 'index']);
		}
		
		$this->Flash->error(__('Unable to update your format.'));
		
		$this->set(compact('users'));
	}
	
	/**
	 *  Set data for action edit and add user
	 */
	private function setDataForUserAction()
	{
		$provinces  = $this->getProvincesList();
		$districts  = $this->getDistrictsList();
		$roles      = $this->getTableLocatorName('Roles')->find();
		$wards      = $this->getWardsList();
		
		$this->set(compact('districts', 'provinces', 'wards', 'roles'));
	}
	
	/**
	 * @param $id
	 * @return \Cake\Http\Response|null
	 */
	public function delete($id)
	{
		$users = $this->Users->findById($id)->firstOrFail();
		
		if ($this->Users->delete($users)) {
			$this->Flash->success(__('The {0} article has been deleted.', $users->name));
			return $this->redirect(['action' => 'index']);
		}
	}
	
	/**
	 * @return \Cake\Http\Response|null
	 */
	public function login()
	{
		if ($this->Auth->user()) {
			return $this->redirect($this->Auth->redirectUrl());
		}
		
		if (!$this->request->is('post')) {
			return null;
		}
		
		$user = $this->Auth->identify();
		
		if ($user) {
			$userLoginInfo = $this->Users->getUserList(['Users.id' => $user['id']])->first();
			$this->Auth->setUser($userLoginInfo);
			
			return $this->redirect($this->Auth->redirectUrl());
		}
		
		$this->Flash->error(__('Invalid username or password, try again'));
	}
	
	/**
	 * @return \Cake\Http\Response|null
	 */
	public function logout()
	{
		return $this->redirect($this->Auth->logout());
	}
	
}