<?
global $_c, $APPLICATION;

/* MessageBox flags */
$_c->MB_OK = 0x000000;
$_c->MB_OKCANCEL = 0x000001;
$_c->MB_ABORTRETRYIGNORE = 0x000002;
$_c->MB_YESNOCANCEL = 0x000003;
$_c->MB_YESNO = 0x000004;
$_c->MB_RETRYCANCEL = 0x000005;

$_c->MB_ICONHAND = 0x000010;
$_c->MB_ICONQUESTION = 0x000020;
$_c->MB_ICONEXCLAMATION = 0x000030;
$_c->MB_ICONASTERISK = 0x000040;
$_c->MB_USERICON = 0x000080;
$_c->MB_ICONWARNING     = MB_ICONEXCLAMATION;
$_c->MB_ICONERROR       = MB_ICONHAND;
$_c->MB_ICONINFORMATION = MB_ICONASTERISK;
$_c->MB_ICONSTOP        = MB_ICONHAND;

$_c->MB_APPLMODAL = 0x000000;
$_c->MB_SYSTEMMODAL = 0x001000;
$_c->MB_TASKMODAL = 0x002000;
$_c->MB_HELP = 0x004000;

//TMsgDlgType = (mtWarning, mtError, mtInformation, mtConfirmation, mtCustom);
$_c->setConstList(array('mtWarning', 'mtError', 'mtInformation', 'mtConfirmation', 'mtCustom'), 0);
$_c->setConstList(array('fdScreen', 'fdPrinter', 'fdBoth'), 0);

function messageBox($text,$caption,$flag = MB_OK){
	
	return syncEx('application_messagebox', array($text, $caption, $flag));
}

function messageDlg($text, $type = mtInformation, $flag = MB_OK){
	
	return syncEx('message_dlg', array($text, $type, $flag));
}

function message($text, $mode = mtCustom){
    
	return messageDlg($text, $mode);
}

function showMessage($text){
	
	messageBox($text,appTitle());
}

function alert($text){showMessage($text);}
function msg($text){showMessage($text);}

function confirm($text){
	$res = messageBox($text,appTitle(),MB_YESNO);
	return $res == idYes;
}