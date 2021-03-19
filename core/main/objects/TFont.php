<?


/**
 * Class TFont
 * @property string $name
 * @property int $size
 * @property int $color
 * @property int $charset
 * @property string[] $style
 */
class TFont extends _Object
{
    /** @var int */
    public $self;

    public function assign($font)
    {
        font_assign($this->self, $font->self);
    }

    protected function prop($prop)
    {
        return gui_propGet(gui_propGet($this->self, 'Font'), $prop);
    }

    protected function propSet($prop, $value)
    {
        if (is_array($value))
            $value = implode(',', $value);

        font_prop($this->self, $prop, $value);
    }

    protected function set_name($name)
    {
        $this->propSet('name', $name);
    }

    protected function set_size($size)
    {
        $this->propSet('size', $size);
    }

    protected function set_color($color)
    {
        $this->propSet('color', $color);
    }

    protected function set_charset($charset)
    {
        $this->propSet('charset', $charset);
    }

    protected function set_style($style)
    {
        if (is_array($style))
            $style = implode(',', $style);

        $this->propSet('style', $style);
    }

    protected function get_name()
    {
        return $this->prop('name');
    }

    protected function get_color()
    {
        return $this->prop('color');
    }

    protected function get_size()
    {
        return $this->prop('size');
    }

    protected function get_charset()
    {
        return $this->prop('charset');
    }

    protected function get_style()
    {
        $result = $this->prop('style');
        $result = explode(',', $result);
        foreach ($result as $x => $e)
            $result[$x] = trim($e);
        return $result;
    }
}