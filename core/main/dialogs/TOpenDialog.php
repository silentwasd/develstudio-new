<?


class TOpenDialog extends TCommonDialog
{
    public $class_name = __CLASS__;


    function set_smallMode($v)
    {
        $this->setOption('ofExNoPlacesBar', $v, true);
    }

    function get_smallMode()
    {
        return $this->getOption('ofExNoPlacesBar', true);
    }


    function set_multiSelect($v)
    {
        $this->setOption('ofAllowMultiSelect', $v);
    }

    function get_multiSelect()
    {
        return $this->getOption('ofAllowMultiSelect');
    }

}