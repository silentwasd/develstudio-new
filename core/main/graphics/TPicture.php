<?


class TPicture extends TObject
{

    public $class_name = __CLASS__;
    public $parent_object = nil;

    function __construct($init = true)
    {
        if ($init)
            $this->self = tpicture_create();
    }

    function loadFromStream($stream)
    {
        picture_loadstream($this->self, $stream->self);
    }

    function loadFromStr($data, $format = 'bmp')
    {

        picture_loadstr($this->self, $data, $format);
    }

    function saveToStream($stream)
    {

        picture_loadstream($this->self, $stream->self);
    }

    function loadFromUrl($url, $ext = false)
    {

        // получаем данные файла
        $text = file_get_contents($url);
        // сохраняем их в файл
        if (!$ext) $ext = fileExt($url);

        $file = replaceSl(winLocalPath(CSIDL_TEMPLATES)) . '/' . md5($url) . '.' . $ext;
        file_put_contents($file, $text);

        $this->loadAnyFile($file);
        unlink($file);
    }

    function loadAnyFile($filename)
    {
        $this->loadFromFile($filename);
    }

    function loadFromFile($filename)
    {
        //$filename = replaceSr($filename);
        $this->clear();
        //$this->getBitmap()->loadAnyFile($filename);
        picture_loadfile($this->self, replaceSr(getFileName($filename)));
    }

    function clear()
    {
        picture_clear($this->self);
    }

    function saveToFile($filename)
    {
        $filename = replaceSr($filename);
        picture_savefile($this->self, replaceSr($filename));
    }

    function getBitmap()
    {

        $self = picture_bitmap($this->self);
        $result = new TBitmap(false);
        $result->self = $self;
        return $result;
    }

    function assign($pic)
    {

        if ($pic instanceof TBitmap)
            picture_bitmap_assign($this->self, $pic->self);
        else
            picture_assign($this->self, $pic->self);
    }

    function isEmpty()
    {
        return !picture_empty($this->self);
    }

    public function copyToClipboard()
    {

        clipboard_assign($this->self);
    }

    public function pasteFromClipboard()
    {
        picture_assign($this->self, clipboard_get());
    }
}