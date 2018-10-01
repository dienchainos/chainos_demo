<?php
/**
 * Created by PhpStorm.
 * User: snguyenone
 * Date: 9/29/18
 * Time: 13:11
 */

namespace App\Controller\Component;

use App\Model\Entity\Role;

class DashboardComponent extends AppComponent
{
	/**
	 * @param $userId
	 * @param $roleName
	 * @return mixed
	 */
	public function getMenuList($userId, $roleName)
	{
		$condition      = $this->getTableLocatorName('Users')->getRoleConditions($userId);
		$tableGetMenu   = Role::convertRoleToTableName($roleName);
		
		if ($roleName === Role::ADMIN ) {
			$condition['user'] = Role::ADMIN;
			$tableGetMenu      = Role::convertRoleToTableName(Role::PROVINCES);
		}
		
		$provincesTable = $this->getTableLocatorName($tableGetMenu);
		
		return $provincesTable->getListMenuTree($condition);
	}
	
}