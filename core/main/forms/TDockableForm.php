<?


class TDockableForm extends TForm
{

    public $class_name = __CLASS__;

    public function __construct($onwer = nil, $init = true, $self = nil)
    {
        parent::__construct($onwer, $init, $self);
        if ($init) {
            $this->dragKind = dkDock;
            $this->dragMode = dmAutomatic;
        }
    }
}