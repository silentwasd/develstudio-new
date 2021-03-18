<?
/*
 
    Class for real MultiThreading for PHP
    
    from DevelStudio 3.0
    
    
    Note:
        It is not recommended at the same time create more than 500 threads
        
    #importGlobals = true
    #importClasses = true
    #importConstants = true
*/

global $_c;
$_c->setConstList(array('tpIdle', 'tpLowest', 'tpLower', 'tpNormal', 'tpHigher', 'tpHighest',
    'tpTimeCritical'),0);


function safe($code, $func){
    
    $p = TThread::$_criticals[ $code ];
    if ( $p ){
        gui_criticalEnter($p);
        call_user_func($func);
        gui_criticalLeave($p);
    }
}

function sync($function_name){
    
    //pre($function_name);
    if ( $GLOBALS['THREAD_SELF'] ){
        
        //$th = TThread::get($GLOBALS['THREAD_SELF']);
        
        if ( func_num_args() == 1 ){
            gui_threadSync($GLOBALS['THREAD_SELF'], 'TThread::__syncFull', igbinary_serialize(array('___callback'=>$function_name)));
        } else {
            
            $args = func_get_arg(1);
            if ( is_array($args) ){
                $args['___callback'] = $function_name;
                gui_threadSync($GLOBALS['THREAD_SELF'], 'TThread::__syncFull', igbinary_serialize($args)); 
            } else {
                trigger_error('sync() expects parameter 2 to be a array', E_USER_ERROR);
            }
        }
        
        return true;
    } else
        return false;
}

function syncEx($function_name, $args){
    
    if ( $GLOBALS['THREAD_SELF'] ){
       
        $args['___callback'] = $function_name;
        gui_threadSync($GLOBALS['THREAD_SELF'], 'TThread::__syncFull', igbinary_serialize($args));
        
        return igbinary_unserialize(gui_threadData($GLOBALS['THREAD_SELF'], 'result'));
        
        //return $th->syncFull($function_name, $args);
    } else
        return call_user_func_array($function_name, $args);
}

function critical($code){
    
    if (!TThread::$_criticals[ $code ]){
        TThread::$_criticals[ $code ] = gui_criticalCreate();
    }
}


function thread_inPool($func, $callback = null){
    
    if ( thread_count() < thread_max() ){
        if ( $callback )
            $callback(new TThread($func));
        else {
            $th = new TThread($func);
            $th->resume();
        }
    } else {
        TThread::$pool[] = array($func, $callback);    
    }
}

Timer::setInterval('TThread::checkPool', 1000);


function v($name, $value = null){
    
    return enc_v($name, $value);
}

function enc_v($name, $value = null){
    
    if ($value === null)
        return enc_getValue( $name );
    else
        enc_setValue( $name, urlencode(serialize($value)) );
}

function define_ex($name, $value){
    
    define($name, $value, false);
}