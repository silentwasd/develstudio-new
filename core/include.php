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

/* Graphics */
include_lib('main','graphics');
include_lib('main','graphics/TPoint');
include_lib('main','graphics/TRect');
include_lib('main','graphics/TPen');
include_lib('main','graphics/TCanvas');
include_lib('main','graphics/TCanvasFont');
include_lib('main','graphics/TControlCanvas');
include_lib('main','graphics/TBitmap');
include_lib('main','graphics/TIcon');
include_lib('main','graphics/TPicture');

/* DFM Reader */
include_lib('main','dfmreader');

/* Forms */
include_lib('main','forms');
include_lib('main','forms/TForm');
include_lib('main','forms/TDockableForm');
include_lib('main','forms/TScreen');
include_lib('main','forms/TScreenEx');
include_lib('main','forms/TApplication');

/* Dialogs */
include_lib('main','dialogs');
include_lib('main','dialogs/TCommonDialog');
include_lib('main','dialogs/TOpenDialog');
include_lib('main','dialogs/TSaveDialog');
include_lib('main','dialogs/TFontDialog');
include_lib('main','dialogs/TColorDialog');
include_lib('main','dialogs/TDMSColorDialog');
include_lib('main','dialogs/TPrintDialog');
include_lib('main','dialogs/TPageSetupDialog');
include_lib('main','dialogs/TFindDialog');
include_lib('main','dialogs/TReplaceDialog');

/* Standard */
include_lib('main','standart');
include_lib('main','standart/TLabel');
include_lib('main','standart/TEdit');
include_lib('main','standart/TMemo');
include_lib('main','standart/TRichEdit');
include_lib('main','standart/TCheckBox');
include_lib('main','standart/TRadioButton');
include_lib('main','standart/TListBox');
include_lib('main','standart/TComboBox');
include_lib('main','standart/TProgressBar');
include_lib('main','standart/TScrollBar');
include_lib('main','standart/TGroupBox');
include_lib('main','standart/TRadioGroup');
include_lib('main','standart/TPanel');

/* Timing */
include_lib('main','timing');
include_lib('main','timing/TTimer');
include_lib('main','timing/TTimerEx');
include_lib('main','timing/Timer');

/* Threading */
include_lib('main','threading');
include_lib('main','threading/TThread');

/* Buttons */
include_lib('main','buttons');
include_lib('main','buttons/TButton');
include_lib('main','buttons/TBitBtn');
include_lib('main','buttons/TSpeedButton');
include_lib('main','buttons/TPNGGlyph');
include_lib('main','buttons/TPNGSpeedButton');
include_lib('main','buttons/TPNGBitBtn');

/* Additional */
include_lib('main','additional');
include_lib('main','additional/TCoolTrayIcon');
include_lib('main','additional/TTrackBar');
include_lib('main','additional/THotKey');
include_lib('main','additional/TMaskEdit');
include_lib('main','additional/TImage');
include_lib('main','additional/TMImage');
include_lib('main','additional/TDrawGrid');
include_lib('main','additional/TShape');
include_lib('main','additional/TBevel');
include_lib('main','additional/TScrollBox');
include_lib('main','additional/TCheckListBox');
include_lib('main','additional/TSplitter');
include_lib('main','additional/TStaticText');
include_lib('main','additional/TControlBar');
include_lib('main','additional/TValueListEditor');
include_lib('main','additional/TLabeledEdit');
include_lib('main','additional/TColorBox');
include_lib('main','additional/TStatusBar');
include_lib('main','additional/TControlBar');
include_lib('main','additional/TColorListBox');
include_lib('main','additional/TTabSet');
include_lib('main','additional/TTabControl');
include_lib('main','additional/TPageControl');
include_lib('main','additional/TTabSheet');
include_lib('main','additional/TSizeConstraints');
include_lib('main','additional/TPadding');
include_lib('main','additional/TListItems');
include_lib('main','additional/TListItem');
include_lib('main','additional/TListView');
include_lib('main','additional/TDateTimePicker');
include_lib('main','additional/TTreeView');
include_lib('main','additional/TTreeNode');

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