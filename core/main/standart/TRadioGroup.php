<?


class TRadioGroup extends TControl
{
    public $class_name = __CLASS__;
    protected $_items;

    function __construct($onwer = nil, $init = true, $self = nil)
    {
        parent::__construct($onwer, $init, $self);
        if ($init)
            $this->parentColor = false;
    }

    function get_items()
    {
        if (!isset($this->_items)) {
            $this->_items = new TStrings(false);
            $this->_items->self = __rtii_link($this->self, 'Items');
            $this->_items->parent_object = $this->self;
        }
        return $this->_items;
    }

    function set_text($v)
    {
        $this->items->text = $v;
    }

    function get_text()
    {
        return $this->items->text;
    }
}