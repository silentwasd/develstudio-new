<?

class TPopupMenuEx extends __TNoVisual{
    
    public $class_name_ex = __CLASS__;
    #public data
    
    public function __construct($onwer=nil,$init=true,$self=nil){
        parent::__construct($onwer, $init, $self);
    }
    
    public function __initComponentInfo(){
			
	parent::__initComponentInfo();
	//pre($this->data);
	$obj = new TPopupMenu(_c($this->owner));
        
	$list = array();
	
	$data = explode(_BR_,$this->data);
	$list[0] = $obj;
	
	$name_form = _c($this->owner)->name;
        $styled    = $this->styled;
	
	
	foreach ($data as $item){
	    
	    $item = str_replace(chr(9),' ',$item);
            
            $params = array();
            $k      = strpos($item,'[');
            if ($k!==false){
                $text   = trim(substr($item, 0, $k));
                $params = trim(substr($item, $k+1, -1));
                $params = explode(',', $params);
            } else {
                $text   = trim($item);
            }
            
            $func = $params[0];
                    
                /*if ($func && !function_exists($func)){
                if (strpos($func,'.')===false && strpos($func,'::')===false && strpos($func,'->')===false)
                    $func = $name_form . '.' . $func;
                }*/
                
            $img  = resFile( trim($params[1]) );
	    $scut = trim($params[2]);
	    
            $name = trim($params[3]);
            
	    $level = strlen($item) - strlen(ltrim($item));
	    $org = $list[$level];
	    
	    $x    = new TMenuItem(_c($this->owner));
	    
	    $x->caption = t($text);
	    $x->shortCut = $scut;
	    $x->loadPicture($img);
	    
	    $org->addItem($x);
            
            if ($func){
                
		$x->onClick = $func;
                //setEvetFromFunction($x,'onClick',$func);
            }
	    if ($name)
                $x->name = $name;
            
	    if ($styled)
		styleMenu::addItem($x);
                
	    $list[$level+1] = $x;
	}
        
        
        if ($this->styled){
            styleMenu::add($obj);
        }
        
        $objects = explode(_BR_,$this->objects);
	
        $owner   = _c($this->owner);
        foreach ($objects as $el){
            
            if (strtolower($owner->name) == strtolower($el))
                $owner->popupMenu = $obj;
            else {
		if ( $el )
		DSApi::reg_startFunc('c("'.$el.'")->popupMenu = c('.$obj->self.')');
            }
        }
        
            
	$tmp = $this->name;
	$this->name = '';
	$obj->name = $tmp;
	eventEngine::updateIndex($obj);
    }
}


?>