<?


class TStatusBar extends TControl
{
    public $class_name = __CLASS__;

    function __construct($onwer = nil, $init = true, $self = nil)
    {
        parent::__construct($onwer, $init, $self);

        if ($init) {
            $this->useSystemFont = false;
            $this->simplePanel = true;
        }
    }
}