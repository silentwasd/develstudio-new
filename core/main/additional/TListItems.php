<?


class TListItems extends TControl
{

    public $class_name = __CLASS__;

    function delete($index)
    {
        listitems_command($this->self, __FUNCTION__, $index, 0);
    }

    function add()
    {
        return _c(listitems_command($this->self, __FUNCTION__, 0, 0));
    }

    function clear()
    {
        listitems_command($this->self, __FUNCTION__, 0, 0);
    }

    function addItem($item, $index)
    {
        return _c(listitems_command($this->self, __FUNCTION__, $item->self, $index));
    }

    function indexOf($item)
    {
        return listitems_command($this->self, __FUNCTION__, $item->self, 0);
    }

    function insert($index)
    {
        return _c(listitems_command($this->self, __FUNCTION__, $index, 0));
    }

    function get_selected()
    {

        $result = array();
        $arr = explode(',', listitems_command($this->self, 'selected', 0, 0));

        foreach ($arr as $el) if ($el != '')
            $result[] = $el;

        return $result;
    }

    function set_selected($var)
    {

        foreach ($var as $k => $v)
            listitems_selected($this->self, $k, $v);
    }

    function selectAll()
    {
        $c = $this->count();
        for ($i = 0; $i < $c - 1; $i++)
            $this->select($i);
    }

    function count()
    {
        return listitems_command($this->self, __FUNCTION__, 0, 0);
    }

    function select($index)
    {
        listitems_selected($this->self, $index, true);
    }

    function get_selectedCaption()
    {

        $arr = $this->selected;
        $result = array();
        foreach ($arr as $id) {

            $result[] = $this->get($id)->caption;
        }
        return $result;
    }

    function get($index)
    {
        return _c(listitems_command($this->self, __FUNCTION__, $index, 0));
    }

    function set_selectedCaption($caption)
    {
        $this->selectByCaption($caption);
    }

    function selectByCaption($caption)
    {

        if (is_array($caption)) {
            $this->unSelectAll();
            if (count($caption)) {
                foreach ($caption as $el) {
                    $index = $this->indexByCaption($el);
                    if ($index > -1)
                        $this->select($index);
                }
            }
        } else {
            $index = $this->indexByCaption($caption);
            $this->unSelectAll();
            if ($index > -1)
                $this->select($index);
        }
    }

    function unSelectAll()
    {
        $c = $this->count();
        for ($i = 0; $i < $c - 1; $i++)
            $this->unSelect($i);
    }

    function unSelect($index)
    {
        listitems_selected($this->self, $index, false);
    }

    function indexByCaption($caption)
    {

        $c = $this->count();
        $caption = strtolower($caption);

        for ($i = 0; $i < $c; $i++) {

            $item = $this->get($i);
            if (strtolower($item->caption) == $caption)
                return $i;
        }

        return -1;
    }
}