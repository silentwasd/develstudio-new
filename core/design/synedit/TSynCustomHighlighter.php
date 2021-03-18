<?

class TSynCustomHighlighter extends TControl
{

    public $class_name = __CLASS__;
    #enabled
    #DefaultFilter

    // ->getAttri('Comment')->background = clGray;
    function getAttri($prefix = 'Comment')
    {

        $prop = $prefix . 'Attri';

        $result = new TSynHighlighterAttributes(nil, false);
        $result->self = gui_propGet($this->self, $prop);
        return $result;
    }
}