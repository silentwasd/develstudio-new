<?


/*
 
    PHP Soul Engine
    11.2009 ver 1.0
    
*/


function toObject($obj){
    
    if (is_numeric($obj))
        $obj = _c($obj);
    elseif (!is_object($obj))
        $obj = c($obj);
    
    return $obj;
}

function control_xywh($self, $nm, $val = null){
    
    switch ($nm){
        
        case 'x': return control_x($self, $val);
        case 'y': return control_y($self, $val);
        case 'w': return control_w($self, $val);
        case 'h': return control_h($self, $val);
    }
}

function cursor_real_x($obj, $offset = 0){
    
    $x = cursor_pos_x();
    $w = $GLOBALS['SCREEN']->Width - 20;
    $x = $x + $offset;
    
    if (is_object($obj))
        $aw = $obj->w;
    else
        $aw = control_w($obj, null);    
    
    if ($x + $aw > $w)
        $x = $x - $aw - $offset*2;
        
    return $x;
}

function cursor_real_y($obj, $offset = 0){
    
    $y = cursor_pos_y();
    $h = $GLOBALS['SCREEN']->Height - 20;
    $y = $y + $offset;
    
    if (is_object($obj))
        $ah = $obj->h;
    else
        $ah = control_h($obj, null);    
        
    if ($y + $ah > $h)
        $y = $y - $ah - $offset*2;
    
    return $y;
}

function findContrastColor($color){
    
    $color = abs($color);
    $color = dechex($color);
  
    if (strlen($color)==3){
        $r = hexdec($color[0]);
        $g = hexdec($color[1]);
        $b = hexdec($color[2]);
    } else {
        $r = hexdec($color[0].$color[1]);
        $g = hexdec($color[2].$color[3]);
        $b = hexdec($color[4].$color[5]);
    }
    
    if ($g < 160) $result = clWhite;
    else $result = clBlack;
    
    return $result;
}

function toHTMLColor($color){
    
    return sprintf('#%02X%02X%02X', $color&0xFF , ($color>>8)&0xFF , ($color>>16)&0xFF );
}


function registerGlobalVar(&$value){
    
    $c = count($GLOBALS[__FUNCTION__]);
    
    $GLOBALS[__FUNCTION__][$c+1] =& $value;
    return $c+1;
}

function &getGlobalVar($index){
    
    return $GLOBALS['registerGlobalVar'][$index];
}

function unsetGlobalVar($index){
    
    $GLOBALS['registerGlobalVar'][$index] = null;
}