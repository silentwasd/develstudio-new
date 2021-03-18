<?


/* --------------------------------------- */

define('nil',-1);

define('OS_WIN',1);
define('OS_UNIX',2);
define('OS_MACOS',3);
define('__SYSTEM__',OS_WIN);

switch(__SYSTEM__){
    case OS_WIN: define('_BR_',chr(13).chr(10)); break;
    case OS_UNIX: define('_BR_',chr(13)); break;
    case OS_MACOS: define('_BR_',chr(10)); break;
    default: define('_BR_',chr(13).chr(13));
}

/* --------------------------------------- */

function rtii_set($obj,$prop,$val)
{
    gui_propSet($obj->self, $prop, $val);
}

function rtii_get($obj,$prop)
{
    return gui_propGet($obj->self, $prop);
}
function rtii_exists($obj,$prop)
{
    return gui_propExists($obj->self, $prop);
}

function rtii_is_object($obj, $class)
{
    return gui_is($obj->self, $class);
}

function get_owner($obj)
{
    return gui_owner($obj->self);
}

function obj_create($class,$owner){

    if (is_object($owner) && property_exists($owner, 'self')){
        return component_create($class,$owner->self);
    }
    else
        return component_create($class,nil);
}

function set_event($self, $event, $value){

    return event_set($self, $event, $value);
}

function uni_serialize($str){

    return base64_encode(igbinary_serialize($str));
}

function uni_unserialize($str){

    $st = err_status(0);
    $result = igbinary_unserialize(base64_decode($str));

    if ( err_msg() ){
        $result = unserialize(base64_decode($str));
    }
    err_status($st);

    return $result;
}

function to_object($self, $type='TControl'){
    $type = trim($type);

    if (!class_exists($type)){
        return false;
    } else {
        return new $type(nil,false,$self);
    }
}

function rtii_class($self){

    $help = control_helpkeyword($self, null);
    if ($help){
        $help = uni_unserialize($help);

        if (class_exists($help['CLASS']))
            return $help['CLASS'];
        else {
            return gui_class($self);
        }
    }


    return gui_class($self);
}

function asObject($obj,$type){
    return to_object($obj->self,$type);
}

function reg_object($form,$name){
    return to_object(reg_component($form,$name));
}

function setEvent($form,$name,$event,$func){
    $obj = reg_object($form,$name);
    event_set( $obj->self, $event, $func );
    //set_event($obj->self,$event,$func);
}

function findComponent($str,$sep = '->',$asObject='TControl'){
    // $str = 'FormName->owner->Component';
    global $SCREEN, $COMPONENT_COOL_CACHE;

    $str = str_replace('.', $sep, $str);
    $names = explode($sep,$str);
    $owner = $GLOBALS['APPLICATION'];
    $x     = true;

    for ($i=0;$i<count($names);$i++){

        if ( !$owner ) return null;

        $owner = $owner->findComponent($names[$i]);

        if ($x && !$owner){

            if ($GLOBALS['__ownerComponent'])
                $owner = c($GLOBALS['__ownerComponent']);
            else
                $owner = $SCREEN->activeForm;

            $i--;
            $x = false;

        }
    }


    return $owner;
}

function _c($self = false, $check_thread = true){

    if ( $check_thread && $GLOBALS['THREAD_SELF'] )
        return new ThreadDebugClass($self);

    if ($self===false) return 0;

    return to_object($self,rtii_class($self));
}

function c_Alias($org, $alias){

    $GLOBALS['__OBJ_ALIAS'][$org][] = $alias;
}

function c($str, $check_thread = true){

    if ( $check_thread && $GLOBALS['THREAD_SELF'] )
        return new ThreadDebugClass($str);

    if (is_numeric($str))
        return _c($str, $check_thread);

    if (isset($GLOBALS['__OBJ_ALIAS'])){
        foreach ($GLOBALS['__OBJ_ALIAS'] as $org=>$alias){
            $str = str_ireplace($alias, $org, $str);
        }
    }

    $res = findComponent($str);
    if ( !$res ){
        return new DebugClass($str);
    }

    $result = asObject($res,rtii_class($res->self));

    return $result;
}


function ñ($str, $cached = false){
    return c($str, $cached);
}

// cSetProp('form.object.caption', 'text')
function cSetProp($str, $value){

    $str = strtolower($str);
    $str = str_replace('font.','font',$str);

    $str = str_replace('->','.',$str);
    $obj = substr($str, 0, strrpos($str,'.'));
    $method = substr($str, strrpos($str, ".")+1, strlen($str) - strrpos($str, '.'));

    $obj = c($obj);

    if (is_object($obj)){

        $obj->$method = $value;
        return true;
    }
    else
        return false;
}

// cGetProp('MainForm->Button_1->Caption');
function cGetProp($str){

    $str = strtolower($str);
    $str = str_replace('font.','font',$str);

    $str = str_replace('->','.',$str);
    $obj = substr($str, 0, strrpos($str,'.'));
    $method = substr($str, strrpos($str, ".")+1, strlen($str) - strrpos($str, '.'));


    $obj = c($obj);
    if (is_object($obj))
        return $obj->$method;
    else
        return NULL;
}

// alias of cGetProp
function p($str){
    return cGetProp($str);
}

// cCallMethod('form.object.setFocus')
function cCallMethod($str){

    $str = strtolower($str);
    $str = str_replace('font.','font',$str);

    $str = str_replace('->','.',$str);
    $obj = substr($str, 0, strrpos($str,'.'));
    $method = substr($str, strrpos($str, ".")+1, strlen($str) - strrpos($str, '.'));

    $obj = c($obj);
    if (is_object($obj))
        return $obj->$method();
    else
        return NULL;
}

function cMethodExists($str){

    $str = strtolower($str);
    $str = str_replace('font.','font',$str);

    $str = str_replace('->','.',$str);
    $obj = substr($str, 0, strrpos($str,'.'));
    $method = substr($str, strrpos($str, ".")+1, strlen($str) - strrpos($str, '.'));

    $obj = c($obj);
    if (is_object($obj)){
        return method_exists($obj, $method);
    }
    else
        return false;
}

function val($str, $value = null){
    $obj = toObject($str);

    $prop = 'text';

    if ($obj instanceof TCheckBox)
        $prop = 'checked';
    elseif ($obj instanceof TListBox)
        $prop = 'itemIndex';

    if ($value===null){
        return $obj->$prop;
    } else {
        $obj->$prop = $value;
    }
}

?>