<?


/**
 * General class TObject from Delphi
 * @property-read string $className
 */
class TObject extends _Object
{
    /** @var int �������������. */
    public $self;

    function __construct()
    {
        $this->self = component_create(__CLASS__, nil);
    }

    /**
     * ��������� ������ �� �������������� ������/������� �������.
     * @param string|string[] $class ����� ��� ������ �������.
     * @return bool ���� ������ ����������� ������/������� �������, ������������ true, ����� false.
     */
    public function isClass($class)
    {
        if (is_array($class))
            return $this->checkClassInArray($class);

        return strtolower($class) == strtolower($this->className);
    }

    /**
     * ��������� ������� ������.
     */
    public function safeFree()
    {
        $this->animateFree();
        gui_safeDestroy($this->self);
    }

    /**
     * ������� ������.
     */
    public function destroy()
    {
        $this->free();
    }

    /**
     * ������� ������.
     */
    public function free()
    {
        $this->animateFree();
        gui_destroy($this->self);
    }

    /**
     * ��������� ������ �� �������������� ������ �� �������.
     * @param array $classes ������ �������.
     * @return bool ���� ������ ����������� ����-�� ������ ������ �� ������� ������������ true, ����� false.
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
     * �������� �������� ������.
     * @return string
     */
    protected function get_className()
    {
        return rtii_class($this->self);
    }

    /**
     * ������� ������ ��-�������, ���� ��� ������ ������ "animate".
     */
    protected function animateFree()
    {
        if (class_exists('animate'))
            animate::objectFree($this->self);
    }
}