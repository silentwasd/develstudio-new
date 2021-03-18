<?


/*
 * FFI
 */

class DynLib
{

    public $libpath = '';
    public $functions = array();
    public $ffi;

    public function __construct($libpath)
    {
        $this->libpath = $libpath;
    }

    public function func($line)
    {

        if (func_num_args() > 1) {
            foreach (func_get_args() as $value)
                $this->func($value);
        } else
            $this->functions[] = DynLib::typeFix($line);
    }

    static function typeFix($type)
    {

        $arr = array(
            'bool ' => 'sint8 ',
            'DWORD ' => 'uint32 ',
            'byte ' => 'sint8 ',
            'integer ' => 'int ',
            'string ' => 'char *',
            'uint ' => 'uint32 ',
            'cardinal ' => 'uint32 ',
            'boolean ' => 'sint8 ',
            'short ' => 'sint8 ',
            'LPSTR ' => 'char *',
            'LPCSTR ' => 'char *',
            'LPCTSTR ' => 'char *',
            'LCID ' => 'uint32 ',
            'HWND ' => 'int '
        );

        return str_ireplace(array_keys($arr), array_values($arr), $type);
    }

    public function reg()
    {

        $lib = '';
        foreach ($this->functions as $line) {
            $lib .= '[lib=\'user32.dll\'] ' . $line . ";\n";
        }

        $ffi = new FFI($lib);
        $this->ffi = $ffi;
        return $ffi;
    }

    public function __call($name, $args)
    {

        return call_user_func_array(array($this->ffi, $name), $args);
    }
}