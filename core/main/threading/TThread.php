<?


class TThread
{

    //static $_criticals;
    static $pool;
    public $self;

    public function __construct($func_name = false, $self = false)
    {

        if (!$self) {
            $this->self = gui_threadCreate();
        } else
            $this->self = (int)$self;

        if ($func_name)
            $this->set_onExecute($func_name);
    }

    public function set_onExecute($func)
    {

        if ($this->self && is_callable($func) && is_string($func))
            event_set($this->self, 'onExecute', $func);
    }

    static function checkPool()
    {

        if (sizeof(self::$pool) < 1) return;

        $can = thread_max() - thread_count() - 2;
        reset(self::$pool);

        for ($i = 0; $i < $can; $i++) {

            $item = current(self::$pool);

            $th = new TThread($item[0]);
            $callback = $item[1];
            if ($callback)
                $callback($th);
            else
                $th->resume();

            self::$pool[key(self::$pool)] = null;
            next(self::$pool);
        }

        foreach (self::$pool as $key => $item) {
            if ($item == null)
                unset(self::$pool[$key]);
            else
                break;
        }
    }

    public function resume()
    {
        if ($this->self)
            return gui_threadResume($this->self);
    }

    static function __syncFull($self, $addData)
    {

        $th = TThread::get($self);
        $args = igbinary_unserialize($addData);
        $callback = $args['___callback'];
        unset($args['___callback']);
        $th->result = call_user_func_array($callback, $args);
    }

    static function get($self)
    {

        return new TThread(false, $self);
    }

    static function __init()
    {
        errors_init();
        if (class_exists('DS_Loader'))
            DS_Loader::InitLoader(true);
    }

    public function set_importClasses($val)
    {
        gui_propSet($this->self, 'importClasses', (bool)$val);
    }

    /*
    public function get_importGlobals($val){
        return gui_propGet($this->self, 'importGlobals');
    }*/

    public function set_importGlobals($val)
    {
        gui_propSet($this->self, 'importGlobals', (bool)$val);
    }

    public function set_importConstants($val)
    {
        gui_propSet($this->self, 'importConstants', (bool)$val);
    }

    public function get_importClasses($val)
    {
        return gui_propGet($this->self, 'importClasses');
    }

    public function get_importConstants($val)
    {
        return gui_propGet($this->self, 'importConstants');
    }

    public function get_priority()
    {
        return gui_threadPriority($this->self);
    }

    public function set_priority($v)
    {
        return gui_threadPriority($this->self, $v);
    }

    public function suspend()
    {
        if ($this->self)
            return gui_threadSuspend($this->self);
    }

    public function terminate()
    {

        if ($this->self) {
            gui_threadTerminate($this->self);
            $this->self = false;
        }
    }

    public function syncFull($func, $args)
    {

        if ($this->self && is_string($func)) {

            //$this->callback = $func;
            $args = array_values($args);
            $args['___callback'] = $func;

            $this->sync('TThread::__syncFull', igbinary_serialize($args));
            return $this->result;
        }
    }

    public function sync($func, $addData = '')
    {

        if ($this->self && is_string($func))
            gui_threadSync($this->self, $func, $addData);
    }

    public function synchronize($func)
    {
        $this->sync($func);
    }

    public function free()
    {

        gui_threadFree($this->self);
        $this->self = false;
    }

    public function __get($name)
    {

        if (method_exists($this, 'get_' . $name))
            return call_user_func(array($this, 'get_' . $name));

        $result = igbinary_unserialize(gui_threadData($this->self, $name));
        return $result;
    }

    public function __set($name, $value)
    {

        if (method_exists($this, 'set_' . $name))
            return call_user_func(array($this, 'set_' . $name), $value);

        gui_threadData($this->self, $name, igbinary_serialize($value));
    }

    public function __isset($name)
    {

        return gui_threadDataIsset($this->self, $name);
    }

    // call when run thread

    public function __unset($name)
    {

        gui_threadDataUnset($this->self, $name);
    }
}