<?


class TEditDMSColorDialog extends TEditDialog
{

    public $class_name_ex = __CLASS__;

    function __construct($onwer = nil, $init = true, $self = nil)
    {

        parent::__construct($onwer, $init, $self);

        if ($init)
            $this->readOnly = true;

        $this->__setAllPropEx($init);
    }

    function selectDialog($self)
    {

        $obj = _c(_c($self)->owner);
        $dlg = new TDMSColorDialog;
        $dlg->color = $obj->value;

        $x = cursor_real_x($dlg->form, 10);
        $y = cursor_real_y($dlg->form, 10);

        if ($dlg->execute($x, $y)) {
            $obj->value = $dlg->color;
            if ($obj->onSelect) {

                $color = $dlg->color;
                eval($obj->onSelect . '(' . $obj->self . ',$color);');
            }
        }

        $dlg->free();
    }

    function set_value($color)
    {

        $this->edit->fontColor = findContrastColor($color);
        $this->edit->color = $color;
        $this->edit->text = '0x' . dechex($color);
        $this->acolor = $color;
    }

    function get_value()
    {
        return $this->acolor;
    }
}