<?


class TRealFont extends TFont {

    public $self;

    function __construct($self){
        $this->self = $self;
    }

    function prop($prop){
        return gui_propGet($this->self, $prop);
    }

    function propSet($prop, $value){
        if (is_array($value)) $value = implode(',', $value);

        return gui_propSet($this->self, $prop, $value);
    }

    function set_name($name){$this->propSet('name',$name);}
    function set_size($size){$this->propSet('size',$size);}
    function set_color($color){$this->propSet('color',$color);}
    function set_charset($charset){$this->propSet('charset',$charset);}
    function set_style($style){	$this->propSet('style',$style); }

    function get_name(){ return $this->prop('name'); }
    function get_color(){ return $this->prop('color'); }
    function get_size(){ return $this->prop('size'); }
    function get_charset(){ return $this->prop('charset'); }
    function get_style(){

        $result = $this->prop('style');
        $result = explode(',',$result);
        foreach ($result as $x=>$e)
            $result[$x] = trim($e);

        return $result;
    }

    function assign($font){
        $this->name = $font->name;
        $this->size = $font->size;
        $this->color = $font->color;
        $this->charset = $font->charset;
        $this->style = $font->style;
    }
}