<?


class TSynEdit extends TMemo
{

    public $class_name = __CLASS__;

    function set_caretX($v)
    {
        synedit_caret_x($this->self, $v);
    }

    function get_caretX()
    {
        return synedit_caret_x($this->self, null);
    }

    function set_caretY($v)
    {
        synedit_caret_y($this->self, $v);
    }

    function get_caretY()
    {
        return synedit_caret_y($this->self, null);
    }

    function set_selStart($v)
    {
        synedit_selstart($this->self, $v);
    }

    function get_selStart()
    {
        synedit_selstart($this->self, null);
    }

    function set_selEnd($v)
    {
        synedit_selend($this->self, $v);
    }

    function get_selEnd()
    {
        synedit_selend($this->self, null);
    }

    function set_selLength($v)
    {
        $this->selEnd = $this->selStart + $v;
    }

    function get_selLength()
    {
        return $this->selEnd - $this->selStart;
    }

    public function selectAll()
    {

        $this->setFocus();
        $this->selStart = 0;
        $this->selEnd = strlen($this->text);
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

    function set_lineText($v)
    {
        $y = $this->caretY;
        $this->items->setLine($y - 1, $v);
    }

    function get_lineText()
    {
        $y = $this->caretY;
        return $this->items->getLine($y - 1);
    }

    function replaceLine($text)
    {
        $lineT = $this->lineText;
        $lastX = $this->caretX;


        $s = substr($lineT, 0, strlen($lineT) - strlen(ltrim($lineT)));
        $this->lineText = $s . $text;


        $this->caretX = $lastX;
    }

    function insertLine($text)
    {

        $lineT = $this->lineText;
        $lastX = $this->caretX;
        $lastY = $this->caretY;

        $s = substr($lineT, 0, strlen($lineT) - strlen(ltrim($lineT)));
        $this->lineText = $this->lineText . _BR_ . $s . $text;

        $this->caretX = $lastX;
        $this->caretY = $lastY;
    }

    function insertLineAfter($text)
    {

        $lineT = $this->lineText;
        $lastX = $this->caretX;
        $lastY = $this->caretY;

        $s = substr($lineT, 0, strlen($lineT) - strlen(ltrim($lineT)));
        $this->lineText = $s . $text . _BR_ . $this->lineText;

        $this->caretX = $lastX;
        $this->caretY = $lastY;
    }

    function setHighlinght(TSynCustomHighlighter $hl)
    {

        synedit_highlight($this->self, $hl->self);
    }
}