<?


class TEdit extends TControl
{
    public $class_name = __CLASS__;

    function set_passwordChar($v)
    {

        $this->set_prop('passwordChar', ord($v));
    }

    function get_passwordChar()
    {
        return chr($this->get_prop('passwordChar'));
    }

    function get_selText()
    {
        return edit_seltext($this->self, null);
    }

    function set_selText($v)
    {
        edit_seltext($this->self, (string)$v);
    }

    function get_selStart()
    {
        return edit_selstart($this->self, null);
    }

    function set_selStart($v)
    {
        edit_selstart($this->self, (int)$v);
    }

    function get_selLength()
    {
        return edit_sellength($this->self, null);
    }

    function set_selLength($v)
    {
        edit_sellength($this->self, (int)$v);
    }

    function selectAll()
    {
        edit_selectall($this->self);
    }

    function select($start, $length)
    {
        edit_selstart($this->self, (int)$start);
        edit_sellength($this->self, (int)$length);
    }

    public function undo()
    {
        edit_undo($this->self);
    }

    public function copyToClipboard()
    {
        edit_copytoclipboard($this->self);
    }

    public function cutToClipboard()
    {
        edit_cuttoclipboard($this->self);
    }

    public function pasteFromClipboard()
    {
        edit_pastefromclipboard($this->self);
    }

    public function clearSelection()
    {
        $this->clearSelected();
    }

    public function clearSelected()
    {
        edit_clearselection($this->self);
    }

}