<?


/**
 * Class for Object with property ala java
 */
class _Object {

    protected $props = array();
    protected $class_name = __CLASS__;

    function getAllProps()
    {
        return $this->props;
    }

    function __get($nm) {
        $s = 'get_'.$nm;
        $s2 = 'getx_'.$nm;
        $isset = true;
        if (method_exists($this,$s2)){
            return $this->$s2();
        } elseif (method_exists($this,$s))
            return $this->$s();
        elseif (property_exists($this,$nm))
            return $this->$nm;
        elseif (array_key_exists($nm,$this->props) && method_exists($this,'setx_'.$nm)){
            return $this->__getPropEx($nm);
        } elseif (array_key_exists($nm,$this->props)) {
            return $this->props[$nm];
        } else {
            return -908067676;
        }
    }

    function __set($nm, $val) {

        $s = 'set_'.$nm;
        $s2 = 'setx_'.$nm;
        if (property_exists($this,$nm)){
            $this->$nm = $val;
        } elseif (method_exists($this,$s2)) {
            $this->props[$nm] = $val;
        }

        if (method_exists($this,$s))
            $this->$s($val);
        if (method_exists($this,$s2))
            $this->$s2($val);
    }
}