<?


class TEditDialog extends TEditBtn
{

    public $dlg;
    public $dlg_type;
    public $class_name_ex = __CLASS__;

    function __construct($onwer = nil, $init = true, $self = nil)
    {
        parent::__construct($onwer, $init, $self);

        $class = $this->dlg_type;

        if ($class)
            if ($init) {
                $this->dlg = new $class($this);
                //$this->dlg->name = 'dlg';
                $this->dlg_link = $this->dlg->self;
            } else {
                $this->dlg = _c($this->dlg_link);//$this->findComponent('dlg');
            }

        $this->onSelectClick = $this->class_name_ex . '::selectDialog';
        $this->__setAllPropEx($init);
    }

    function __initComponentInfo()
    {

        parent::__initComponentInfo();

        $class = $this->dlg_type;
        $this->dlg = new $class($this);
        $this->dlg->name = 'dlg';
        $this->filter = $this->afilter;
    }

    function selectDialog($self)
    {

        $obj = _c(_c($self)->owner);

        if ($obj->dlg->execute()) {
            $obj->text = $obj->dlg->fileName;

            if ($obj->onSelect)
                eval($obj->onSelect . "(" . $obj->self . ",'" . $obj->dlg->fileName . "');");
        }

    }

    function set_onSelect($v)
    {
        $this->onSelect = $v;
    }

    function set_filter($v)
    {

        $this->dlg->filter = $v;
        $this->afilter = $v;
    }

    function get_filter($v)
    {
        return $this->dlg->filter;
    }
}