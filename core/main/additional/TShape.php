<?


class TShape extends TControl
{
    public $class_name = __CLASS__;

    protected $_brush;
    protected $_pen;


    public function get_brush()
    {

        if (!$this->_brush) {
            $this->_brush = new TBrush(false);
            $this->_brush->self = __rtii_link($this->self, 'Brush');
        }
        return $this->_brush;
    }

    public function get_pen()
    {

        if (!$this->_pen) {

            $this->_pen = new TPen(false);
            $this->_pen->self = __rtii_link($this->self, 'Pen');
        }

        return $this->_pen;
    }

    function get_brushColor()
    {
        return $this->brush->color;
    }

    function set_brushColor($v)
    {
        $this->brush->color = $v;
    }

    function get_brushStyle()
    {
        return $this->brush->style;
    }

    function set_brushStyle($v)
    {
        $this->brush->style = $v;
    }

    function get_penColor()
    {
        return $this->pen->color;
    }

    function set_penColor($v)
    {
        $this->pen->color = $v;
    }

    function get_penMode()
    {
        return $this->pen->mode;
    }

    function set_penMode($v)
    {
        $this->pen->mode = $v;
    }

    function get_penStyle()
    {
        return $this->pen->style;
    }

    function set_penStyle($v)
    {
        $this->pen->style = $v;
    }

    function get_penWidth()
    {
        return $this->pen->width;
    }

    function set_penWidth($v)
    {
        $this->pen->width = $v;
    }
}