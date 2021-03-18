<?


class TRect
{

    public $left;
    public $top;
    public $right;
    public $bottom;

    function __construct($left, $top, $right, $bottom)
    {
        $this->left = (integer)$left;
        $this->top = (integer)$top;
        $this->right = (integer)$right;
        $this->bottom = (integer)$bottom;
    }
}