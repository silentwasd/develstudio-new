<?


class Receiver
{


    static function add($function)
    {

        $GLOBALS['__' . __CLASS__][] = $function;
    }

    static function event($handle, $msg)
    {

        $arr = unserialize(base64_decode($msg));

        $array = (array)$GLOBALS['__' . __CLASS__];
        foreach ($array as $func) {

            eval($func . '($handle, $arr);');
        }
    }

    static function send($handle, $arr)
    {

        receiver_send($handle, base64_encode(serialize($arr)));
    }
}