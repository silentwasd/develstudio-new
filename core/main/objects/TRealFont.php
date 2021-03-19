<?


/**
 * Class TRealFont
 */
class TRealFont extends TFont
{
    public function __construct($self)
    {
        $this->self = $self;
    }

    public function assign($font)
    {
        $this->name = $font->name;
        $this->size = $font->size;
        $this->color = $font->color;
        $this->charset = $font->charset;
        $this->style = $font->style;
    }

    protected function prop($prop)
    {
        return gui_propGet($this->self, $prop);
    }

    protected function propSet($prop, $value)
    {
        gui_propSet($this->self, $prop, $value);
    }
}