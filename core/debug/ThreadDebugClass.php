<?


class ThreadDebugClass extends DebugClass
{

    public function __get($name)
    {
        trigger_error(t('Change the GUI in the thread forbidden - GET "%s"->"%s"', $this->nameParam, $name), E_USER_ERROR);
    }

    public function __set($name, $value)
    {
        trigger_error(t('Change the GUI in the thread forbidden - SET "%s"->"%s" = ...', $this->nameParam, $name), E_USER_ERROR);
    }

    public function __call($name, $args)
    {
        trigger_error(t('Change the GUI in the thread forbidden - CALL "%s"->"%s()"', $this->nameParam, $name), E_USER_ERROR);
    }
}