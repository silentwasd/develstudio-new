<?


class TIcon extends TObject
{

    public $class_name = __CLASS__;
    public $parent_object = nil;

    function __construct($init = true)
    {
        if ($init)
            $this->self = ticon_create();
    }

    function saveToFile($filename)
    {
        icon_savefile($this->self, replaceSr($filename));
    }

    function loadAnyFile($filename)
    {
        $this->loadFromFile($filename);
    }

    function loadFromFile($filename)
    {
        $filename = getFileName($filename);
        icon_loadfile($this->self, replaceSr($filename));
    }

    function loadFromStream($stream)
    {

        picture_loadstream($this->self, $stream->self);
    }

    function saveToStream($stream)
    {

        picture_loadstream($this->self, $stream->self);
    }

    function assign($bitmap)
    {

        if ($bitmap instanceof TBitmap) {
            icon_assign($this->self, $bitmap->self);
        } elseif ($bitmap instanceof TIcon) {
            icon_assign_ico($this->self, $bitmap->self);
        }
    }

    function isEmpty()
    {

        return !icon_empty($this->self);
    }


    public function copyToClipboard()
    {

        clipboard_assign($this->self);
    }
}