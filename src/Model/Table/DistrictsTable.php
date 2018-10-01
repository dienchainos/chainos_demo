<?php
/**
 * Created by PhpStorm.
 * User: snguyenone
 * Date: 9/27/18
 * Time: 19:31
 */

namespace App\Model\Table;

use App\Model\Entity\Role;

class DistrictsTable extends AppTable
{
	public function initialize(array $config)
	{
		$this->addBehavior('Timestamp');
		$this->hasMany('Wards');
	}
	
	/**
	 * @param string $type
	 * @param array $options
	 * @return \Cake\ORM\Query
	 */
	public function find($type = 'all', $options = [])
	{
		return parent::find($type, $options); // TODO: Change the autogenerated stub
	}
	
	/**
	 * @param array $conditions
	 * @return array|\Cake\ORM\Query
	 */
	public function getListMenuTree(array $conditions = [])
	{
		$conditions = array_merge($conditions);

		return $this->find()
			->where($conditions[Role::convertRoleToTableName(Role::DISTRICTS)])
			->contain([Role::convertRoleToTableName(Role::WARDS)]);
	}
}