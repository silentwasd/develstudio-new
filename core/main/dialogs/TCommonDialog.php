<?


class TCommonDialog extends TControl
{

    public $class_name = __CLASS__;

    #public onSelect

    function close()
    {
        $this->closeDialog();
    }

    function closeDialog()
    {
        dialog_close($this->self);
    }

    function showModal()
    {
        return $this->execute();
    }

    function execute()
    {
        $res = dialog_execute($this->self);

        /*if ($res && $this->onSelectDialog){
            eval($this->onSelectDialog . '('.$this->self.',\''. addslashes($this->filename) .'\');');
        }*/
        return $res;
    }

    function show()
    {
        return $this->execute();
    }

    function get_files()
    {

        $tmp = (array)explode(_BR_, dialog_items($this->self));
        foreach ($tmp as $el)
            if ($el)
                $result[] = replaceSl($el);

        return $result;
    }

    function setOption($name, $value = true, $ex = false)
    {

        $options = array();
        if ($ex)
            $tmp = explode(',', $this->optionsEx);
        else {
            $tmp = explode(',', $this->options);
        }

        foreach ($tmp as $el)
            if ($el)
                $options[] = trim($el);


        $k = array_search($name, (array)$options);

        if (!$value) {
            if ($k !== false)
                unset($options[$k]);
        } else {
            if ($k === false)
                $options[] = $name;
        }

        if ($ex) {
            $this->optionsEx = implode(',', (array)$options);
        } else
            $this->options = implode(',', (array)$options);
    }

    function getOption($name, $ex = false)
    {

        if ($ex)
            if (stripos($this->optionsEx, $name) !== false)
                return true;
        if (!$ex)
            if (stripos($this->options, $name) !== false)
                return true;

        return false;
    }

}