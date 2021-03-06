<?php
/**
 * Created by PhpStorm.
 * User: snguyenone
 * Date: 9/27/18
 * Time: 19:31
 */

namespace App\Model\Table;

use App\Model\Entity\Role;

class RolesTable extends AppTable
{
	public function initialize(array $config)
	{
		$this->addBehavior('Timestamp');
		$this->hasMany('Users');
	}
	
	public function find($type = 'all', $options = [])
	{
		return parent::find($type, $options); // TODO: Change the autogenerated stub
	}
	
	/**
	 * @param $roleName
	 * @return bool
	 */
	public static function isRoleWard($roleName)
	{
		return $roleName === Role::WARDS ? true : false;
	}
	
	/**
	 * @param $roleName
	 * @return bool
	 */
	public static function isRoleProvince($roleName)
	{
		return $roleName === Role::PROVINCES ? true : false;
	}
	
	/**
	 * @param $roleName
	 * @return bool
	 */
	public static function isRoleDistrict($roleName)
	{
		return $roleName === Role::DISTRICTS ? true : false;
	}
	
	/**
	 * @param $roleName
	 * @return bool
	 */
	public static function isRoleAdmin($roleName)
	{
		return $roleName === Role::ADMIN ? true : false;
	}
	
}