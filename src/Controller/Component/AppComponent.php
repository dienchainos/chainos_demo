<?php
/**
 * Created by PhpStorm.
 * User: snguyenone
 * Date: 9/29/18
 * Time: 13:14
 */

namespace App\Controller\Component;


use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class AppComponent extends Component
{
	public function getTableLocatorName($name)
	{
		return TableRegistry::getTableLocator()->get($name);
	}
}