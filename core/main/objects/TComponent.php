<?


/**
 * Class TComponent
 */
class TComponent extends TObject {

    #public hekpKeyword // здесь храняться все нестандартные свойства

    function valid(){
        return true;
    }

    function getHelpKeyword(){

        return control_helpkeyword($this->self, null);
    }

    function setHelpKeyword($v){
        control_helpkeyword($this->self, $v);
    }

    // доп инфа для нестандартных свойств
    function __addPropEx($nm, $val){

        $class = $this->class_name_ex ? $this->class_name_ex : $this->class_name;
        $result = uni_unserialize($this->getHelpKeyword());

        $nm = strtolower($nm);

        if ($val===NULL){
            if ( $result ) unset($result['PARAMS'][$nm]);
        }  else
            $result['PARAMS'][$nm] = $val;


        $this->setHelpKeyword( uni_serialize(
                array('CLASS' => $class,
                    'PARAMS'=> $result['PARAMS'],
                ))
        );
    }

    function __setClass(){
        $class = $this->class_name_ex ? $this->class_name_ex : $this->class_name;

        $result = uni_unserialize($this->getHelpKeyword());

        //if (function_exists('msg')) pre($result);
        $this->helpKeyword = uni_serialize(
            array('CLASS' => $class,
                'PARAMS'=> $result['PARAMS'],
            ));
    }

    // достаем свойство...
    function __getPropEx($nm){

        $result = uni_unserialize(control_helpkeyword($this->self, null));
        return $result['PARAMS'][strtolower($nm)];
    }

    static function __getPropExArray($self){

        $result = uni_unserialize(control_helpkeyword($self, null));
        return $result['PARAMS'];
    }

    function __setAllPropEx($init = true){

        if ($init)
            $this->__setClass();
    }

    function __setAllPropX(){
        $result = uni_unserialize(  $this->getHelpKeyword()  );

        foreach ((array)$result['PARAMS'] as $prop=>$value){

            $this->props[strtolower($prop)] = $value;
            $this->$prop        = $value;
        }
    }

    function __initComponentInfo(){

        $this->visible = $this->avisible;
        $this->enabled = $this->aenabled;
    }

    function __construct($owner = nil,$init = true,$self = nil){

        if ($init){
            $this->self = obj_create($this->class_name, $owner);
        }

        if ($self != nil)
            $this->self = $self;


        $this->__setAllPropEx($init);
    }

    function set_prop($prop,$val){
        rtii_set($this,$prop,$val);
    }

    function get_prop($prop){
        $result = rtii_get($this,$prop);

        if ($result==='True') $result = true;
        elseif ($result==='False') $result = false;

        return $result;
    }

    function exists_prop($prop){
        return rtii_exists($this,$prop);
    }

    function __set($nm,$val){

        $nm = strtolower($nm);

        if (!method_exists($this,'set_'.$nm))
            if ($this->class_name!='TWebBrowser' && $this->class_name!='TScreenEx' && $this->class_name!='TPen' && $this->class_name!='TImageList'){

                if ($nm=='visible'){
                    return control_visible($this->self, $val);
                } elseif ($nm=='left'){
                    return control_x($this->self, $val);
                } elseif ($nm=='top'){
                    return control_y($this->self, $val);
                } elseif ($nm=='width'){
                    return control_w($this->self, $val);
                } elseif ($nm=='height'){
                    return control_h($this->self, $val);
                }
            }

        if (strtolower(substr($nm,0,2)) == 'on'){
            //if ( !method_exists($this, 'set_'.$nm) ){
            $result = set_event($this->self,$nm,$val);
            if ( method_exists($this, 'set_'.$nm) ){
                $method = 'set_'.$nm;
                $this->$method($val);
            }
            if ($result) return;
        }

        if (!$this->exists_prop($nm)){

            $this->__addPropEx($nm,$val);
            parent::__set($nm,$val);
        } else {
            $s = 'set_'.$nm;
            if (method_exists($this,'set_'.$nm))
                $this->$s($val);
            else
                $this->set_prop($nm,$val);
        }
    }

    function __get($nm){

        $nm = strtolower($nm);
        $res = parent::__get($nm);

        if (!method_exists($this,'get_'.$nm))
            if ($this->class_name!='TScreenEx' && $this->class_name!='TPen' && $this->class_name!='TImageList'){

                if ($nm == 'visible'){
                    return control_visible($this->self, null);
                } elseif ($nm=='left'){
                    return control_x($this->self, null);
                } elseif ($nm=='top'){
                    return control_y($this->self, null);
                } elseif ($nm=='width'){
                    return control_w($this->self, null);
                } elseif ($nm=='height'){
                    return control_h($this->self, null);
                }
            }

        if (is_int($res) && ($res == -908067676)){

            $result = $this->__getPropEx($nm);
            if ($result === NULL)
                return $this->get_prop($nm);
            else
                return $result;
        } else
            return $res;
    }

    function get_x(){
        return $this->left;
    }

    function set_x($v){
        $this->left = (int)$v;
    }

    function get_y(){
        return $this->top;
    }

    function set_y($v){
        $this->top = (int)$v;
    }

    function get_w(){
        return $this->width;
    }

    function set_w($v){

        $this->width = (int)$v;
    }

    function get_h(){
        return $this->height;
    }

    function set_h($v){

        $this->height = (int)$v;
    }

    function create($form = null){

        $form = $form == null ? $this->owner : $form;
        if (is_object($form))
            $form = $form->self;

        return component_copy($this->self, $form);
    }
}