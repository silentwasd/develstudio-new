<?


class TColorDialog extends TCommonDialog
{
    public $class_name = __CLASS__;

    function set_smallMode($v)
    {
        $this->setOption('cdFullOpen', !$v);
    }

    function get_smallMode()
    {
        return !$this->getOption('cdFullOpen');
    }
}