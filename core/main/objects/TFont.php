<?


class TFont extends _Object
{

    public $self;

    function set_name($name)
    {
        font_prop($this->self, 'name', $name);
    }

    function set_size($size)
    {
        font_prop($this->self, 'size', $size);
    }

    function set_color($color)
    {
        font_prop($this->self, 'color', $color);
    }

    function set_charset($charset)
    {
        font_prop($this->self, 'charset', $charset);
    }

    function set_style($style)
    {

        if (is_array($style)) $style = implode(',', $style);
        font_prop($this->self, 'style', $style);
    }

    function get_name()
    {
        return $this->prop('name');
    }

    function prop($prop)
    {

        return gui_propGet(gui_propGet($this->self, 'Font'), $prop);
    }

    function get_color()
    {
        return $this->prop('color');
    }

    function get_size()
    {
        return $this->prop('size');
    }

    function get_charset()
    {
        return $this->prop('charset');
    }

    function get_style()
    {

        $result = $this->prop('style');
        $result = explode(',', $result);
        foreach ($result as $x => $e)
            $result[$x] = trim($e);
        return $result;
    }

    function assign($font)
    {
        if ($font instanceof TRealFont) {
            $this->name = $font->name;
            $this->size = $font->size;
            $this->color = $font->color;
            $this->charset = $font->charset;
            $this->style = $font->style;
        } else
            font_assign($this->self, $font->self);
    }
}