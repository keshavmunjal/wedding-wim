<?php 

class UserModel extends AppModel {
    public $useTable = 'Users'; // This model does not use a database table
		
		public function show(){
			$all = $this->Users->find('all');
			var_dump($all);exit;

		}
}