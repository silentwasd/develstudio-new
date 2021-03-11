<?

class TFunction extends __TNoVisual {
    
    public $class_name_ex = __CLASS__;
    public $rand;
    #public $icon = 'F';
    #parameters
    #description
    
    public function __inspectProperties(){
	
	return array('parameters','description','toRegister','workBackground','priority','isSync');
    }
    
    public function __initComponentInfo(){
        
        parent::__initComponentInfo();
	
        if ($this->callOnStart)
            $GLOBALS['___startFunctions'][] = 'c('.$this->self.')->call();';
	    
	define('USER_FUNCTION_SELF_'.strtolower($this->name), $this->self);
    }
    
    public function __construct($onwer=nil,$init=true,$self=nil){
	parent::__construct($onwer, $init, $self);
	
        if ($init){
	    $this->priority = tpIdle;
            $this->toRegister = true;
	    //$this->color = 0x0;
	}
    }
    
    function call(){
	
	
	if (!$this->onExecute) return null;
	
	$args  = func_get_args();
	
	
	$names = array($this->self, '$names');
	$names = array_merge($names,explode(_BR_,trim($this->parameters)));
	
	    foreach ($names as $i=>$var){
		$var  = str_replace('$','',$var);
		
		if ($i>1)
		$$var = $args[$i-2];
	    }
	    
	    if (!$names[count($names)-1])
		unset($names[count($names)-1]);
	
	    return eval('return '.$this->onExecute . '('.implode(',',$names).');');
    }
    
    // ������������� �����
    function __register($form_name, $name, $info, $eventList){
	
	$prs = $info['parameters'];
	if (strpos($prs,_BR_)===false)
	    $names = $prs;
	else
	    $names = implode(',',explode(_BR_,$info['parameters']));

	if (!$name) $name = $this->name;
	
        if ($info['workBackground']){
	    
	    $code = /*_BR_.*/'function ___thread_'.$name.'($self){ eval(enc_getValue("__incCode"));';
	    $code.= ' $_thread = TThread::get($self); extract( $_thread->args ); ';
	    $code.= ' __exEvents::setEventInfo($self, "onexecute");';
	    
	    $code .= 'if ( defined("DEBUG_OWNER_WINDOW") ){
			    include $_thread->__file;
			}';
	    $code .= 'else {';
	    if (is_array($eventList))
		$code.= $eventList['onexecute'];
	    else
		$code.= $eventList;
	    $code .= "\n".'}';
		
	    $code .= "\n".';__exEvents::freeEventInfo();';
	    $code.= _BR_.'}';
	    
	    
	    
	    
	    $code .= _BR_.'function '.$name.'('.$names.'){';
	    
	    $code .= '$self = (int)USER_FUNCTION_SELF_'.strtolower($name).';
	              $args = array("self"=>$self);';
	    $x_names = explode(',',$names);
	    foreach ($x_names as $x_name){
		if ($x_name!='')
		$code .= '$args["'.str_replace('$','',trim($x_name)).'"] = '.trim($x_name).';';
	    }
	    
	    $code .= '$th = new TThread("___thread_'.$name.'");'.
		    '$th->priority = '.(int)$info['priority'].';'.
		    '$th->args = $args;'.
		    'if(defined("DEBUG_OWNER_WINDOW")){
			$th->__file = __exEvents::callFileName($self, "onexecute");;
		    }'.
		    '$th->resume();';
		    
	    $code .= _BR_.' return $th; }';
	    
		    
	} else {
            
	    $real_names = explode(',', trim($names));
	    foreach ($real_names as $i=>$item)
		if (strpos($item,'=')!==false)
		    $real_names[$i] = trim(substr($item,0,strpos($item,'=')));
	    
	    $code = _BR_.'function _______'.$name.'('.$names.'){ eval(enc_getValue("__incCode"));';
	    if (!$form_name)
		$code .= '$self = '.$this->self.';';
	    else	
		$code .= '$self = (int)USER_FUNCTION_SELF_'.strtolower($name).';';
	    
	    $code.= ' __exEvents::setEventInfo($self, "onexecute");';
            
	    $code .= 'if ( defined("DEBUG_OWNER_WINDOW") ){
			    $__file = syncEx("__exEvents::callFileName", array($self, "onexecute"));
	                    return include($__file); }';
	    $code .= ' else {';
	    if (is_array($eventList))
		$code.= $eventList['onexecute'];
	    else
		$code.= $eventList;
	    $code .= "\n".'}
	    
		__exEvents::freeEventInfo();
	    }';
	    
	    // ����������� ���� ������ ���, ����� ���� � �-�� ����� ������, �� ������������ ����� �� ������������
	    // � ��������� ���� ��� ��������� � �������� ������ �����������, ��� ��� ��� :(
	    $code .= _BR_.' function '.$name.'('.$names.'){';
	    
	    if ( $info['isSync'] )
		$code .= 'if ($GLOBALS["THREAD_SELF"]) {
			$result = syncEx("'.$name.'", array('.implode(',',$real_names).'));
		    } else {
			$result = _______'.$name.'('.implode(',',$real_names).');
		    }';
	    else
		$code .= '$result = _______'.$name.'('.implode(',',$real_names).');';
	    
	    $code .= '
		return $result;
	    }' ;
	    
	    //pre($code);
        }
	
	return $code;
    }
    
    function register($name = false){
	
	if (!$name) $name = $this->name;
		
	if (function_exists($name)){
	    //pre('Function "'.$name.'" already exists!');
	} elseif ($this->onExecute) {
	    
	    	$code = __exEvents::getEvent($this->self, 'onexecute');
		$info['parameters'] = $this->parameters;
		$info['workBackground'] = $this->workBackground;
		$info['priority']   = $this->priority;
		
		$code = $this->__register('',$name,$info,$code);
		eval ($code);
	}
    }
    
}

function f($function){
	
	if (!is_object($function)){
	    $function = str_replace(array('.','::'),'->',$function);
	    $func = c($function, true); // cached
	} else {
	    $func =& $function;
	}
	
	if (!$func)
	    return msg('"'.$function.'" - function not found!');
	
	
	$args = func_get_args();
	unset($args[0]);
	$args = array_values($args);
	
	$names = array();
	foreach ($args as $i=>$var){
	    $var     = 'var'.$i;
	    $$var    = $args[$i];
	    $names[] = '$'.$var;
	}
	
	return eval('return $func->call(' . implode(',',$names) . ');');
}

function __callFunction($function, $self){
    
    $function = str_replace(array('.','::'),'->',$function);
    $func = c($function, true); // cached
    
	if (!$func)
	    return msg('"'.$function.'" - function not found!');
	
	$func->parameters = '$self'._BR_.'$obj';
    
    return eval('return $func->call(' . $func->self .',_c('. $self . '));');
}

?>