<?


class TCheckBox extends TControl
{
    public $class_name = __CLASS__;

    public function set_checked($v)
    {
        $this->set_prop('checked', (bool)$v);
    }
}