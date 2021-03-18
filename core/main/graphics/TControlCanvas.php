<?


class TControlCanvas extends TCanvas
{

    public $class_name = __CLASS__;

    function __construct($ctrl = false)
    {
        parent::__construct(nil, true, nil);

        $this->self = control_canvas();

        $this->brush = new TBrush;
        $this->brush->self = canvas_brush($this->self);

        $this->pen = new TPen;
        $this->pen->self = canvas_pen($this->self);

        $this->font = new TCanvasFont;
        $this->font->self = canvas_font($this->self);
        $this->font->size = 15;

        if (($ctrl instanceof TControl) || ($ctrl instanceof TBitMap))
            $this->control = $ctrl;
    }

    function get_control()
    {
        return _c(canvas_control($this->self, null));
    }

    function set_control($v)
    {


        if (method_exists($v, 'getCanvas')) {
            $this->self = $v->getCanvas()->self;

            $this->brush = new TBrush;
            $this->brush->self = canvas_brush($this->self);

            $this->pen = new TPen;
            $this->pen->self = canvas_pen($this->self);

            $this->font = new TCanvasFont;
            $this->font->self = canvas_font($this->self);
            $this->font->size = 15;
        } else {
            canvas_control($this->self, $v->self);
        }
    }

    function free()
    {
        if ($this->self)
            obj_free($this->self);
    }
}