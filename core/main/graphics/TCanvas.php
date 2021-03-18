<?


class TCanvas extends TControl
{

    public $class_name = __CLASS__;
    public $pen;
    public $brush;
    public $font;

    function __construct($init = true)
    {

    }

    function lineTo($x, $y)
    {

        canvas_lineto($this->self, $x, $y);
    }

    function moveTo($x, $y)
    {

        canvas_moveto($this->self, $x, $y);
    }

    function textHeight($text)
    {

        return canvas_textHeight($this->self, $text);
    }

    function textWidth($text)
    {

        return canvas_textWidth($this->self, $text);
    }

    function refresh()
    {

        canvas_refresh($this->self);
    }

    function pixel($x, $y, $color = null)
    {

        if ($color === null)
            return canvas_pixel($this->self, (int)$x, (int)$y, null);
        else
            canvas_pixel($this->self, (int)$x, (int)$y, $color);
    }

    function rectangle($x1, $y1, $x2, $y2)
    {

        canvas_rectangle($this->self, $x1, $y1, $x2, $y2);
    }

    function ellipse($x1, $y1, $x2, $y2)
    {

        canvas_ellipse($this->self, $x1, $y1, $x2, $y2);
    }

    function lock()
    {
        canvas_lock($this->self);
    }

    function unlock()
    {
        canvas_unlock($this->self);
    }

    function clear()
    {
        canvas_clear($this->self);
    }

    function textOutAngle($x, $y, $angle, $text)
    {

        canvas_angle($this->self, $angle);
        $this->textOut($x, $y, $text);
        canvas_angle($this->self, 0);
    }

    function textOut($x, $y, $text)
    {

        canvas_textout($this->self, $x, $y, $text);
    }

    function saveFile($filename)
    {
        $this->savePicture($filename);
    }

    // вывод текста под углом

    function savePicture($filename)
    {

        $b = new TBitmap;
        $this->writeBitmap($b);
        $b->saveToFile($filename);
        $b->free();
    }

    function writeBitmap(TBitmap $bitmap)
    {

        canvas_writeBitmap($this->self, $bitmap->self);
    }

    function loadPicture($filename)
    {
        $this->drawPicture(getFileName($filename));
    }

    function drawPicture($fileName, $x = 0, $y = 0)
    {

        $b = new TBitmap;
        $b->loadAnyFile($fileName);
        $this->drawBitmap($b, $x, $y);
        $b->free();
    }

    function drawBitmap(TBitmap $bmp, $x = 0, $y = 0)
    {

        canvas_drawBitmap($this->self, $bmp->self, $x, $y);
    }

    function loadFile($filename)
    {
        $this->drawPicture($filename);
    }
}