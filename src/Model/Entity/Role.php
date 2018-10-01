<?php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

class Role extends Entity
{
	// Role name
	const ADMIN     = 'admin';
	
	//TableRole name
	const PROVINCES = 'province';
	const DISTRICTS = 'district';
	const WARDS     = 'ward';
	
	/**
	 * @var array
	 */
	protected $_accessible = [
		'*' => true,
		'id' => false
	];
	
	/**
	 * @param $role
	 * @return string
	 */
	public static function convertRoleToTableName($role)
	{
		return ucfirst($role) . 's';
	}
}