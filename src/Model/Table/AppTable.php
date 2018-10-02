<?php
/**
 * Created by PhpStorm.
 * User: snguyenone
 * Date: 9/29/18
 * Time: 12:54
 */

namespace App\Model\Table;

use Cake\ORM\Entity;
use Cake\ORM\Table;

class AppTable extends Table
{
	/**
	 * @param $requestData
	 * @param Entity $dataEntity
	 * @return bool
	 */
	public function saveTable($requestData, Entity $dataEntity)
	{
		if (empty($messages)) {
			$dataEntity = $this->newEntity();
		}
		
		$dataEntity = $this->patchEntity($dataEntity, $requestData);
		
		return $this->save($dataEntity) ? true : false;
		
	}
	
}