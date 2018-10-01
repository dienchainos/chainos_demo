<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\I18n\I18n;
use Cake\ORM\TableRegistry;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
	protected $defaultController = 'Dashboards';
	
	public $helpers = ['Build'];
	
	public function initialize()
	{
		$this->loadComponent('Flash');
		$this->loadComponent('Cookie');
		$this->loadComponent('Dashboard');
		$this->loadComponent('AppMail');
		$this->loadComponent('Paginator');
		$this->loadComponent('Auth', [
			'Form' => [
				'finder' => 'auth'
			],
			'loginRedirect' => [
				'controller' => 'Dashboards',
				'action' => 'index'
			],
			'logoutRedirect' => [
				'controller' => 'Users',
				'action' => 'login'
			]
		]);
		
		$user = $this->getInfoUser();
		$path = $this->getRequest()->getPath();
		$controller = $this->getRequest()->getParam('controller');
		$action = $this->getRequest()->getParam('action');
		
		if (!empty($user)) {
			$role = $this->getInfoUserRelated('role', 'name');
			$newReportList = $this->getNewReportList();
			$numberNewReport = $newReportList->count();
		}
		
		$this->Paginator->setConfig('limit', 8);
		$this->Paginator->setConfig('maxLimit', 10);
		
		$this->set(compact(
			'role', 'controller', 'user', 'path', 'numberNewReport', 'newReportList', 'action'
		));
	}
	
	/**
	 * @param Event $event
	 * @return \Cake\Http\Response|null
	 */
	public function beforeFilter(Event $event)
	{
		if (!$this->userIsLogin() && $this->getRequest()->getParam('action') !== 'login') {
			return $this->redirect('/login');
		}
		
		$this->Auth->allow(['index', 'view', 'add', 'delete', 'edit']);
		parent::beforeFilter($event);
		
		$language = $this->Cookie->read('language');
		I18n::setLocale(isset($language) ? $language : 'en_US');
		
	}
	
	/**
	 * @param $lang
	 */
	public function changeLanguage($lang)
	{
		switch ($lang) {
			case 'vn':
				$lang = 'vn';
				break;
			case 'jp':
				$lang = 'jp';
				break;
			case 'fr':
				$lang = 'fr';
				break;
			default:
				$lang = 'en_US';
				break;
		}

		$this->Cookie->write('language', $lang);
		$this->redirect($this->referer());
	}
	
	/**
	 * Return new report number that user is not read
	 *
	 * @return mixed
	 */
	protected function getNewReportList()
	{
		return $this->getTableLocatorName('Reports')
			->getReportForDashboard($this->getInfoUser(), ['Reports.user_read' => 0]
		);
	}
	
	/**
	 * @return mixed|null
	 */
	protected function userIsLogin()
	{
		return $this->Auth->user();
	}
	
	/**
	 * @param $name
	 * @return \Cake\ORM\Table
	 */
	protected function getTableLocatorName($name)
	{
		return TableRegistry::getTableLocator()->get($name);
	}
	
	/**
	 * @param array $data
	 * @return \Cake\Http\Response
	 */
	protected function getResponseJson(array $data = [])
	{
		$this->autoRender = false;
		
		return $this->response->withType('application/json')
			->withStringBody(json_encode($data));
	}
	
	/**
	 * @param null $name
	 * @return mixed|null
	 */
	protected function getInfoUser($name = null)
	{
		return $this->Auth->user($name);
	}
	
	/**
	 * @param $relatedName
	 * @param $relatedField
	 * @return mixed
	 */
	protected function getInfoUserRelated($relatedName, $relatedField)
	{
		return $this->getInfoUser($relatedName)[$relatedField];
	}
	
}