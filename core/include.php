<?

function _empty(){}
function replaceSl($s){return str_replace("\\","/",$s);}
function replaceSr($s){return str_replace("/","\\",$s);}


function pre($obj){
	
	if ( sync(__FUNCTION__, func_get_args()) ) return;
	
	$s = print_r($obj,true);
	gui_message($s);
}

function pre2($obj){
	
	if ( sync(__FUNCTION__, func_get_args()) ) return;
	
	ob_start();
	var_dump($obj);
	$s = ob_get_contents();
	ob_end_clean();
	gui_message($s);
}

function include_lib($class,$name){
	require ENGINE_DIR . $class . '/' . $name . '.php';
}

global $progDir, $moduleDir, $engineDir;
$progDir = str_replace('\\\\','\\',$progDir);

$prs2 = basename(param_str(2));

$prs2_ext = strtolower(substr($prs2, strrpos($prs2,'.')+1, strlen($prs2)-strrpos($prs2,'.')-1));

if ($prs2_ext=='dvsexe' || $prs2_ext=='mspprexe'){
	define('DOC_ROOT2', str_replace('//','/',replaceSl($progDir)));
	$progDir = replaceSr(dirname( param_str(2) )).'\\';
} 
define('DOC_ROOT',str_replace('//','/',replaceSl($progDir)));
define('MODULE_DIR',replaceSl($moduleDir));
define('ENGINE_DIR',replaceSl($engineDir));
define('DRIVE_CHAR', $progDir[0]);

define('progDir',$progDir);
set_include_path(DOC_ROOT);

$_SERVER['DOCUMENT_ROOT'] = DOC_ROOT;
$_SERVER['MODULE_DIR'] = MODULE_DIR;
$_SERVER['ENGINE_DIR'] = ENGINE_DIR;
/* %START_MODULES% */
include_lib('main','constant');
include_lib('debug','errors');
include_lib('debug','bytecode');
include_lib('debug','debugclass');
include_lib('','config');

/* Objects */
include_lib('main','objects');
include_lib('main','objects/_Object');
include_lib('main','objects/TObject');
include_lib('main','objects/TComponent');
include_lib('main','objects/TFont');
include_lib('main','objects/TRealFont');
include_lib('main','objects/TControl');

/* Classes */
include_lib('main','classes');
include_lib('main','classes/TStrings');
include_lib('main','classes/TStream');
include_lib('main','classes/TMemoryStream');
include_lib('main','classes/TFileStream');

/* Messages */
include_lib('main','messages');
include_lib('main','messages/Receiver');
include_lib('main','messages/TDropFilesTarget');

include_lib('main','graphics');
include_lib('main','dfmreader');
include_lib('main','forms');
include_lib('main','dialogs');
include_lib('main','standart');
include_lib('main','timing');
include_lib('main','threading');
include_lib('main','buttons');
include_lib('main','additional');
include_lib('main','menus');
include_lib('main','imagelist');
include_lib('main','web');
include_lib('main','grids');
include_lib('main','registry');

include_lib('main','keyboard');
include_lib('main','localization');
include_lib('main','osapi');
include_lib('main','utils');
include_lib('main','skins');

include_lib('files','file');
include_lib('files','ini');
include_lib('files','ini_ex');

include_lib('design','sizecontrol');
include_lib('design','propcomponents');
include_lib('design','dfmparser');
include_lib('design','synedit');

include_lib('','inits');