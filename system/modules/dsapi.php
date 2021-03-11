<?
/*
   �����, ������� ���������� ��� ����������� ������������� DS Api 
*/


class DSApi {
    
    static function __doStartBeforeFunc(){
        
        foreach((array)$GLOBALS['___startFunctionsBefore'] as $func)
            eval($func.';');
    }
    
    static function __doStartFunc(){
        
        //pre((array)$GLOBALS['___startFunctions']);
        foreach((array)$GLOBALS['___startFunctions'] as $func)
            eval($func.';');
    }
    
    // ����������� �������, ������� ������ ����������� ����� �������� ���� ����
    static function reg_startFunc($func){
        
        
        $GLOBALS['___startFunctions'][] = $func;
    }
    
    // ����������� �������, ������� ������ ����������� �� �������� ���� ����
    static function reg_startFuncBefore($func){
        
        $GLOBALS['___startFunctionsBefore'][] = $func;
    }
    
    // ������������ ������� ��� ������ ���� �������
    static function reg_eventType($type, $callFunc, $params = array('self'), $class = false){
        
        $type = strtolower($type);
        
        if ($class){
            $GLOBALS['__EVENTS_API_CLASS'][$class][$type] = $callFunc;
            $GLOBALS['__EVENTS_API_PRMS_CLASS'][$class][$type] = $params;
        } else {
            $GLOBALS['__EVENTS_API'][$type] = $callFunc;
            $GLOBALS['__EVENTS_API_PRMS'][$type] = $params;
        }
    }
    
    static function reg_eventParams($type, $params, $class = false){
        
        if ($class)
            $GLOBALS['__EVENTS_API_PRMS_CLASS'][$class][strtolower($type)] = $params;
        else
            $GLOBALS['__EVENTS_API_PRMS'][strtolower($type)] = $params;
    }
    
    static function getEventParams($type, $class = false){
        
        $type = strtolower($type);
        
        if ($class && $GLOBALS['__EVENTS_API_PRMS_CLASS'][$class][$type])
            $result = '$'.implode(', $',$GLOBALS['__EVENTS_API_PRMS_CLASS'][$class][$type]);
        elseif ($GLOBALS['__EVENTS_API_PRMS'][$type])
            $result = '$'.implode(', $',$GLOBALS['__EVENTS_API_PRMS'][$type]);
        else
            $result = '$self';
            
        return str_replace('$&', '&$', $result);
    }
    
    static function callEvent($self, $params, $type){
        
        return __exEvents::callEventEx($self, $params, $type);
    }
    
    static function callEventVars($self, &$params, $type){
        return __exEvents::callEventVars($self, $params, $type);
    }
    
    // ������������ ���� ���������� ���������� � DS, ������� ����� ������������ ��� global
    static function reg_glVar($name){
        
        $name = str_ireplace('$','',$name);
        __exEvents::addGlobalVar($name);
    }
    
    // ������������� ��������� ��� ������ ��������
    static function echoController($obj_or_func){
        
        $GLOBALS['__echoController'] = $obj_or_func;
    }
    
    // �������������� ����� �� ������ $info
    static function initForm($fmEdit, $info){
        
        if (!$info) return false;
        
        $fmEdit->constraints->maxwidth = $info['maxwidth'];
        $fmEdit->constraints->minwidth = $info['minwidth'];
        $fmEdit->constraints->maxheight= $info['maxheight'];
        $fmEdit->constraints->minheight= $info['minheight'];
                
        if (isset($info['position']))
            $fmEdit->position = $info['position'];
        if (isset($info['windowState']))
            $fmEdit->windowState = $info['windowState'];
        if (isset($info['formStyle']))
            $fmEdit->formStyle = $info['formStyle'];
        if (isset($info['borderStyle']))
            $fmEdit->borderStyle = $info['borderStyle'];
                            
        if (isset($info['visible'])){
            
            $fmEdit->visible = $info['visible'];
        }
        
        $icons = array();
        if ($info['i_close'] || !isset($info['i_close']))
            $icons[] = 'biSystemMenu';
        if ($info['i_min'] || !isset($info['i_min']))
            $icons[] = 'biMinimize';
        if ($info['i_max'] || !isset($info['i_max']))
            $icons[] = 'biMaximize';
        
        $fmEdit->borderIcons = implode(',',$icons);
    }
    
    // ������������ ������� ��� ����������� �� �������
    function initFormEx($fmEdit, $name){
        
        global $__config;
        self::initForm($fmEdit, $__config['formsInfo'][strtolower($name)]);
    }
    
    // ������������� �������� ������� � �������� TEvent
    function initEvent($form, $form_name = false, $init_funcs = false){
        
        $form_event_load = false;
        $c = component_count($form->self);
        
        if ( !$form_name )
            $form_name = $form->name;
            
        $form_name = strtolower($form_name);
        $form_self = $form->self;
        
        global $__config;        
        
        if (is_array(eventEngine::$DATA[$form_name])){
        foreach (eventEngine::$DATA[$form_name] as $obj=>$eventList){
            
            $self  = false;
            if ($obj == '--fmedit'){
                $obj_name = $form_name;
                $self     = $form_self;
                $el       = $form;
            } else {
                
                $obj_name = $form_name .'->'.$obj;
            }
            
            if (is_array($eventList)){
                
                
                if (!$self){    
                    $el = $form->findComponent($obj);
                    $self = $el->self;
                }
                
                    $GLOBALS['__exEvents'][$self] = array('events'=>$eventList, 'obj_name'=>$obj_name);
                    foreach ((array)$eventList as $x=>$code){
                        
                        
                        //unset(eventEngine::$DATA[$form_name][$obj][$x]);
                        if (method_exists('__exEvents',$x)){
                            $el->$x = '__exEvents::'.$x;
                        }
                        else {
                            $class = $el->className;
							
                            if ($GLOBALS['__EVENTS_API_CLASS'][$class][$x])
                                $el->$x = $GLOBALS['__EVENTS_API_CLASS'][$class][$x];
                            else
                                $el->$x = $GLOBALS['__EVENTS_API'][$x];    
                        }
                        
                        if ($init_funcs)
                        if ($el instanceof TFunction){          
                            if ($el->toRegister)
                                $el->register();
                        }
                        
                        if ($x =='oncreate'){
                            if ( $GLOBALS['LOADER']->isStart )
                                __exEvents::callCode($form->self, 'oncreate');
                            else
                                self::reg_startFunc('__exEvents::callCode('.$form->self.',"oncreate");');
                        }
                    }
                    
            }
            
        }
            
        }
        
    }

}