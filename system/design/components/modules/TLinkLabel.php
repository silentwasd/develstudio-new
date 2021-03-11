<?


class TLinkLabel extends TLabel {
    
    public $class_name_ex = __CLASS__;
    
    static function fontToArr(TFont $font){
        
        $arr['size'] = $font->size;
        $arr['color']= $font->color;
        $arr['style']= $font->style;
        $arr['name'] = $font->name;
        
        return $arr;
    }
    
    static function arrToFont(TFont $font, $arr){
        
        $font->size = $arr['size'];
        $font->color= $arr['color'];
        $font->style= $arr['style'];
        $font->name = $arr['name'];
    }
    
    function set_onMouseEnter($v){
	
	event_set($this->self, 'onMouseEnter', 'TLinkLabel::doMouseEnter');
	$this->fMouseEnter = $v;
    }
    
    function set_onMouseLeave($v){
	
	event_set($this->self, 'onMouseLeave', 'TLinkLabel::doMouseLeave');
	$this->fMouseLeave = $v;
    }
    
    function set_onClick($v){
	event_set($this->self, 'onClick', 'TLinkLabel::doClick');
	$this->fClick = $v;
    }
    
    function __initComponentInfo(){
        
        $this->fMouseEnter  = event_get($this->self,'onMouseEnter');
        event_set($this->self, 'onMouseEnter', 'TLinkLabel::doMouseEnter');
        
        $this->fMouseLeave  = event_get($this->self,'onMouseLeave');
        event_set($this->self, 'onMouseLeave', 'TLinkLabel::doMouseLeave');
        
        $this->fClick     = event_get($this->self,'onClick');
        event_set($this->self, 'onClick', 'TLinkLabel::doClick');
    }
    
    function __construct($onwer=nil,$init=true,$self=nil){
	parent::__construct($onwer,$init,$self);
    	
        if ($init){
	    
	    if ( !$GLOBALS['APP_DESIGN_MODE'] ){ // fix
		$this->__initComponentInfo();
	    }
	    
            $this->fontColor  = clBlue;
            $this->hoverColor = clRed;
            $this->hoverStyle = 'fsUnderline';
            $this->hoverSize  = 0;
            $this->cursor     = crHandPoint;
	    $this->autoSize   = true;
        }
    }
    
    static function doClick($self){
        
        $obj = c($self);
	$link= $obj->link;
        if ( $link ){
	    $x = c($link);
            
	    if ($x->valid()){
		
		if (method_exists($x,'showModal'))
		    $x->showModal();
		else
		    $x->show();
		
	    } else {
		run( $obj->link );
	    }
	}
            
        if ( $obj->fClick )
            call_user_func($obj->fClick, $self);
    }
    
    static function doMouseEnter($self){
        
        $obj = c($self);
       
        
        $obj->lastFont   = self::fontToArr($obj->font);
        
        $obj->fontColor = $obj->hoverColor;
        
        if ($obj->hoverSize)
            $obj->fontSize = $obj->hoverSize;
        
        $obj->font->style = $obj->hoverStyle;
        
        if ( $obj->fMouseEnter )
            call_user_func($obj->fMouseEnter, $self);
    }
    
    static function doMouseLeave($self){
        
        $obj = c($self);
        self::arrToFont($obj->font, $obj->lastFont);
	
        if ( $obj->fMouseLeave ){
            call_user_func($obj->fMouseLeave, $self);
        }
    }
}