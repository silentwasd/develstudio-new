<?


class TSynCompletionProposal extends TControl
{

    public $class_name = __CLASS__;
    public $itemList; // TStrings
    public $insertList; // TStrings

    #clBackground = clWindow
    #clSelect = clHighlight
    #clSelectText = clHighlightText
    #clTitleBackground = clBtnFace

    #margin = 2
    #itemHeight = 0
    #nbLinesInWindow = 8
    #resizeable = true
    #defaultType = ctCode
    #shortCut = CTRL+SPACE
    #title = ''
    #width = 260

    function __construct($onwer = nil, $init = true, $self = nil)
    {
        parent::__construct($onwer, $init, $self);
        $this->itemList = new TStrings(false);
        $this->itemList->self = __rtii_link($this->self, 'itemList');

        $this->insertList = new TStrings(false);
        $this->insertList->self = __rtii_link($this->self, 'insertList');

        $this->__setAllPropEx();
    }

    public function setEditor(TSynEdit $editor)
    {

        syncomplete_editor($this->self, $editor->self);
    }

    public function get_visible()
    {
        return (syncomplete_visible($this->self));
    }

    public function get_insert()
    {
        return $this->insertList->get_text();
    }

    public function set_insert($text)
    {
        $this->insertList->text = $text;
    }

    public function get_item()
    {
        return $this->itemList->get_text();
    }

    public function set_item($text)
    {
        $this->itemList->text = $text;
    }

    public function set_editor(TSynEdit $editor)
    {
        syncomplete_editor($this->self, $editor->self);
    }

    public function get_editor()
    {
        return _c(syncomplete_editor($this->self, null));
    }

    public function set_shortCut($sc)
    {

        if (!is_numeric($sc))
            $sc = text_to_shortcut(strtoupper($sc));
        $this->set_prop('shortCut', $sc);
    }

    public function get_shortCut()
    {

        $result = $this->get_prop('shortCut');
        return shortCut_to_text($result);
    }

    public function active($value = true)
    {

        syncomplete_activate($this->self, (bool)$value);
    }

    public function get_hint()
    {
        return $this->insertList->text;
    }

    public function set_hint($hint)
    {
        $this->defaultType = ctParams;
        $this->insertList->text = $hint;
        $this->itemList->text = $hint;
    }

    public function get_currentString()
    {

        return syncomplete_currentString($this->self);
    }

    public function get_empty()
    {

        return syncomplete_empty($this->self);
    }
}