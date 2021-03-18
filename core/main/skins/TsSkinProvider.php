<?


class TsSkinProvider extends TControl
{

    public $class_name = __CLASS__;

    function __construct($onwer = nil, $init = true, $self = nil)
    {
        parent::__construct($onwer, $init, $self);

        if ($init) {
            $this->useGlobalColor = false;
            $this->showAppIcon = true;
            $this->CaptionAlignment = taLeftJustify;
            $this->resizeMode = rmStandart;
        }
    }
}