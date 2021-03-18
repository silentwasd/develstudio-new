<?


class TStrings extends TObject{

    public $class_name = __CLASS__;
    public $parent_object = nil;

    function __construct($init = true){
        if ($init)
            $this->self = tstrings_create();
    }

    // properties ...
    // -------------------------------------------------------------------------
    function get_text(){
        return tstrings_get_text($this->self);
    }

    function set_text($text){
        if (is_array($text))
            $text = implode(_BR_, $text);

        $this->clear();
        tstrings_set_text($this->self,$text);
    }

    function get_itemIndex(){
        $result =  tstrings_item_index($this->parent_object,null);
        return $result;
    }

    function set_itemIndex($n){
        tstrings_item_index($this->parent_object,$n);
    }

    function get_count(){
        return substr_count($this->text,_BR_);
    }
    // -------------------------------------------------------------------------

    function loadFromFile($filename){
        $this->text = file_get_contents(shortName($filename));
    }

    function saveToFile($filename){
        file_put_contents($filename,$this->text);
    }

    function assign(object $strings){
        $this->text = $strings->text;
    }

    function addStrings(object $strings){
        $this->text = $this->text . $strings->text;
    }

    function append($new){
        $i = $this->itemIndex;
        $this->text = $this->text . $new._BR_;
        $this->itemIndex = $i;
    }

    function add($new){
        $this->append($new);
        return $this->count-1;
    }

    function delete($index){
        $arr = explode(_BR_, $this->text);
        unset($arr[$index]);
        $this->text = implode(_BR_, $arr);
    }

    function exchange($index, $index2){

        $arr = explode(_BR_, $this->text);
        $tmp = $arr[$index];
        $arr[$index] = $arr[$index2];
        $arr[$index2] = $tmp;
        $this->text = implode(_BR_, $arr);
    }

    function clear(){

        tstrings_clear($this->self); // fix
    }

    function free(){
        tstrings_free($this->self);
    }

    function get_lines(){

        $lines = explode(_BR_, rtrim($this->text));

        return $lines;
    }

    function get_strings(){
        return $this->get_lines();
    }

    function setLine($index, $name){

        tstrings_setline($this->self, $index, $name);
        /*$id = $this->itemIndex;
        $lines = $this->lines;
        if (isset($lines[$index]))
            $lines[$index] = $name;
        $this->text = implode(_BR_, $lines);
        $this->itemIndex = $id;*/
    }

    function getLine($index){
        $lines = $this->lines;
        if (isset($lines[$index]))
            return $lines[$index];

        return false;
    }

    function setArray($array){

        $this->text = implode(_BR_, (array)$array);
    }

    function get_selected(){
        $lines = $this->lines;

        if ($this->itemIndex > -1)
            return $lines[$this->itemIndex];
        else
            return false;
    }

    function set_selected($v){
        $lines = $this->lines;

        $index = array_search($v, $lines);

        if ($index!==false)
            $this->itemIndex = $index;
        else
            $this->itemIndex = -1;
    }

    function indexOf($value){

        $lines = $this->lines;

        $index = array_search($value, $lines);

        return $index === false ? -1 : $index;
    }
}