<?


class TCheckListBox extends TControl
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

    function get_checkedItems()
    {
        $result = array();
        $list = $this->items->lines;
        if (count($list))
            foreach ($list as $index => $v) {
                if ($this->isChecked($index))
                    $result[$index] = $v;
            }

        return $result;
    }

    function isChecked($index)
    {

        return checklist_checked($this->self, $index);
    }

    function set_checkedItems($v)
    {

        $list = $this->items->lines;

        if (count($list))
            foreach ($list as $index => $x) {

                $this->setChecked($index, in_array($x, $v));
            }
    }

    function setChecked($index, $value = true)
    {
        checklist_setchecked($this->self, $index, $value);
    }

    function unCheckedAll()
    {
        $this->checkedItems = array();
    }

    function checkedAll()
    {
        $list = $this->items->lines;
        $this->checkedItems = $list;
    }

    function get_itemIndex()
    {
        return $this->items->itemIndex;
    }

    function set_itemIndex($v)
    {
        $this->items->itemIndex = $v;
    }

    function set_inText($v)
    {
        $this->items->setLine($this->itemIndex, $v);
    }

    function get_inText()
    {
        return $this->items->getLine($this->itemIndex);
    }

    function set_text($v)
    {
        $this->items->text = $v;
    }

    function clear()
    {

        $this->text = '';
    }

    function get_text()
    {
        return $this->items->text;
    }
}