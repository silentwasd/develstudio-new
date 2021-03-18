<?

class TEditColorDialog extends TEditDialog
{

    public $class_name_ex = __CLASS__;

    function __construct($onwer = nil, $init = true, $self = nil)
    {
        $this->dlg_type = 'TColorDialog';

        parent::__construct($onwer, $init, $self);

        $this->readOnly = true;
        $this->value = $this->dlg->color;
        $this->__setAllPropEx();
    }

    function __initComponentInfo()
    {

        parent::__initComponentInfo();
        $this->color = $this->acolor;
    }

    function selectDialog($self)
    {

        $obj = _c(_c($self)->owner);

        if ($obj->dlg->execute()) {
            $obj->value = $obj->dlg->color;
            if ($obj->onSelect) {

                $color = $obj->dlg->color;
                eval($obj->onSelect . '(' . $obj->self . ',$color);');
            }

        }
    }

    function set_value($color)
    {
        if ($color == clNone) {
            $this->edit->text = 'None';
            $this->edit->color = clWhite;
        } else {
            $this->edit->text = '0x' . dechex($color);
            $this->edit->color = $color;
        }


        $this->dlg->color = $color;
        $this->acolor = $color;
    }

    function get_value()
    {
        return $this->dlg->color;
    }
}