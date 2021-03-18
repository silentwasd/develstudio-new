<?


class TCanvasFont extends TFont
{


    function set_name($name)
    {
        rtii_set($this, 'name', $name);
    }

    function set_size($size)
    {
        rtii_set($this, 'size', $size);
    }

    function set_color($color)
    {
        rtii_set($this, 'color', $color);
    }

    function set_charset($charset)
    {
        rtii_set($this, 'charset', $charset);
    }

    function set_style($style)
    {

        if (is_array($style)) $style = implode(',', $style);
        rtii_set($this, 'style', $style);
    }

    function get_name()
    {
        return $this->prop('name');
    }

    function prop($prop)
    {

        return rtii_get($this, $prop);
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
}