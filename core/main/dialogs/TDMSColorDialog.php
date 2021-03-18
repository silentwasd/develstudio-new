<?


class TDMSColorDialog extends TComponent
{

    public function __construct($onwer = null, $init = true, $self = nil)
    {
        //parent::__construct($onwer,$init,$self);

        if ($init)
            $this->self = dms_colordialog_create($onwer);

        if ($self != nil)
            $this->self = $self;
    }

    public function get_form()
    {

        return dms_colordialog_form($this->self);
    }

    public function show($x = -1, $y = -1)
    {
        return $this->execute($x, $y);
    }

    public function execute($x = -1, $y = -1)
    {

        return dms_colordialog_execute($this->self, (int)$x, (int)$y);
    }
}