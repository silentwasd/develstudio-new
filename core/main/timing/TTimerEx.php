<?


class TTimerEx extends TPanel{

    public $class_name_ex = __CLASS__;
    #public $time_out = true;
    public $_timer;
    #public $var_name = ''; // íàçâàíèå ïåğåìåííîé êîòîğàÿ îñâîáîæäàåòñÿ ïîñëå îòğàáîòêè òàéìåğà
    #public $func_name = ''; // íàçâàíèå ôóíêöèè êîòîğóş íóæíî âûïîëíèòü ïîñëå îòğàáîòêè òàéìåğà
    #public $func_arguments = array(); // àğãóìåíòû ôóíêöèè...
    #public $eval_str = '';

    #event onTimer

    static function doTimer($self){

        $self = gui_owner($self);
        $props = TComponent::__getPropExArray($self);

        // íàäî ñğàçó èçáàâëÿòüñÿ îò ïğîäîëæåíèÿ òàéìåğà, èíà÷å áàã =)
        if ($props['time_out']){
            $obj = _c($self);
            $obj->timer->enabled = false;
        }

        if ($props['ontimer']){
            eval($props['ontimer'] . '('.$self.');');
        }

        if ($props['func_name']){


            if ($props['checkresult']){
                eval('$result = '.$props['func_name'] . ';');
                if ( $result===true ){

                    $obj = _c($self);
                    //$obj->timer->enabled = false;
                    $obj->free();
                }
            }
            else
                eval($props['func_name'] . ';');
        }

        if ($props['freeonend']){

            $obj->free();
        }
    }

    public function __construct($onwer=nil, $init=true, $self=nil){
        parent::__construct($onwer,$init,$self);

        if ($init){
            $this->timer->enabled = false;
        }

        $this->__setAllPropEx();
    }

    function get_timer(){

        if (!$this->timer_self){
            $this->_timer = new TTimer($this);
            $this->_timer->name = 'timer';
            $this->_timer->onTimer = 'TTimerEx::doTimer';
            $this->timer_self = $this->_timer->self;
        } else {
            $this->_timer = c($this->timer_self);
        }

        return $this->_timer;
    }

    public function set_enable($v){
        $this->timer->enabled = $v;
    }

    public function get_enable(){
        return $this->timer->enabled;
    }

    public function set_enabled($v){
        $this->enable = $v;
    }

    public function get_enabled(){
        return $this->enable;
    }

    public function set_interval($v){
        $this->timer->interval = $v;
    }

    public function get_interval(){
        return $this->timer->interval;
    }

    public function get_repeat(){
        return !$this->time_out;
    }

    public function set_repeat($v){
        $this->time_out = !$v;
    }

    public function start(){
        $this->enabled = true;

    }

    public function stop(){
        $this->enabled = false;
    }

    public function pause(){
        $this->enabled = !$this->enabled;
    }

    public function go(){$this->start();}
}