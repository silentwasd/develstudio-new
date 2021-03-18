<?


class TListBox extends TControl
{
    public $class_name = __CLASS__;
    protected $_items;

    function getFont($index)
    {
        $font = gui_listGetFont($this->self, $index);
        if ($font)
            return new TRealFont($font);
        else
            return null;
    }

    function clearFont($index)
    {
        gui_listClearFont($this->self, $index);
    }

    function clearItemColor($index)
    {
        $this->setItemColor($index, clNone);
    }

    function setItemColor($index, $color)
    {
        gui_listSetColor($this->self, $index, $color);
    }

    function getItemColor($index)
    {
        return gui_listGetColor($this->self, $index);
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

    function getSelected()
    {

        $c = $this->items->count;
        $result = array();

        for ($i = 0; $i < $c; $i++) {

            if ($this->isSelected($i))
                $result[] = $this->items->getLine($i);
        }
        return $result;
    }

    // return array

    function isSelected($index, $value = null)
    {

        if ($index < 0)
            return false;
        else
            return listbox_selected($this->self, $index, $value);
    }

    function setSelected($arr)
    {

        $this->unSelectedAll();
        foreach ($arr as $el) {

            $index = $this->items->indexOf($el);

            $this->isSelected($index, true);
        }
    }

    function unSelectedAll()
    {

        $c = $this->items->count;
        $result = array();
        for ($i = 0; $i < $c; $i++) {
            $this->isSelected($i, false);
        }
    }
}