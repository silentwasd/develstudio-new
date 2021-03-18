<?


class TFileStream extends TStream
{

    function __construct($filename, $mode)
    {
        $this->self = tfilestream_create($filename, $mode);
    }
}