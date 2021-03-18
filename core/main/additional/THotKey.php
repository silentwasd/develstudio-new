<?


class THotKey extends TControl
{
    public $class_name = __CLASS__;

    public function set_hotKey($sc)
    {

        if (!is_numeric($sc))
            $sc = text_to_shortcut(strtoupper($sc));
        $this->set_prop('hotKey', $sc);
    }

    public function get_hotKey()
    {

        $result = $this->get_prop('hotKey');
        return shortCut_to_text($result);
    }
}