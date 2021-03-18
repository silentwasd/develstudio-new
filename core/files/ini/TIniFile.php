<?

class TIniFile
{

    public $values;
    protected $ini;

    function __construct($file = '', $with_kavs = false)
    {

        $this->ini = new __Ini;

        if (file_exists($file))
            $this->loadFromFile($file, $with_kavs);
    }

    function loadFromFile($file, $with_kavs = false, $return = true)
    {

        $file = replaceSl($file);
        if (!file_exists($file)) return;
        $this->values = $this->ini->read_ini($file, true);

        if ($with_kavs) {

            foreach ($this->values as $i => $val) {
                foreach ($val as $k => $v) {
                    $v[0] = ' ';
                    $v[strlen($v) - 1] = ' ';
                    $this->values[$i][$k] = trim($v);
                }
            }
        }

        if ($return)
            return $this->values;
    }

    function loadFile($file)
    {

        return $this->loadFromFile($file);
    }

    function sections()
    {
        return array_keys($this->values);
    }

    function getSection($section)
    {
        return (array)$this->values[$section];
    }

    function saveToFile($file)
    {

        $file = replaceSl($file);
        $result = '';

        foreach ($this->values as $section => $val) {

            if (!is_array($val)) continue;

            $result .= '[' . $section . ']' . _BR_;
            foreach ($val as $k => $v)
                $result .= $k . '=' . $v . _BR_;

            $result .= _BR_;
        }

        return file_put_contents($file, $result);
    }
}