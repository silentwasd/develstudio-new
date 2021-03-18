<?


/**
 * Class TStream (abstract)
 */
class TStream extends TObject{

    function __construct($self=nil){
        if ($self != nil)
            $this->self = $self;
        else
            $this->self = tstream_create();
    }

    function read(&$buffer, $count){
        $res = tstream_read($this->self,$count);
        $buffer = $res['b'];
        return $res['r'];
    }

    function write($buffer, $count){
        return tstream_write($this->self,$buffer,$count);
    }

    function writestr($str){
        return tstream_writestr($this->self, $str);
    }

    function seek($offset, $origin){
        return tstream_seek($this->self,$offset,$origin);
    }

    function readBuffer(&$buffer, $count){
        $buffer = tstream_read_buffer($this->self,$count);
    }

    function writeBuffer($buffer, $count){
        tstream_write_buffer($this->self,$buffer,$count);
    }

    function copyFrom(TStream $source, $count){
        return tstream_copy_from($this->self,$source->self,$count);
    }

    function readComponent(TComponent $instance){
        return _c(tstream_read_component($this->self,$instance->self));
    }

    function readComponentRes(TComponent $instance){
        return _c(tstream_read_component_res($this->self, $instance->self));
    }

    function writeComponent(TComponent $instance){
        tstream_write_component($this->self,$instance->self);
    }

    function writeComponentRes($resName, TComponent $instance){
        tstream_write_component_res($this->self, $resName, $instance->self);
    }

    /*function writeDescendent(object $instance, object $ancestor){
            tstream_write_component($this->self,$instance->self,$ancestor->self);
    }*/


    // properties...
    function get_position(){
        return tstream_get_position($this->self);
    }

    function set_position($pos){
        tstream_set_position($this->self,$pos);
    }


    function get_size(){
        return tstream_get_size($this->self);
    }

    function set_size($size){
        tstream_set_size($this->self,$size);
    }

    function get_text(){

        return tstream_readstr($this->self);
    }

    function set_text($v){

        $this->writestr($v);
    }

    function setText($str){

        string2stream($this->self, $str);
    }

    function saveToFile($file){

        $file = replaceSl($file);
        file_put_contents($file, $this->text);
    }

    function loadFromFile($file, $in_charset = false, $out_charset = 'windows-1251'){

        $file = replaceSl($file);

        if ($in_charset)
            $this->text = iconv($in_charset, $out_charset, file_get_contents($file));
        else
            $this->text = file_get_contents($file);
    }

}