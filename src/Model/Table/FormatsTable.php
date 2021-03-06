<?php
/**
 * Created by PhpStorm.
 * User: snguyenone
 * Date: 9/27/18
 * Time: 19:31
 */

namespace App\Model\Table;

class FormatsTable extends AppTable
{
	public function initialize(array $config)
	{
		$this->addBehavior('Timestamp');
		$this->belongsTo('Users');
	}
	
	public function find($type = 'all', $options = [])
	{
		return parent::find($type, $options); // TODO: Change the autogenerated stub
	}
	
	public function getInfoFormatWithId($id)
	{
		return $this->findById($id)->contain(['Users'])->toArray();
	}
	
}