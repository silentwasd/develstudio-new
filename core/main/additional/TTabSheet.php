<?


class TTabSheet extends TControl
{
    public $class_name = __CLASS__;

    function set_parentControl($obj)
    {
        tabsheet_parent($this->self, $obj->self);
    }

    function get_parentControl()
    {
        return _c(tabsheet_parent($this->self, 0));
    }

    function free()
    {

        foreach ($this->componentList as $el)
            $el->free();

        parent::free();
    }
}