<?


class TPoint
{

    public $x;
    public $y;

    function __construct($x, $y)
    {
        $this->x = (integer)$x;
        $this->y = (integer)$y;
    }
}