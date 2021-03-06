<?php

namespace App\Model\Table;

use App\Model\Entity\Role;
use App\Model\Entity\User;
use Cake\Validation\Validator;

class UsersTable extends AppTable
{
	/**
	 * @param array $config
	 */
	public function initialize(array $config)
	{
		parent::initialize($config); // TODO: Change the autogenerated stub
		$this->addBehavior('Timestamp');
		$this->belongsTo('Roles');
		$this->belongsTo('Provinces');
		$this->belongsTo('Districts');
		$this->belongsTo('Wards');
	}
	
	/**
	 * @param Validator $validator
	 * @return Validator
	 */
	public function validationDefault(Validator $validator)
	{
		return $validator
			->notEmpty('username', 'A username is required')
			->notEmpty('password', 'A password is required')
			->notEmpty('role', 'A role is required')
			->add('role', 'inList', [
				'rule' => ['inList', ['admin', 'author']],
				'message' => 'Please enter a valid role'
			]);
	}
	
	/**
	 * @param \Cake\ORM\Query $query
	 * @param array $options
	 * @return \Cake\ORM\Query
	 */
	public function findAuth(\Cake\ORM\Query $query, array $options)
	{
		$query->select(['id', 'username', 'password']);
		
		return $query;
	}
	
	/**
	 * @param array $condition
	 * @param string $order
	 * @return array|\Cake\ORM\Query
	 */
	public function getUserList(array $condition = [], $order = 'DESC')
	{
		return $this->buildUserCondition($condition)->contain([
			'Roles', 'Provinces', 'Districts', 'Wards'
		])->order(['Users.id' => $order]);
	}
	
	/**
	 * @param array $condition
	 * @return \Cake\ORM\Query
	 */
	public function buildUserCondition(array $condition = [])
	{
		$result = $this->find();
		
		if (!empty($condition)) {
			$result = $result->where($condition);
		}
		
		return $result;
	}
	
	/**
	 * @param $userInfo
	 * @param array $condition
	 * @return array
	 */
	public function buildRoleCondition($userInfo, array $condition = [])
	{
		$roleName  = strtolower($userInfo->role->name);

		if ($roleName === User::ADMIN) {
			return $condition;
		}
		
		$typeName = $roleName . '_id';
		$condition = [
			Role::convertRoleToTableName(Role::PROVINCES) => [
				Role::convertRoleToTableName(Role::PROVINCES) . '.id' => $userInfo->province_id
			],
			Role::convertRoleToTableName(Role::DISTRICTS) => [
				Role::convertRoleToTableName(Role::DISTRICTS) . '.id' => $userInfo->district_id
			],
			Role::convertRoleToTableName(Role::WARDS)    => [
				Role::convertRoleToTableName(Role::WARDS) .'.id' => $userInfo->ward_id
			]
		];
		
		$condition = array_merge($condition);
		$condition[Role::convertRoleToTableName($roleName)] = [
			Role::convertRoleToTableName($roleName). '.id' => $userInfo->$typeName
		];

		return $condition;
	}
	
	/**
	 * @param $userId
	 * @return mixed
	 */
	public function getUserRoleInfo($userId)
	{
		return $this->findById($userId)->contain(['Roles'])->first();
	}
	
	/**
	 * @param $userId
	 * @return array
	 */
	public function getRoleConditions($userId)
	{
		return $this->buildRoleCondition($this->getUserRoleInfo($userId));
	}
	
}