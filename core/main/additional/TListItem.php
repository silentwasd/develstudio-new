<?


class TListItem extends TControl
{

    public $class_name = __CLASS__;

    function delete()
    {
        listitem_command($this->self, __FUNCTION__);
    }

    function update()
    {
        listitem_command($this->self, __FUNCTION__);
    }

    function canceledit()
    {
        listitem_command($this->self, __FUNCTION__);
    }

    function editcaption()
    {
        return listitem_command($this->self, __FUNCTION__);
    }

    function get_index()
    {
        return listitem_prop($this->self, __FUNCTION__, null);
    }

    function get_selected()
    {
        return listitem_prop($this->self, __FUNCTION__, null);
    }

    function get_imageindex()
    {
        return listitem_prop($this->self, __FUNCTION__, null);
    }

    function get_stateindex()
    {
        return listitem_prop($this->self, __FUNCTION__, null);
    }

    function get_indent()
    {
        return listitem_prop($this->self, __FUNCTION__, null);
    }

    function get_caption()
    {
        return listitem_prop($this->self, __FUNCTION__, null);
    }

    function get_checked()
    {
        return listitem_prop($this->self, __FUNCTION__, null);
    }

    function set_imageindex($v)
    {
        listitem_prop($this->self, __FUNCTION__, $v);
    }

    function set_stateindex($v)
    {
        listitem_prop($this->self, __FUNCTION__, $v);
    }

    function set_indent($v)
    {
        listitem_prop($this->self, __FUNCTION__, $v);
    }

    function set_caption($v)
    {
        listitem_prop($this->self, __FUNCTION__, $v);
    }

    function set_checked($v)
    {
        listitem_prop($this->self, __FUNCTION__, $v);
    }

    function set_subItems($arr)
    {

        if (is_array($arr))
            $arr = implode(_BR_, $arr);

        listitem_prop($this->self, __FUNCTION__, $arr);
    }

    function get_subItems()
    {
        $str = listitem_prop($this->self, __FUNCTION__, null);
        return explode(_BR_, $str);
    }
}