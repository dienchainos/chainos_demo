<?php
/**
 * Created by PhpStorm.
 * User: snguyenone
 * Date: 9/29/18
 * Time: 00:02
 */

namespace App\View\Helper;

use Cake\ORM\TableRegistry;
use Cake\View\Helper;

class BuildHelper extends Helper
{
	/**
	 * @param $userId
	 * @param null $nameField
	 * @return mixed
	 */
	public function getUserInfo($userId, $nameField = null)
	{
		$userInfo = TableRegistry::getTableLocator()->get('Users')->findById($userId)->first();
		
		return empty($nameField) ? $userInfo : $userInfo->$nameField;
	}
	
	/**
	 * @param \DateTime $field
	 * @param string $dataTime
	 * @return string
	 */
	public function formatDateTime($field, $dataTime = DATE_RFC850)
	{
		return $field->format($dataTime);
	}
	
}