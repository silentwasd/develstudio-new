<?


class TEditSaveDialog extends TEditDialog
{

    public $class_name_ex = __CLASS__;

    function __construct($onwer = nil, $init = true, $self = nil)
    {
        $this->dlg_type = 'TSaveDialog';

        parent::__construct($onwer, $init, $self);

    }
}