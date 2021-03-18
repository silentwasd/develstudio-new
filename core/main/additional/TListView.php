<?


class TListView extends TControl
{

    public $class_name = __CLASS__;
    protected $_items;

    function get_items()
    {

        if (!$this->_items) {
            $this->_items = new TListItems($this, false);
            $this->_items->self = __rtii_link($this->self, 'items');
        }
        return $this->_items;
    }

    function set_images($c)
    {
        imagelist_set_images($this->self, $c->self);
    }

    function get_selected()
    {
        return $this->items->get_selected();
    }
}