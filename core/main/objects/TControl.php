<?


/**
 * TControl is visual component
 * @property object|null $parent Объект-родитель.
 * @property int $owner Идентификатор владельца.
 * @property-read int $componentIndex Индекс компонента.
 * @property-read TComponent[] $componentList Список компонентов.
 * @property-read TControl[] $controlList Список управляемых компонентов.
 * @property-read int[] $componentLinks Список ссылок на компоненты.
 * @property-read int $handle Идентификатор обработчика.
 * @property-read TFont $font Шрифт.
 * @property string $fontName Название шрифта.
 * @property int $fontSize Размер шрифта.
 * @property int $fontColor Цвет шрифта.
 * @property bool $doubleBuffer Двойная буферизация.
 * @property-read bool $focused Установлен ли фокус на объекте.
 * @property string $text Текст.
 * @property-write TPopupMenu $popupMenu Всплывающее меню.
 * @property-read int $dockOrientation
 * @property-read array $dockList
 * @property-read int $dockClientCount
 * @property-read TControlCanvas|null $canvas Холст.
 * @property-read string $hint Подсказка.
 */
class TControl extends TComponent
{
    public $class_name = __CLASS__;
    protected $_font;

    function __construct($owner = nil, $init = true, $self = nil)
    {
        parent::__construct($owner, $init);

        if ($self != nil) $this->self = $self;
        if ($init) {
            $this->avisible = $this->visible;
            $this->aenabled = $this->enabled;
        }

        $this->__setAllPropEx($init);
    }

    function get_font()
    {
        if (!isset($this->_font)) {
            $this->_font = new TFont;
            $this->_font->self = $this->self;
        }

        return $this->_font;
    }

    function set_parent($obj)
    {
        if (is_object($obj))
            cntr_parent($this->self, $obj->self);
        elseif (is_numeric($obj))
            cntr_parent($this->self, $obj);
    }

    function get_parent()
    {
        return _c(cntr_parent($this->self, null));
    }

    function parentComponents()
    {
        $result = array();
        $components = $this->controlList;

        foreach ($components as $el) {

            if ($el) {
                $result[] = $el;
                $result = array_merge($result, $el->parentComponents());
            }
        }

        return $result;
    }

    // возвращает список всех компонентов объекта по паренту, а не owner'y
    function childComponents($recursive = true)
    {
        $result = array();
        $owner = c($this->get_owner());
        $links = $owner->get_componentLinks();

        foreach ($links as $link) {

            if (cntr_parent($link, null) == $this->self) {
                $el = c($link);
                $result[] = $el;
                if ($recursive)
                    $result = array_merge($result, $el->childComponents());
            }
        }

        return $result;
    }

    function get_owner()
    {
        return get_owner($this);
    }

    function set_visible($v)
    {
        $this->avisible = $v;
        $this->set_prop('visible', $v);
    }

    function setx_avisible($v)
    {
        //
    }

    function findComponent($name, $type = 'TControl')
    {
        $id = find_component($this->self, $name);

        return _c($id);
    }

    function get_componentIndex()
    {
        return component_index($this->self);
    }

    /**
     * @deprecated Функция control_index() не существует.
     * @return mixed
     */
    function get_controlIndex()
    {
        return control_index($this->self);
    }

    function get_componentList()
    {
        $res = array();
        $count = $this->componentCount();

        for ($i = 0; $i < $count; $i++) {
            $res[] = $this->componentById($i);
        }

        return $res;
    }

    function componentCount()
    {
        return component_count($this->self);
    }

    function componentById($id, $type = 'TControl')
    {
        return _c(component_by_id($this->self, $id));
    }

    function get_controlList()
    {
        $res = array();
        $count = $this->controlCount();
        for ($i = 0; $i < $count; $i++) {
            $res[] = $this->controlById($i);
        }

        return $res;
    }

    function controlCount()
    {
        return control_count($this->self);
    }

    function controlById($id)
    {
        return _c(control_by_id($this->self, $id));
    }

    function get_componentLinks()
    {

        $res = array();
        $count = $this->componentCount();
        for ($i = 0; $i < $count; $i++) {

            $res[] = component_by_id($this->self, $i);
        }

        return $res;
    }

    function show()
    {
        $this->visible = true;
    }

    function hide()
    {
        $this->visible = false;
    }

    function get_handle()
    {
        return gui_getHandle($this->self);
    }

    function get_fontsize()
    {
        return $this->font->size;
    }

    function set_fontsize($v)
    {
        $this->font->size = $v;
    }

    function get_fontname()
    {
        return $this->font->name;
    }

    function set_fontname($v)
    {
        $this->font->name = $v;
    }

    function get_fontcolor()
    {
        return $this->font->color;
    }

    function set_fontcolor($v)
    {
        $this->font->color = $v;
    }

    function setDate()
    {
        if ($this->exists_prop('caption'))
            $this->caption = date('Y.m.d');
        elseif ($this->exists_prop('text'))
            $this->text = date('Y.m.d');
    }

    function setTime()
    {
        if ($this->exists_prop('caption'))
            $this->caption = date('H:i:s');
        elseif ($this->exists_prop('text'))
            $this->text = date('H:i:s');
    }

    function repaint()
    {
        gui_repaint($this->self);
    }

    function toBack()
    {
        gui_toBack($this->self);
    }

    function toFront()
    {
        gui_toFront($this->self);
    }

    function set_doubleBuffer($v)
    {
        gui_doubleBuffer($this->self, $v);
    }

    function get_doubleBuffer()
    {
        return gui_doubleBuffer($this->self);
    }

    function set_doubleBuffered($v)
    {
        gui_doubleBuffer($this->self, $v);
    }

    function get_doubleBuffered()
    {
        return gui_doubleBuffer($this->self);
    }

    function setFocus()
    {
        if ($this->visible && $this->enabled)
            gui_setFocus($this->self);
    }

    function get_focused()
    {
        return gui_isFocused($this->self);
    }

    function set_text($v)
    {
        if ($this->exists_prop('text')) {
            $this->set_prop('text', $v);
        } elseif ($this->exists_prop('caption'))
            $this->caption = $v;
        elseif ($this->exists_prop('itemstext'))
            $this->itemsText = $v;
    }

    function get_text()
    {
        if ($this->exists_prop('text'))
            return $this->get_prop('text');
        elseif ($this->exists_prop('caption'))
            return $this->caption;
        elseif ($this->exists_prop('itemstext'))
            return $this->itemsText;
    }

    function set_popupMenu($menu)
    {
        popup_set($menu->self, $this->self);
    }

    function perform($msg, $hparam, $lparam)
    {
        return control_perform($this->self, $msg, $hparam, $lparam);
    }

    function invalidate()
    {
        control_invalidate($this->self);
    }

    function manualDock($obj, $align = 0)
    {
        return control_manualDock($this->self, $obj->self, $align);
    }

    function manualFloat($left, $top, $right, $bottom)
    {
        return control_manualFloat($this->self, $left, $top, $right, $bottom);
    }

    function dock($obj, $left, $top, $right, $bottom)
    {
        control_dock($this->self, $obj->self, $left, $top, $right, $bottom);
    }

    function get_dockOrientation()
    {
        return control_dockOrientation($this->self);
    }

    function dockSaveToFile($file)
    {
        control_docksave($this->self, $file);
    }

    function dockLoadFromFile($file)
    {
        control_dockload($this->self, $file);
    }

    function get_dockList()
    {
        $result = array();
        $c = $this->get_dockClientCount();

        for ($i = 0; $i < $c; $i++)
            $result[] = $this->dockClient($i);

        return $result;
    }

    function get_dockClientCount()
    {
        return control_dockClientCount($this->self);
    }

    function dockClient($index)
    {
        return _c(control_dockClient($this->self, $index));
    }

    function get_canvas()
    {
        return _c(component_canvas($this->self));
    }

    function set_hint($hint)
    {
        $this->showHint = (bool)$hint;
        $this->set_prop('hint', (string)$hint);
    }
}