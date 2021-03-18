<?


/**
 * General class TObject from Delphi
 * @property-read string $className
 */
class TObject extends _Object
{
    /** @var int Идентификатор. */
    public $self;

    function __construct($init = true)
    {
        $this->self = component_create(__CLASS__, nil);
    }

    function get_className()
    {
        return rtii_class($this->self);
    }

    function isClass($class)
    {
        if (is_array($class)) {
            $s_class = strtolower($this->className);
            foreach ($class as $el)
                if (strtolower($el) == $s_class)
                    return true;
            return false;
        } else {
            $class = strtolower($class);
            return $class == strtolower($this->className);
        }
    }

    function safeFree()
    {
        if (class_exists('animate'))
            animate::objectFree($this->self);

        gui_safeDestroy($this->self);
    }

    function destroy()
    {
        $this->free();
    }

    function free()
    {
        if (class_exists('animate'))
            animate::objectFree($this->self);

        gui_destroy($this->self);
        //obj_free($this->self);
    }
}