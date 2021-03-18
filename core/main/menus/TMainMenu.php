<?


class TMainMenu extends TControl
{
    public $class_name = __CLASS__;

    function set_images(TImageList $il)
    {
        //rtii_set($this, 'Images', $il->self);
    }

    function get_images()
    {

        //return _c(rtii_get($this, 'Images'));
    }

    function get_items()
    {

        return _c(rtii_get($this, 'Items'));
    }

    function addItem(TMenuItem $item, $parent_item = false)
    {

        if ($parent_item)
            $parent_item->addItem($item);
        else
            mainmenu_additem($this->self, $item->self);
    }
}