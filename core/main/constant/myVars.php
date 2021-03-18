<?


class myVars
{

    static function set($var, $name)
    {

        $GLOBALS[$name] = $var;
    }

    static function set2(&$var, $name)
    {
        $GLOBALS[$name] =& $var;
    }

    static function get($name)
    {

        if (isset($GLOBALS[$name]))
            return $GLOBALS[$name];
        else
            return false;
    }
}