<?


/* TApplication класс ... */

class TApplication extends TControl
{

    static function doTerminate()
    {

        foreach ((array)$GLOBALS['__TApplication_doTerminate'] as $func) {
            eval($func);
        }
    }

    static function addTermFunc($code)
    {
        $GLOBALS['__TApplication_doTerminate'][] = $code . ';';
    }

    function terminate()
    {
        application_terminate();
    }

    function minimize()
    {
        application_minimize();
    }

    function processMessages()
    {
        application_processmessages();
    }

    function restore()
    {
        application_restore();
    }

    function findComponent($name)
    {
        $id = application_find_component($name);
        return to_object($id, __rtii_class($id));
    }

    function messageBox($text, $caption, $flag = 1)
    {
        return application_messagebox($text, $caption, $flag);
    }

    function set_title($title)
    {
        application_set_title($title);
    }

    function get_title()
    {
        return application_prop('title', null);
    }

    function get_active()
    {
        return application_prop('active', null);
    }

    function get_handle()
    {
        return application_prop('handle', null);
    }

    function set_showMainForm($v)
    {
        application_prop('showMainForm', $v);
    }

    function get_showMainForm()
    {
        return application_prop('showMainForm', null);
    }

    function set_mainFormOnTaskBar($v)
    {
        application_prop('mainformontaskbar', $v);
    }

    function get_mainFormOnTaskBar()
    {
        return application_prop('mainformontaskbar', null);
    }

    function toFront()
    {
        application_tofront();
    }
}