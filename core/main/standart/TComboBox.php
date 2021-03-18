<?


class TComboBox extends TControl
{
    public $class_name = __CLASS__;
    protected $_items;

    function get_items()
    {
        if (!isset($this->_items)) {
            $this->_items = new TStrings(false);
            $this->_items->self = __rtii_link($this->self, 'Items');
            $this->_items->parent_object = $this->self;
        }
        return $this->_items;
    }

    function get_itemIndex()
    {
        return $this->items->itemIndex;
    }

    function set_itemIndex($v)
    {

        $this->items->itemIndex = $v;
    }

    function set_text($v)
    {
        $this->items->text = $v;
    }

    function get_text()
    {
        return $this->items->text;
    }

    function set_inText($v)
    {
        $this->set_prop('text', $v);
    }

    function get_inText()
    {
        return $this->get_prop('text');
    }
}