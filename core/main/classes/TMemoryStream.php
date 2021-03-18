<?


class TMemoryStream extends TStream{

    function __construct($self = nil){
        if ($self != nil)
            $this->self = $self;
        else
            $this->self = tmstream_create();
    }

    function loadFromFile($filename){

        $filename = replaceSr($filename);
        tmstream_loadfile($this->self, $filename);
    }

    function saveToFile($filename){

        $filename = replaceSr($filename);
        tmstream_savefile($this->self, $filename);
    }

    function loadFromStream($m){

        tmstream_loadstream($this->self, $m->self);
    }

    function saveToStream($m){

        tmstream_savestream($this->self, $m->self);
    }
}