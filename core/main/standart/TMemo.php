<?


class TMemo extends TControl
{
    public $class_name = __CLASS__;
    protected $_items;

    function get_items()
    {
        if (!isset($this->_items)) {
            $this->_items = new TStrings(false);
            $this->_items->self = __rtii_link($this->self, 'Lines');
        }
        return $this->_items;
    }

    function get_lines()
    {
        return $this->items;
    }

    function set_lines(object $strings)
    {
        $this->items->assign($strings);
    }

    function set_text($v)
    {
        $this->items->text = $v;
    }

    function get_text()
    {
        return $this->items->text;
    }

    function loadFromFile($fileName)
    {
        $fileName = getFileName($fileName);
        $this->items->loadFromFile($fileName);
    }

    function saveToFile($fileName)
    {
        $fileName = getFileName($fileName);
        $this->items->saveToFile($fileName);
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

    public function redo()
    {
        edit_redo($this->self);
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