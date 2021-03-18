<?


class TReplaceDialog extends TCommonDialog
{
    public $class_name = __CLASS__;

    public function get_isMatchCase()
    {
        return $this->getOption('frMatchCase');
    }

    public function set_isMatchCase($v)
    {
        $this->setOption('frMatchCase', $v);
    }
}