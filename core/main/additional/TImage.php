<?


class TImage extends TControl
{
    public $class_name = __CLASS__;
    protected $_picture;

    public function get_picture()
    {

        if (!isset($this->_picture)) {
            $this->_picture = new TPicture(false);
            $this->_picture->self = __rtii_link($this->self, 'Picture');
            $this->_picture->parent_object = $this->self;
        }

        return $this->_picture;
    }

    public function getCanvas()
    {

        $tmp = new TCanvas(false);
        $tmp->self = component_canvas($this->self);

        return $tmp;
    }

    public function loadFromFile($file)
    {
        $this->loadPicture($file);
    }

    public function loadPicture($file)
    {

        $this->picture->loadAnyFile($file);
    }

    public function loadFromBitmap($bt)
    {

        $this->picture->assign($bt);
    }

    public function loadFromUrl($url, $ext = false)
    {
        $this->picture->loadFromUrl($url, $ext = false);
    }

    public function saveToFile($file)
    {
        $file = replaceSl($file);
        $this->picture->saveToFile($file);
    }
}