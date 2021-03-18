<?


class group {

    public $objects;

    static function toLink($obj){

        if (is_object($obj))
            return $obj->self;
        elseif (is_numeric($obj))
            return $obj;
        else
            return c($obj)->self;
    }

    function parse($expr){

        $prs = explode(',',$expr);
        foreach ($prs as $pr){
            $this->regExpr(trim($pr));
        }
    }

    function formRegExpr($str){

        global $SCREEN;
        $forms  = $SCREEN->formList();
        $result = array();
        foreach ($forms as $el)
            if (eregi($str, $el->name))
                $result[] = $el;

        return $result;
    }

    function regExpr($str){

        $lines = explode('->', $str);

        if ($GLOBALS['__ownerComponent'])
            $onwer = c($GLOBALS['__ownerComponent']);
        else
            $onwer = $SCREEN->activeForm;

        if (count($lines)>1){

            $onwers = $this->formRegExpr($lines[0]);

            foreach ($onwers as $onwer){
                $links = $onwer->componentLinks;
                foreach ($links as $link){

                    $name = component_name($link);
                    if (eregi($lines[1],$name))
                        $this->addObject($link);
                }
            }

        } elseif (count($lines)==1) {

            $links = $onwer->componentLinks;

            foreach ($links as $link){
                $name = component_name($link);
                if (eregi($str,$name)){
                    $this->addObject($link);
                }
            }
        }
    }

    public function __construct($objects = false){

        if ($objects)
            $this->setArray($objects);
    }

    public function setArray($objects){

        if (!is_array($objects)){
            $objects = explode(',',$objects);
            foreach ($objects as $i=>$el)
                $objects[$i] = trim($el);
        }

        $c = count($objects);
        for ($i=0; $i<$c; $i++){
            $this->addObject($objects[$i]);
        }
    }

    public function clear(){

        $this->objects = array();
    }

    public function addObject($obj){

        $obj = self::toLink($obj);

        if (!in_array($obj, (array)$this->objects))
            $this->objects[] = $obj;
    }

    static function set($self, $nm, $value){

        if (in_array(strtolower($nm),array('x','y','w','h')))
            return control_xywh($self, $nm, $value);

        _c($self)->$nm = $value;
    }

    function __call($name, $args){

        if (!method_exists($this, $name)){

            foreach ((array)$this->objects as $obj){
                call_user_func(array(_c($obj), $name), $args);
            }
        }
    }

    function __set($nm, $val){

        if (property_exists($this, $nm)){
            $this->$nm = $val;
            return;
        }

        foreach ((array)$this->objects as $self){

            self::set($self, $nm, $val);
        }
    }
}