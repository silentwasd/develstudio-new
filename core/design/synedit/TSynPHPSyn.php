<?


#attr: Comment, Identifier, Key, Number, Space, String, Symbol, Variable
class TSynPHPSyn extends TSynCustomHighlighter
{
    static $prefixs = array('Comment', 'Identifier', 'Key', 'Number', 'Space', 'String', 'Symbol', 'Variable');
    public $class_name = __CLASS__;

    function saveToArray(&$arr)
    {

        foreach (self::$prefixs as $prefix)
            $this->saveAttr($prefix, $arr);
    }

    function saveAttr($prefix, &$arr)
    {

        $attr = $this->getAttri($prefix);
        $arr[$prefix]['background'] = $attr->background;
        $arr[$prefix]['foreground'] = $attr->foreground;
        $arr[$prefix]['style'] = $attr->style;
    }

    function loadFromArray($arr)
    {

        foreach (self::$prefixs as $prefix) {
            $attr = $this->getAttri($prefix);
            if (isset($arr[$prefix])) {
                $attr->background = $arr[$prefix]['background'];
                $attr->foreground = $arr[$prefix]['foreground'];
                $attr->style = $arr[$prefix]['style'];
            }
        }
    }
}