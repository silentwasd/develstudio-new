<?


class TConstantList
{

    public $defines;

    function __get($nm)
    {

        return $this->defines[$nm];
    }

    function __set($nm, $val)
    {
        if (!defined($nm)) {
            $this->defines[$nm] = $val;
            define($nm, $val, false);
        }
    }

    function setConstList($names, $beg = 1)
    {
        for ($i = 0; $i < count($names); $i++) {
            if (!defined($names[$i])) {
                define($names[$i], $i + $beg, false);
                $this->defines[$names[$i]] = $i + $beg;
            }
        }
    }
}