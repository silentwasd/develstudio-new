<?


class TPopupMenu extends TControl
{
    public $class_name = __CLASS__;


    function popup($x, $y)
    {

        popup_popup($this->self, (int)$x, (int)$y);
    }

    function addItem(TMenuItem $item, $parent_item = false)
    {

        if ($parent_item)
            $parent_item->addItem($item);
        else
            popup_additem($this->self, $item->self);
    }

    function set_images(TImageList $images)
    {
        imagelist_set_images($this->self, $images->self);
    }

    function get_items()
    {
        $result = array();
        for ($i = 0; $i < popup_item_count($this->self) - 1; $i++) {
            $result[] = _c(popup_item_id($i));
        }

        return $result;
    }

    function isShow()
    {

        return popup_isshow($this->self);
    }
}