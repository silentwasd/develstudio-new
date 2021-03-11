<?
class TFontDialogEx extends __TNoVisual {
    
    public $class_name_ex = __CLASS__;

    public function __construct($onwer=nil,$init=true,$self=nil){
        parent::__construct($onwer, $init, $self);
          
        if ($init){
            $this->maxFontSize = 0;
            $this->minFontSize = 0;
            $this->device = fdScreen;
        }
    }
    
    public function __initComponentInfo(){
        
        parent::__initComponentInfo();
        $md = new TFontDialog($this->parent);
        $md->minFontSize = $this->minFontSize;
        $md->maxFontSize = $this->maxFontSize;
        $md->device      = $this->device;
        
        $tmp = $this->name;
        $this->name = '';
        $md->name = $tmp;
        eventEngine::updateIndex($md);
    }
}
?>