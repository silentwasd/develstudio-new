<?


/**
 * Class TCanvasFont
 */
class TCanvasFont extends TFont
{
    protected function prop($prop)
    {
        return rtii_get($this, $prop);
    }

    protected function propSet($prop, $value)
    {
        rtii_set($this, $prop, $value);
    }
}