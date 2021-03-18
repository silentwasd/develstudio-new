<?


class TRegistry
{

    public $self;

    function __construct()
    {

        $this->self = registry_create();
    }

    function __call($name, $args)
    {

        $name = strtolower(str_replace('_', '', $name));

        if (!isset($args[0])) $args[0] = '';
        if (!isset($args[1])) $args[1] = '';
        if (!isset($args[2])) $args[2] = '';

        //msg($this->self);
        //pre($args);

        return registry_command($this->self, $name, $args[0], $args[1], $args[2]);
    }

    function __destruct()
    {
        $this->free();
    }

    function free()
    {
        if ($this->self) {
            obj_free($this->self);
            $this->self = false;
        }
    }

    function writeKeyEx($root, $path, $value = '', $type = STRING)
    {

        $this->rootKey($root);
        $path = replaceSr($path);
        $key = substr($path, 0, strrpos($path, '\\') + 1);
        $p = substr($path, strrpos($path, '\\') + 1, strlen($path) - strrpos($path, '\\'));


        $p = $p == '*' ? '' : $p;

        if (!$this->openKey($key, true)) ;

        switch ($type) {

            case STRING:
                $this->writeString($p, $value);
                break;
            case BOOL  :
                $this->writeBool($p, $value);
                break;
            case DWORD :
                $this->writeFloat($p, $value);
                break;
            case DATE_TIME:
                $this->writeDate($p, $value);
                break;
            default:
                $this->writeString($p, $value);
                break;
        }
    }

    function readKeyEx($root, $path, $type = STRING)
    {

        $this->rootKey($root);
        $path = replaceSr($path);
        $key = substr($path, 0, strrpos($path, "\\") + 1);
        $p = substr($path, strrpos($path, "\\") + 1, strlen($path) - strrpos($path, '\\'));

        $p = $p == '*' ? '' : $p;

        $this->openKey($key, true);

        switch ($type) {

            case STRING:
                return $this->readString($p);
                break;
            case BOOL  :
                return $this->readBool($p);
                break;
            case DWORD :
                return $this->readFloat($p);
                break;
            case DATE_TIME:
                return $this->readDate($p);
                break;
            default:
                return $this->readString($p);
                break;
        }
    }
}