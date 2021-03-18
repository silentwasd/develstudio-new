<?


class TPNGSpeedButton extends TBitBtn
{

    public $class_name = __CLASS__;
    protected $_pngpicture;

    function __construct($onwer = nil, $init = true, $self = nil)
    {
        parent::__construct($onwer, $init, $self);

        if ($init) {
            $this->Spacing = 12;
        }
    }

    public function get_pngpicture()
    {

        if (!isset($this->_pngpicture))
            $this->_pngpicture = new TPNGGlyph($this->self);

        return $this->_pngpicture;
    }

    public function loadPNGStr($data)
    {
        gui_btnPNGLoadStr($this->self, $data);
    }

    public function loadPNGFile($file)
    {
        gui_btnPNGLoadFile($this->self, $file);
    }

    public function getPNGStr()
    {
        return gui_btnPNGGetStr($this->self);
    }
}