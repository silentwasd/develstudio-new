<?


class DebugClass {
	
	public $self = 0;
	public $nameParam = '';
	
	public function __construct($name){
		if ( is_numeric($name) )
			$this->nameParam = syncEx('gui_propGet', array($name, 'name'));
		else
			$this->nameParam = $name;
	}
	
	public function __set($name, $value){
		trigger_error(t('Component "%s" not found for set "%s" property', $this->nameParam, $name), E_USER_ERROR);
	}
	
	public function __get($name){
		
		trigger_error(t('Component "%s" not found for get "%s" property', $this->nameParam, $name), E_USER_ERROR);
	}
	
	public function __call($name, $args){
		
		trigger_error(t('Component "%s" not found for call "%s" method', $this->nameParam, $name), E_USER_ERROR);
	}
	
	public function valid(){
		return false;
	}
}