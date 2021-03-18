<?


class TTreeView extends TControl
{

    public $class_name = __CLASS__;

    public function get_text()
    {

        return tree_gettext($this->self);
    }

    public function set_text($v)
    {
        $this->loadFromStr($v);
    }

    public function loadFromStr($str)
    {

        tree_loadstr($this->self, $str);
    }

    public function get_itemSelected()
    {

        $arr = explode(_BR_, $this->text);
        return trim($arr[$this->absIndex]);
    }

    public function set_itemSelected($v)
    {

        $this->absIndex = -1;
        $v = strtolower($v);
        $arr = explode(_BR_, $this->text);
        foreach ($arr as $i => $text) {
            $text = strtolower(trim($text));
            if ($v == $text) {
                $this->absIndex = $i;
            }
        }
    }

    public function get_selected()
    {

        $res = tree_selected($this->self);
        if ($res === null) {
            return null;
        } else
            return _c($res);
    }

    public function set_selected($v)
    {

        tree_select($this->self, $v->self);
    }

    public function get_absIndex()
    {
        $sel = $this->selected;
        if ($sel)
            return $sel->absIndex;
        else
            return -1;
    }

    public function set_absIndex($v)
    {
        return tree_setAbsIndex($this->self, (int)$v);
    }

    public function fullExpand()
    {
        tree_fullExpand($this->self);
    }

    public function fullCollapse()
    {
        tree_fullCollapse($this->self);
    }
}