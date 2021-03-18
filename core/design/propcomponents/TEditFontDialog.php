<?


class TEditFontDialog extends TEditDialog
{

    public $class_name_ex = __CLASS__;

    function __construct($onwer = nil, $init = true, $self = nil)
    {
        $this->dlg_type = 'TFontDialog';

        parent::__construct($onwer, $init, $self);

        $this->readOnly = true;
        $this->text = '(' . t('Font options') . ')';
    }

    function selectDialog($self)
    {

        $obj = _c(_c($self)->owner);

        if ($obj->dlg->execute()) {
            $obj->value = $obj->dlg->font;
            if ($obj->onSelect) {
                $font = $obj->dlg->font;
                eval($obj->onSelect . '(' . $obj->self . ',$font);');
            }

        }
    }

    function set_value($font)
    {
        $last_size = $this->edit->font->size;
        $this->edit->font->assign($font);
        $this->dlg->font->assign($font);
        $this->edit->font->size = $last_size;
    }

    function get_value()
    {
        return $this->dlg->font;
    }
}