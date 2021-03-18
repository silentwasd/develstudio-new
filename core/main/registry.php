<?


/*
 
    PHP Soul Engine WindowsRegistry
    
    2009.10 ver 1.0   
    
*/

global $_c;


// Reserved Key Handles. 

$_c->HKEY_CLASSES_ROOT     = 0x80000000;
$_c->HKEY_CURRENT_USER     = 0x80000001;
$_c->HKEY_LOCAL_MACHINE    = 0x80000002;
$_c->HKEY_USERS            = 0x80000003;
$_c->HKEY_PERFORMANCE_DATA = 0x80000004;
$_c->HKEY_CURRENT_CONFIG   = 0x80000005;
$_c->HKEY_DYN_DATA         = 0x80000006;

$_c->STRING    = 0;
$_c->DATE_TIME = 1;
$_c->BOOL      = 2;
$_c->DWORD     = 3;
$_c->CURRENCY  = 4;

// регистрация ассоциации расширения с программой
function registerFileType($prefix, $exe){

    $exe = replaceSr($exe);  
    
    $r = new TRegistry;
    $r->RootKey(HKEY_CLASSES_ROOT);
    $r->OpenKey('.'.$prefix, true);
    $r->WriteString('',$prefix . 'file');
    $r->CloseKey();
    
    $r->CreateKey($prefix . 'file');
    $r->OpenKey($prefix . 'file\DefaultIcon', true);
    $r->WriteString('',$exe . ',0');
    $r->CloseKey();
    
    $r->OpenKey($prefix . 'file\shell\open\command', true);
    $r->WriteString('',$exe . ' "%1"');
    $r->CloseKey();
    $r->Free();
}