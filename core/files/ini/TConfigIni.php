<?


class TConfigIni extends TConfig
{

    public $class_name = __CLASS__;
    public $ini;

    protected $_result;


    public function __construct(array $data = array())
    {

        parent::__construct($data);
        $this->ini = new TIniFile;
        //$this->ini->values =& $this->_data;
    }

    function saveToFile($filename)
    {
        $this->ini->values = $this->toArray();
        $this->ini->saveToFile($filename);
    }

    function loadFromFile($filename)
    {

        $arr2 = $this->toArray();
        $arr = (array)$this->ini->loadFromFile($filename);

        foreach ($arr as $k => $v) {
            if (is_array($v))
                foreach ($v as $key => $value)
                    $arr2[$k][$key] = $value;
        }

        $this->setArray($arr2);
    }
}