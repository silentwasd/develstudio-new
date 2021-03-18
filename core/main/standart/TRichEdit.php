<?


class TRichEdit extends TMemo
{

    public $class_name = __CLASS__;

    public function loadFromFile($file)
    {
        $file = getFileName($file);

        rich_loadfile($this->self, $file);
    }

    public function saveToFile($file)
    {

        $file = replaceSr($file);
        rich_savetofile($this->self, $file);
    }

    public function get_RTFText()
    {
        return rich_text($this->self, null);
    }

    public function set_RTFText($v)
    {
        rich_text($this->self, $v);
    }

    public function set_fontName($v)
    {
        $this->param('name', $v);
    }

    public function param($name, $value = null)
    {

        return rich_command($this->self, (string)$name, $value);
    }

    public function get_fontName()
    {
        return $this->param('name');
    }

    public function set_fontSize($v)
    {
        $this->param('size', $v);
    }

    public function get_fontSize()
    {
        return $this->param('size');
    }

    public function set_fontColor($v)
    {
        $this->param('color', $v);
    }

    public function get_fontColor()
    {
        return $this->param('color');
    }

    public function set_fontCharset($v)
    {
        $this->param('charset', $v);
    }

    public function get_fontCharset()
    {
        return $this->param('charset');
    }

    public function set_bold($v)
    {
        $this->param('bold', (bool)$v);
    }

    public function get_bold()
    {
        return $this->param('bold');
    }

    public function set_italic($v)
    {
        $this->param('italic', (bool)$v);
    }

    public function get_italic()
    {
        return $this->param('italic');
    }

    public function set_strikeout($v)
    {
        $this->param('strikeout', (bool)$v);
    }

    public function get_strikeout()
    {
        return $this->param('strikeout');
    }

    public function set_underline($v)
    {
        $this->param('underline', (bool)$v);
    }

    public function get_underline()
    {
        return $this->param('underline');
    }

}