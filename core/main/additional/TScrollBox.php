<?


class TScrollBox extends TControl
{
    public $class_name = __CLASS__;
    protected $_constraints;

    function get_constraints()
    {
        if (!isset($this->_constraints)) {
            $this->_constraints = new TSizeConstraints(nil, false);
            $this->_constraints->self = __rtii_link($this->self, 'constraints');
        }
        return $this->_constraints;
    }

    public function isVScrollShowing()
    {

        return scrollbox_vsshowing($this->self);
    }

    public function isHScrollShowing()
    {

        return scrollbox_hsshowing($this->self);
    }

    public function get_scrollBarSize()
    {
        return scrollbox_sbsize($this->self);
    }
}