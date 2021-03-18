<?


class TCoolTrayIcon extends TControl
{
    public $class_name = __CLASS__;
    protected $_picture;
    protected $_icon;

    public function get_picture()
    {

        if (!isset($this->_picture)) {
            $this->_picture = new TIcon(false);
            $this->_picture->self = __rtii_link($this->self, 'Icon');
            $this->_picture->parent_object = $this->self;
        }

        return $this->_picture;
    }

    public function get_icon()
    {
        return $this->picture;
    }

    public function loadFromBitmap($bt)
    {

        $this->picture->assign($bt);
    }

    public function set_iconFile($v)
    {

        $this->aiconFile = $v;
        $v = getFileName($v);
        if (!file_exists($v)) return;

        $this->loadPicture($v);
    }

    public function loadPicture($file)
    {

        $this->picture->loadAnyFile($file);
    }

    public function get_iconFile()
    {
        return $this->aiconFile;
    }

    public function get_hint()
    {
        return $this->get_prop('hint');
    }

    public function set_hint($v)
    {
        $this->set_prop('hint', $v);
    }

    public function assign($icon)
    {
        trayicon_assign($this->self, $icon->self);
    }

    public function showBalloonTip()
    {

        return trayicon_balloontip($this->self, $this->title, $this->text, $this->flag, $this->timeout);
    }

    public function hideBalloonTip()
    {
        return trayicon_hideballoontip($this->self);
    }
}