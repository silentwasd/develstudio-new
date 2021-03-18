<?


class TEditBtn extends TPanel
{

    const BUTTON_HEIGTH = 26;

    public $btn;
    public $edit;

    public $class_name_ex = __CLASS__;

    function __construct($onwer = nil, $init = true, $self = nil)
    {
        parent::__construct($onwer, $init, $self);
        $this->bevelOuter = 'bvNone';


        if ($init) {
            $this->text = '';
            $this->createComponents();
        } else {
            $this->edit = _c($this->edit_link);
            $this->btn = _c($this->btn_link);
        }

        $this->initComponents();
        $this->__setAllPropEx($init);
    }

    function set_onSelectClick($str)
    {

        $this->btn->onClick = $str;
    }

    function set_onKeyPress($str)
    {

        $this->edit->onKeyPress = $str;
    }

    function set_onKeyUp($str)
    {

        $this->edit->onKeyUp = $str;
    }

    function set_onKeyDown($str)
    {

        $this->edit->onKeyDown = $str;
    }

    function set_onChange($str)
    {

        $this->edit->onChange = $str;
    }

    function __initComponentInfo()
    {

        $this->createComponents();
        $this->initComponents();
        $this->text = $this->atext;
        $this->readOnly = $this->areadOnly;
        $this->caption = $this->acaption;
    }

    function createComponents()
    {
        $this->btn = new TBitBtn($this);
        $this->btn->parent = $this;

        $this->edit = new TEdit($this);
        $this->edit->parent = $this;
        //$this->edit->height = self::BUTTON_HEIGTH;

        $this->edit->name = 'edit';
        $this->btn->name = 'btn';

        $this->edit->text = '';
        $this->btn->caption = '...';

        $this->edit_link = $this->edit->self;
        $this->btn_link = $this->btn->self;

        $this->height = $this->edit->h + 2;
    }

    function initComponents()
    {

        $this->caption = ' ';
        $this->edit->left = 0;
        $this->edit->top = 0;
        //$this->edit->height = self::BUTTON_HEIGTH;

        $this->edit->width = $this->width - self::BUTTON_HEIGTH - 4;

        $this->edit->anchors = 'akLeft, akRight, akTop';

        $this->btn->top = 0;
        $this->btn->width = self::BUTTON_HEIGTH;
        $this->btn->height = $this->edit->height;
        $this->btn->left = $this->width - self::BUTTON_HEIGTH;
        $this->caption = ' ';

        $this->btn->anchors = 'akRight, akTop';
        //$this->__getAddSource();
    }

    function set_text($v)
    {
        $this->edit->text = $v;
        $this->atext = $v;
    }

    function get_text()
    {
        return $this->edit->text;
    }

    function set_caption($v)
    {
        $this->btn->text = $v;
        $this->acaption = $v;
    }

    function get_caption()
    {
        return $this->btn->text;
    }

    function set_readOnly($v)
    {
        $this->edit->readOnly = (bool)$v;
        $this->areadOnly = (bool)$v;
    }

    function get_readOnly()
    {
        return $this->edit->readOnly;
    }

    function __set($name, $value)
    {
        parent::__set($name, $value);

        if ($name == 'name') {
            $this->text = $value;
        }

        $this->initComponents();
    }
}