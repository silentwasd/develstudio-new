<?


class TEditOpenDialog extends TEditDialog
{

    public $class_name_ex = __CLASS__;

    function __construct($onwer = nil, $init = true, $self = nil)
    {
        $this->dlg_type = 'TOpenDialog';
        parent::__construct($onwer, $init, $self);
    }
}