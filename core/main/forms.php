<?
global $_c;

/* results of dialogs and forms */
$_c->setConstList(array(
			'idOk','idCancel','idAbort','idRetry','idIgnore',
			'idYes','idNo','idClose','idHelp','idTryAgain',
			'idContinue'
                        ));

$_c->mrNone     = 0;
$_c->mrOk       = idOk;
$_c->mrCancel   = idCancel;
$_c->mrAbort    = idAbort;
$_c->mrRetry    = idRetry;
$_c->mrIgnore   = idIgnore;
$_c->mrYes      = idYes;
$_c->mrNo       = idNo;
$_c->mrAll	= mrNo + 1;
$_c->mrNoToAll  = mrAll + 1;
$_c->mrYesToAll = mrNoToAll + 1;


/* cursors ----------------- */
$_c->crDefault     = 0;
$_c->crNone        = -1;
$_c->crArrow       = -2;
$_c->crCross       = -3;
$_c->crIBeam       = -4;
$_c->crSize        = -22;
$_c->crSizeNESW    = -6;
$_c->crSizeNS      = -7;
$_c->crSizeNWSE    = -8;
$_c->crSizeWE      = -9;
$_c->crUpArrow     = -10;
$_c->crHourGlass   = -11;
$_c->crDrag        = -12;
$_c->crNoDrop      = -13;
$_c->crHSplit      = -14;
$_c->crVSplit      = -15;
$_c->crMultiDrag   = -16;
$_c->crSQLWait     = -17;
$_c->crNo          = -18;
$_c->crAppStart    = -19;
$_c->crHelp        = -20;
$_c->crHandPoint   = -21;
$_c->crSizeAll     = -22;
  

$GLOBALS['cursors_meta'] = array(0 =>'crDefault',
      -1=>'crNone',
      -2=>'crArrow',
      -3=>'crCross',
      -4=>'crIBeam',
      -22=>'crSize',
      -6=>'crSizeNESW',
      -7=>'crSizeNS',
      -8=>'crSizeNWSE',
      -9=>'crSizeWE',
      -10=>'crUpArrow',
      -11=>'crHourGlass',
      -12=>'crDrag',
      -13=>'crNoDrop',
      -14=>'crHSplit',
      -15=>'crVSplit',
      -16=>'crMultiDrag',
      -17=>'crSQLWait',
      -18=>'crNo',
      -19=>'crAppStart',
      -20=>'crHelp',
      -21=>'crHandPoint',
);
 

  
/* close type */
$_c->setConstList(array('caNone', 'caHide', 'caFree', 'caMinimize'),0);
  
/* window state */
$_c->setConstList(array('wsNormal','wsMinimized','wsMaximized'),0);

//TFormStyle = (fsNormal, fsMDIChild, fsMDIForm, fsStayOnTop);
$_c->setConstList(array('fsNormal', 'fsMDIChild', 'fsMDIForm', 'fsStayOnTop'),0);

//TFormBorderStyle = (bsNone, bsSingle, bsSizeable, bsDialog, bsToolWindow, bsSizeToolWin);
$_c->setConstList(array('bsNone', 'bsSingle', 'bsSizeable', 'bsDialog', 'bsToolWindow', 'bsSizeToolWin'),0);

$_c->setConstList(array('poDesigned', 'poDefault', 'poDefaultPosOnly', 'poDefaultSizeOnly', 'poScreenCenter',
			'poDesktopCenter', 'poMainFormCenter', 'poOwnerFormCenter'),0);

$_c->setConstList(array('dmManual', 'dmAutomatic'), 0);
$_c->setConstList(array('dkDrag', 'dkDrag'), 0);

function asTForm($self){
        return to_object($self,'TForm');
}

// делает форму $form главной в приложении...
function setMainForm($form){
        set_main_form($form->self);
}

function appTitle(){
        return application_prop('title',null);
}

function halt(){
       application_terminate();
}