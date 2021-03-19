<?


/**
 * General class TObject from Delphi
 * @property-read string $className
 */
class TObject extends _Object
{
    /** @var int Идентификатор. */
    public $self;

    function __construct()
    {
        $this->self = component_create(__CLASS__, nil);
    }

    /**
     * Проверить объект на принадлежность классу/массиву классов.
     * @param string|string[] $class Класс или массив классов.
     * @return bool Если объект принадлежит классу/массиву классов, возвращается true, иначе false.
     */
    public function isClass($class)
    {
        if (is_array($class))
            return $this->checkClassInArray($class);

        return strtolower($class) == strtolower($this->className);
    }

    /**
     * Безопасно удалить объект.
     */
    public function safeFree()
    {
        $this->animateFree();
        gui_safeDestroy($this->self);
    }

    /**
     * Удалить объект.
     */
    public function destroy()
    {
        $this->free();
    }

    /**
     * Удалить объект.
     */
    public function free()
    {
        $this->animateFree();
        gui_destroy($this->self);
    }

    /**
     * Проверить объект на принадлежность классу из массива.
     * @param array $classes Массив классов.
     * @return bool Если объект принадлежит хотя-бы одному классу из массива возвращается true, иначе false.
     */
    protected function checkClassInArray(array $classes)
    {
        $s_class = strtolower($this->className);

        foreach ($classes as $el) {
            if (strtolower($el) == $s_class)
                return true;
        }

        return false;
    }

    /**
     * Получить название класса.
     * @return string
     */
    protected function get_className()
    {
        return rtii_class($this->self);
    }

    /**
     * Удалить объект по-особому, если это объект класса "animate".
     */
    protected function animateFree()
    {
        if (class_exists('animate'))
            animate::objectFree($this->self);
    }
}