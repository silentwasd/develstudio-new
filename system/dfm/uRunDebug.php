<?

class ev_fmRunDebug {
    
    function onShow(){
        
        $debug_vars = (array)myProject::cfg('debug_vars');
        foreach ($debug_vars as $var)
            myDebug::sendMsg(array('action'=>'add','name'=>$var,'type'=>'glVars'));
    }
    
    function onClose(){
        
        myUtils::stop();
    }
}

class ev_fmRunDebug_btn_add {
    
    function onClick(){
        
        $arr['type'] = 'glVars';
        c('edt_inputText')->formStyle = fsStayOnTop;
        $res = inputText('����� ����������', '������� ��� ���������� ����������');
        c('edt_inputText')->formStyle = fsNormal;
        $res = str_replace('$','',$res);
        if ($res){
            $arr['name'] = $res;
            $arr['action'] = 'add';
            myDebug::sendMsg($arr);
        }
    }
}


class ev_fmRunDebug_btn_del {
    
    function onClick(){
        
        $arr['type'] = 'glVars';
        $res = c('fmRunDebug->varList')->inText;
        $res = str_replace('$','',$res);
        if ($res){
        
            $arr['name'] = $res;
            $arr['action'] = 'del';
            myDebug::sendMsg($arr);
        }
    }
}


class ev_fmRunDebug_btn_edit {
    
    function onClick(){
        
        $arr['type'] = 'glVars';
        $res = c('fmRunDebug->varList')->inText;
        $res = str_replace('$','',$res);
        
        c('edt_inputText')->formStyle = fsStayOnTop;
        $res = inputText('���������������', '������� ����� ��� ����������');
        c('edt_inputText')->formStyle = fsNormal;
        
        
        if ($res){
        
            $arr['name'] = $res;
            $arr['action'] = 'del';
            myDebug::sendMsg($arr);
        }
    }
}

class ev_fmRunDebug_varList {
    
    function onClick($self){
        
        $var = c($self)->items->selected;
        global $__DEBUG_GLVARS;
        
        c('fmRunDebug->mResult')->text = $__DEBUG_GLVARS[$var];
    }
}