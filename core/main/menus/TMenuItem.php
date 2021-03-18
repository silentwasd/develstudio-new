<?


class TMenuItem extends TControl
{
    public $class_name = __CLASS__;
    public $picture;

    public function __construct($onwer = nil, $init = true, $self = nil)
    {
        parent::__construct($onwer, $init, $self);
        $this->picture = new TBitmap(false);
        $this->picture->self = __rtii_link($this->self, 'Bitmap');

        $this->picture->parent_object = $this->self;
    }

    public function loadPicture($file)
    {

        $this->picture->loadAnyFile($file);
    }


    function set_visible($v)
    {
        $this->set_prop('visible', (bool)$v);
    }

    function get_visible()
    {

        return $this->get_prop('visible');
    }

    function set_enabled($v)
    {
        $this->set_prop('enabled', (bool)$v);
    }

    function get_enabled()
    {

        return $this->get_prop('enabled');
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

    public function addItem(TMenuItem $item)
    {

        popup_additemex($this->self, $item->self);
    }

    public function clear()
    {
        menuitem_clear($this->self);
    }

    public function delete($index)
    {
        menuitem_delete($this->self, $index);
    }

    public function insertAfter(TMenuItem $after, TMenuItem $item)
    {

        $index = $this->indexOf($after);

        if ($index >= 0) {
            $this->insert($index + 1, $item);
        }
    }

    public function indexOf(TMenuItem $item)
    {

        return menu_indexOf($this->self, $item->self);
    }

    public function insert($index, TMenuItem $item)
    {
        menu_insert($this->self, (int)$index, $item->self);
    }

    public function insertBefore(TMenuItem $after, TMenuItem $item)
    {

        $index = $this->indexOf($after);

        if ($index >= 0)
            $this->insert($index, $item);
    }

    public function find($caption)
    {
        return _c(menu_find($this->self, (string)$caption));
    }

    public function get_index()
    {
        return menu_index($this->self);
    }

    public function get_parent()
    {

        return _c(menu_parent($this->self));
    }
}