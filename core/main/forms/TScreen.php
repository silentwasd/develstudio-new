<?


/* TScreen класс... */

class TScreen extends TComponent
{

    public $class_name = __CLASS__;

    function get_activeForm()
    {

        return _c(screen_form_active());
    }

    function get_forms()
    {
        return $this->formList();
    }

    function formList()
    {
        $forms = array();
        $count = $this->get_formcount();

        for ($i = 0; $i < $count; $i++) {
            $forms[] = asTForm($this->formById($i));
        }

        return $forms;
    }

    function get_formcount()
    {
        return screen_form_count();
    }

    function formById($id)
    {
        return screen_form_by_id($id);
    }
}