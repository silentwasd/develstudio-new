<?


class TPanel extends TControl
{
    public $class_name = __CLASS__;
    protected $_constraints;

    public function __construct($onwer = nil, $init = true, $self = nil)
    {
        parent::__construct($onwer, $init, $self);

        if ($init)
            $this->parentColor = false;
    }


    function get_constraints()
    {
        if (!isset($this->_constraints)) {
            $this->_constraints = new TSizeConstraints(nil, false);
            $this->_constraints->self = gui_propGet($this->self, 'constraints');
        }
        return $this->_constraints;
    }
}