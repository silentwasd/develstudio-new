<?
/*
   Base classes
   Author: Dmitriy Zaytsev (c) 2009
 
   Info:
        classes
                TStrings - array of string in VCL
                TStream - abstract class
                TMemoryStream, TFileStream
 
 
*/

global $_c;

$_c->fmOpenRead       = 0x00;
$_c->fmOpenWrite      = 0x01;
$_c->fmOpenReadWrite  = 0x02;

$_c->fmShareExclusive = 0x10;
$_c->fmShareDenyWrite = 0x20;
$_c->fmShareDenyRead  = 0x30; // write-only not supported on all platforms
$_c->fmShareDenyNone  = 0x40;

$_c->fmCreate = 0xFFFF;