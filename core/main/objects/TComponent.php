<?


/**
 * Class TComponent
 * @property bool $visible
 * @property bool $enabled
 * @property int $left
 * @property int $top
 * @property int $width
 * @property int $height
 * @property int $x
 * @property int $y
 * @property int $w
 * @property int $h
 */
class TComponent extends TObject
{
    public function __construct($owner = nil, $init = true, $self = nil)
    {
        if ($init) {
            $this->self = obj_create($this->class_name, $owner);
        }

        if ($self != nil)
            $this->self = $self;

        $this->__setAllPropEx($init);
    }

    public function create($form = null)
    {
        $form = $form == null ? $this->owner : null;
        
        if (is_object($form))
            $form = $form->self;

        return component_copy($this->self, $form);
    }

    function __initComponentInfo()
    {
        $this->visible = $this->avisible;
        $this->enabled = $this->aenabled;
    }

    function valid()
    {
        return true;
    }

    public function __get($nm)
    {
        $nm = strtolower($nm);
        $res = parent::__get($nm);

        $ignore = array('TScreenEx', 'TPen', 'TImageList');
        if (!method_exists($this, $this->getterPrefixedA($nm)) && !in_array($this->class_name, $ignore)) {
            if ($this->controlGetter($nm, $result))
                return $result;
        }

        if (is_int($res) && ($res == OBJECT_PROPERTY_NOT_FOUND)) {
            $result = $this->__getPropEx($nm);
            if ($result === NULL)
                return $this->get_prop($nm);
            else
                return $result;
        }

        return $res;
    }

    public function __set($nm, $val)
    {
        $nm = strtolower($nm);

        $ignore = array('TWebBrowser', 'TScreenEx', 'TPen', 'TImageList');
        if (!method_exists($this, $this->setterPrefixedA($nm)) && !in_array($this->class_name, $ignore)) {
            if ($this->controlSetter($nm, $val))
                return;
        }

        if (strtolower(substr($nm, 0, 2)) == 'on') {
            $result = set_event($this->self, $nm, $val);

            if (method_exists($this, $this->setterPrefixedA($nm))) {
                $method = $this->setterPrefixedA($nm);
                $this->$method($val);
            }

            if ($result)
                return;
        }

        if (!$this->exists_prop($nm)) {
            $this->__addPropEx($nm, $val);
            parent::__set($nm, $val);
        } else {
            $s = $this->setterPrefixedA($nm);
            if (method_exists($this, $s))
                $this->$s($val);
            else
                $this->set_prop($nm, $val);
        }
    }
    
    protected function controlGetter($property, &$result)
    {
        switch ($property) {
            case 'visible':
                $result = control_visible($this->self, null);
                return true;
            case 'left':
                $result = control_x($this->self, null);
                return true;
            case 'top':
                $result = control_y($this->self, null);
                return true;
            case 'width':
                $result = control_w($this->self, null);
                return true;
            case 'height':
                $result = control_h($this->self, null);
                return true;
        }

        return false;
    }
    
    protected function controlSetter($property, $value)
    {
        switch ($property) {
            case 'visible':
                control_visible($this->self, $value);
                return true;
            case 'left':
                control_x($this->self, $value);
                return true;
            case 'top':
                control_y($this->self, $value);
                return true;
            case 'width':
                control_w($this->self, $value);
                return true;
            case 'height':
                control_h($this->self, $value);
                return true;
        }

        return false;
    }

    protected function exists_prop($prop)
    {
        return rtii_exists($this, $prop);
    }

    /**
     * Установить значение свойства.
     * @param string $prop Название свойства.
     * @param mixed $val Значение.
     */
    protected function set_prop($prop, $val)
    {
        rtii_set($this, $prop, $val);
    }

    /**
     * Получить значение свойства.
     * @param string $prop Название свойства.
     * @return mixed Значение.
     */
    protected function get_prop($prop)
    {
        $result = rtii_get($this, $prop);

        if ($result === 'True')
            return true;

        if ($result === 'False')
            return false;

        return $result;
    }

    protected function getHelpKeyword()
    {
        return control_helpkeyword($this->self, null);
    }
    
    protected function setHelpKeyword($v)
    {
        control_helpkeyword($this->self, $v);
    }

    /**
     * Получить значение дополнительного свойства.
     * @param string $nm Название свойства.
     * @return mixed Значение.
     */
    protected function __getPropEx($nm)
    {
        $result = uni_unserialize(control_helpkeyword($this->self, null));
        return $result['PARAMS'][strtolower($nm)];
    }
    
    protected function __addPropEx($nm, $val)
    {

        $class = $this->class_name_ex ? $this->class_name_ex : $this->class_name;
        $result = uni_unserialize($this->getHelpKeyword());

        $nm = strtolower($nm);

        if ($val === NULL) {
            if ($result) unset($result['PARAMS'][$nm]);
        } else
            $result['PARAMS'][$nm] = $val;


        $this->setHelpKeyword(uni_serialize(
                array('CLASS' => $class,
                    'PARAMS' => $result['PARAMS'],
                ))
        );
    }

    // достаем свойство...
    protected function __setAllPropX()
    {
        $result = uni_unserialize($this->getHelpKeyword());

        foreach ((array)$result['PARAMS'] as $prop => $value) {

            $this->props[strtolower($prop)] = $value;
            $this->$prop = $value;
        }
    }

    /**
     * Получить массив дополнительных свойств.
     * @param int $self
     * @return mixed
     */
    public static function __getPropExArray($self)
    {
        $result = uni_unserialize(control_helpkeyword($self, null));
        return $result['PARAMS'];
    }

    protected function __setAllPropEx($init = true)
    {
        if ($init)
            $this->__setClass();
    }

    protected function __setClass()
    {
        $class = $this->class_name_ex ? $this->class_name_ex : $this->class_name;
        $result = uni_unserialize($this->getHelpKeyword());
        $this->helpKeyword = uni_serialize(
            array(
                'CLASS' => $class,
                'PARAMS' => $result['PARAMS']
            )
        );
    }

    protected function get_x()
    {
        return $this->left;
    }

    protected function get_y()
    {
        return $this->top;
    }

    protected function get_w()
    {
        return $this->width;
    }

    protected function get_h()
    {
        return $this->height;
    }

    protected function set_x($v)
    {
        $this->left = (int)$v;
    }

    protected function set_y($v)
    {
        $this->top = (int)$v;
    }

    protected function set_w($v)
    {

        $this->width = (int)$v;
    }

    protected function set_h($v)
    {

        $this->height = (int)$v;
    }
}