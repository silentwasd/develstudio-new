<?


class TTabControl extends TControl
{
    public $class_name = __CLASS__;
    protected $_tabs;

    function get_tabs()
    {
        if (!isset($this->_tabs)) {
            $this->_tabs = new TStrings(false);
            $this->_tabs->self = gui_propGet($this->self, 'tabs');
            $this->_tabs->parent_object = $this->self;
        }
        return $this->_tabs;
    }

    function addPage($caption)
    {

        $tabs = $this->tabs;
        $tabs->add($caption);
    }


    function indexOfTabXY($x, $y)
    {

        return tabcontrol_indexofxy($this->self, $x, $y);
    }

    function set_text($v)
    {
        $this->tabs->text = $v;
    }

    function get_text()
    {
        return $this->tabs->text;
    }
}