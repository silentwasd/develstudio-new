<?


class TMenu extends TControl
{
    public $class_name = __CLASS__;

    function set_images(TImageList $images)
    {
        imagelist_set_images($this->self, $images->self);
    }
}