<?


class TPNGGlyph
{

    public $self;

    public function __construct($self)
    {
        $this->self = $self;
    }

    public function assign($pic)
    {

        if (!gui_btnPNGAssign($this->self, $pic->self)) {
            _c($this->self)->picture->assign($pic);
        }
    }

    public function loadAnyFile($filename)
    {
        $this->loadFromFile($filename);
    }

    public function loadFromFile($file)
    {

        if (fileExt($file) == 'png')
            _c($this->self)->loadPNGFile($file);
        else
            _c($this->self)->picture->loadFromFile($file);
    }

    public function loadPNGStr($str)
    {
        _c($this->self)->loadPNGFile($str);
    }

    public function isEmpty()
    {
        return gui_btnPngIsEmpty($this->self) && _c($this->self)->picture->isEmpty();
    }
}