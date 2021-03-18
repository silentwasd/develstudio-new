<?


class TBitBtn extends TControl
{
    public $class_name = __CLASS__;
    protected $_picture;

    public function get_picture()
    {

        if (!isset($this->_picture)) {
            $this->_picture = new TBitmap(false);
            $this->_picture->self = gui_propGet($this->self, 'Glyph');
            $this->_picture->parent_object = $this->self;
        }

        return $this->_picture;
    }

    public function doClick()
    {

        eval(get_event($this->self, 'onClick') . '(' . $this->self . ');');
    }

    public function loadPicture($file)
    {
        $this->picture->loadAnyFile($file);
    }

    public function loadFromBitmap($bt)
    {
        $this->picture->assign($bt);
    }
}