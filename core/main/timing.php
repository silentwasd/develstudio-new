<?
/*
  
  SoulEngine Timing Library
  
  2011 ver 3
  
  Dim-S Software (c) 2011
		
		classes:
		TTimer,TTimerEx
		
		functions:
		setTimer, setTimeout
		
  ���������� ��� ��� ������ � ��������� � ���� �������.
  
*/

// ������ ������� setTimeout �� Javascript
// ������� ����������� ��������...
function setTimeout($interval,$func){
	
	$timer = new TTimerEx();
	$timer->interval  = $interval;
	$timer->func_name = $func;
	$timer->time_out  = true;
	$timer->freeOnEnd = true;
	$timer->enable = true;
	return $timer;
}

// ������ ������� setTimer
function setTimer($interval,$func){
	
	$timer = new TTimerEx();
	$timer->interval  = $interval;
	$timer->func_name = $func;
	$timer->time_out  = false;
	$timer->background = $background;
	$timer->enable = true;
	//pre($func);
	return $timer;
}

function setTimerEx($interval,$func){
	$tim = setTimer($interval, $func);
	$tim->checkResult = true;
	return $tim;
}

function setInterval($interval, $func, $background = false){
	return setTimer($interval, $func, $background);
}

function setBackTimeout($interval, $func){
	return setTimeout($interval, $func, true);
}

function setBackTimer($interval, $func){
	return setTimeout($interval, $func, true);
}