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

/* Constant */
include_lib('main','constant/myVars');
include_lib('main','constant/TConstantList');
include_lib('main','constant');

/* Debug */
include_lib('debug','errors');
include_lib('debug','ByteCode');
include_lib('debug','DebugClassException');
include_lib('debug','DebugClass');
include_lib('debug','ThreadDebugClass');

/* Config */
include_lib('','TConfig');

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
include_lib('main','graphics/TBrush');
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

/* Menus */
include_lib('main','menus');
include_lib('main','menus/styleMenu');
include_lib('main','menus/TMainMenu');
include_lib('main','menus/TMenuItem');
include_lib('main','menus/TMenu');
include_lib('main','menus/TPopupMenu');

/* Image list */
include_lib('main','imagelist');
include_lib('main','imagelist/TImageList');

/* Web */
include_lib('main','web');
include_lib('main','web/TChromiumOptions');
include_lib('main','web/TChromium');
include_lib('main','web/TWebBrowser');

/* Grids */
include_lib('main','grids');
include_lib('main','grids/TStringGrid');

/* Registry */
include_lib('main','registry');
include_lib('main','registry/TRegistry');

/* Keyboard */
include_lib('main','keyboard');
include_lib('main','keyboard/HotKey');

/* Localization */
include_lib('main','localization');
include_lib('main','localization/Localization');

/* OS Api */
include_lib('main','osapi');
include_lib('main','osapi/DynLib');

/* Utils */
include_lib('main','utils');
include_lib('main','utils/group');
include_lib('main','utils/TGroup');

/* Skins */
include_lib('main','skins');
include_lib('main','skins/TsSkinManager');
include_lib('main','skins/TsSkinProvider');
include_lib('main','skins/TsLabel');
include_lib('main','skins/TsLabelFX');
include_lib('main','skins/TsBitBtn');
include_lib('main','skins/TsSpeedButton');
include_lib('main','skins/TsProgressBar');
include_lib('main','skins/TsTrackBar');
include_lib('main','skins/TsBevel');

/* Files */
include_lib('files','file');
include_lib('files','ini');
include_lib('files','ini/__ini');
include_lib('files','ini/TIniFile');
include_lib('files','ini/TConfigIni');
include_lib('files','TIniFileEx');

/* Size control */
include_lib('design','sizecontrol/TSizeCtrl');

/* Prop components */
include_lib('design','propcomponents/TEditBtn');
include_lib('design','propcomponents/TEditDialog');
include_lib('design','propcomponents/TEditOpenDialog');
include_lib('design','propcomponents/TEditSaveDialog');
include_lib('design','propcomponents/TEditFontDialog');
include_lib('design','propcomponents/TEditColorDialog');
include_lib('design','propcomponents/TEditDMSColorDialog');

/* DFM Parser */
include_lib('design','TDFMParser');

/* Syntax edit */
include_lib('design','synedit');
include_lib('design','synedit/TSynEdit');
include_lib('design','synedit/TSynCompletionProposal');
include_lib('design','synedit/TSynHighlighterAttributes');
include_lib('design','synedit/TSynCustomHighlighter');
include_lib('design','synedit/TSynPHPSyn');
include_lib('design','synedit/TSynGeneralSyn');
include_lib('design','synedit/TSynCppSyn');
include_lib('design','synedit/TSynCssSyn');
include_lib('design','synedit/TSynHTMLSyn');
include_lib('design','synedit/TSynSQLSyn');
include_lib('design','synedit/TSynJScriptSyn');
include_lib('design','synedit/TSynXMLSyn');

include_lib('','inits');