<?


const OBJECT_PROPERTY_NOT_FOUND = -908067676;

/**
 * Class for Object with property ala java
 */
class _Object
{
    protected $props = array();
    protected $class_name = __CLASS__;

    public function __get($nm)
    {
        if ($this->getterMethod($nm, $result))
            return $result;

        if (property_exists($this, $nm))
            return $this->$nm;

        if ($this->getterProps($nm, $result))
            return $result;

        return OBJECT_PROPERTY_NOT_FOUND;
    }

    public function __set($nm, $val)
    {
        if (property_exists($this, $nm)) {
            $this->$nm = $val;
            return;
        }

        if (method_exists($this, $this->setterPrefixedB($nm))) {
            $this->props[$nm] = $val;
            return;
        }

        $this->setterMethod($nm, $val);
    }

    protected function getterPrefixedA($property)
    {
        return 'get_'.$property;
    }

    protected function getterPrefixedB($property)
    {
        return 'getx_'.$property;
    }

    protected function setterPrefixedA($property)
    {
        return 'set_'.$property;
    }

    protected function setterPrefixedB($property)
    {
        return 'setx_'.$property;
    }

    private function getterMethod($property, &$result)
    {
        $prefixedA = $this->getterPrefixedA($property);
        $prefixedB = $this->getterPrefixedB($property);

        if (method_exists($this, $prefixedB))
            $result = $this->$prefixedB();
        elseif (method_exists($this, $prefixedA))
            $result = $this->$prefixedA();
        else
            return false;

        return true;
    }

    private function getterProps($property, &$result)
    {
        $existInProps = array_key_exists($property, $this->props);

        if ($existInProps && method_exists($this, $this->setterPrefixedB($property)))
            $result = $this->__getPropEx($property);
        elseif ($existInProps)
            $result = $this->props[$property];
        else
            return false;

        return true;
    }

    private function setterMethod($property, $value)
    {
        $prefixedA = $this->setterPrefixedA($property);
        $prefixedB = $this->setterPrefixedB($property);

        if (method_exists($this, $prefixedA))
            $this->$prefixedA($value);
        elseif (method_exists($this, $prefixedB))
            $this->$prefixedB($value);
    }
}