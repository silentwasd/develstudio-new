<?


class TForm extends TControl
{

    public $class_name = __CLASS__;
    protected $_constraints;
    protected $icon;

    static function loadFromFile($name, $init = false)
    {

        return createFormWithEvents($name, $init);
    }

    function get_icon()
    {

        if (!isset($this->_icon)) {
            $this->_icon = new TIcon(false);
            $this->_icon->self = __rtii_link($this->self, 'Icon');
            $this->_icon->parent_object = $this->self;
        }
        return $this->_icon;
    }

    function get_constraints()
    {
        if (!isset($this->_constraints)) {
            $this->_constraints = new TSizeConstraints(nil, false);
            $this->_constraints->self = gui_propGet($this->self, constraints);
            //__rtii_link($this->self,'constraints');
        }
        return $this->_constraints;
    }

    function showModal()
    {

        gui_formShowModal($this->self);
        return $this->modalResult;
    }

    function close()
    {
        gui_formClose($this->self);
    }

    function set_modalResult($mr)
    {

        form_modalresult($this->self, $mr);
    }

    function get_modalResult()
    {

        return form_modalresult($this->self, null);
    }

    function scrollBy($x, $y)
    {

        form_scrollby($this->self, $x, $y);
    }

    function setx_positionEx($v)
    {

    }
}