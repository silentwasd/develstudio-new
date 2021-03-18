<?


class TBitmap extends TObject
{

    public $class_name = __CLASS__;
    public $parent_object = nil;

    public function __construct($init = true)
    {
        if ($init)
            $this->self = tbitmap_create();
    }

    public function loadFromFile($filename)
    {

        $filename = replaceSr(getFileName($filename));

        if (fileExt($filename) == 'bmp') {
            bitmap_loadfile($this->self, replaceSr($filename));
        } else {

            convert_file_to_bmp($filename, $this->self);
        }
    }

    public function saveToFile($filename)
    {
        $filename = replaceSr($filename);
        bitmap_savefile($this->self, replaceSr($filename));
    }

    // загрузка любых форматов...
    public function loadAnyFile($filename)
    {

        $filename = replaceSr(getFileName($filename));
        convert_file_to_bmp($filename, $this->self);
    }

    public function loadFileWithBorder($filename, $border = 1)
    {

        $filename = replaceSr(getFileName($filename));
        convert_file_to_bmp_border($filename, $this->self, $border);
    }

    public function loadFromStream($stream)
    {
        picture_loadstream($this->self, $stream->self);
    }

    public function saveToStream($stream)
    {
        picture_loadstream($this->self, $stream->self);
    }

    public function loadFromStr($str)
    {
        bitmap_loadstr($this->self, $str);
    }

    public function saveToStr(&$str)
    {
        $str = bitmap_savestr($this->self);
    }

    public function copyToClipboard()
    {

        clipboard_assign($this->self);
    }

    public function clear()
    {
        $this->assign(null);
    }

    public function assign($bitmap)
    {

        if ($bitmap instanceof TPicture)
            $this->assign($bitmap->getBitmap());
        else
            bitmap_assign($this->self, $bitmap->self);
    }

    public function isEmpty()
    {
        return !bitmap_empty($this->self);
    }

    public function getCanvas()
    {

        $tmp = new TCanvas(false);
        $tmp->self = bitmap_canvas($this->self);

        return $tmp;
    }

    public function setSizes($width, $height)
    {
        bitmap_size($this->self, $width, $height);
    }
}