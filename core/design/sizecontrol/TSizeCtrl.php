<?


class TSizeCtrl extends TControl
{

    public $class_name = __CLASS__;
    public $targets = array();

    //public $targets_ex = array();

    public function set_enable($b)
    {
        sizectrl_enable($this->self, $b);
    }

    public function get_enable()
    {
        return sizectrl_enable($this->self, null);
    }

    public function set_popupMenu($menu)
    {

        popup_set($menu->self, $this->self);
    }

    public function indexOf($target)
    {
        $result = 0;
        $self = $target->self;
        $c = count($this->targets);
        for ($i = 0; $i < $c; $i++) {

            if ($this->targets[$i]->self == $self)
                return $i;
        }

        return -1;

        foreach ($this->targets as $obj) {
            if ($obj->self == $target->self)
                return $result;

            $result++;
        }
        return -1;
    }

    public function addTarget($target, $init = true)
    {

        //$this->targets_ex[$target->self] = $target;

        // if ($this->indexOf($target)>-1) return -1;

        $this->targets[] = $target;

        if ($init)
            return sizectrl_add_target($this->self, $target->self);
    }

    public function deleteTarget($target)
    {
        /*$id = $this->indexOf($target);
        if ($id > -1){
            //unset($this->targets_ex[$target->self]);
            unset($this->targets[$id]);
        }
        else return;
        */
        sizectrl_delete_target($this->self, $target->self);
    }

    public function unRegisterTarget($target)
    {


        //unset($this->targets_ex[$target->self]);
        sizectrl_unregister($this->self, $target->self);
    }

    public function registerTarget($target)
    {

        sizectrl_register($this->self, $target->self);
    }

    public function clearTargets()
    {

        sizectrl_clear_targets($this->self);
        $this->targets = array();
        //$this->targets_ex = array();
    }

    public function unRegisterAll()
    {
        sizectrl_unregister_all($this->self);
        $this->targets = array();
        //$this->targets_ex = array();
    }

    public function update()
    {
        sizectrl_update($this->self);
        $this->targets_ex = array();
    }

    public function updateBtns()
    {
        sizectrl_updateBtns($this->self);
    }

    public function get_targets_ex()
    {

        $result = array();
        $tmp = $this->getSelected();
        foreach ($tmp as $link)
            $result[$link] = _c($link);

        return $result;
    }

    public function getSelected()
    {

        return sizectrl_selected($this->self);
    }

    public function set_onSizeMouseDown($value)
    {
        $this->onMouseDown = $value;
    }

}