<?


class TTreeNode extends TControl
{

    public $class_name = __CLASS__;

    public function get_absIndex()
    {
        return tree_absIndex($this->self);
    }
}