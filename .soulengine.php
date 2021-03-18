<?php


/**
 * ������� ���������.
 * @param string $type ��� ����������.
 * @param int $owner ������������� ����������-���������.
 * @return int ������������� ���������� ����������. ���� ������� ��������� �� �������, ������������ ����.
 */
function component_create($type, $owner) {}


/**
 * ���������� ������ �� ������.
 * @param int $id ������������� �������.
 * @return bool ���������� true, ���� ������ ��� ��������� � false, ���� �� ������� ����� �������.
 */
function gui_destroy($id) {}


/**
 * ��������� ���������� ������ �� ������.
 * @param int $id ������������� �������.
 * @return bool ���������� true, ���� ������ ��� ��������� � false, ���� �� ������� ����� �������.
 */
function gui_safeDestroy($id) {}


/**
 * �������� �������� �������� �������.
 * @param int $id ������������� �������.
 * @param string $name �������� ��������.
 * @return mixed ��������.
 */
function gui_propGet($id, $name) {}


/**
 * ���������� �������� �������� �������.
 * @param int $id ������������� �������.
 * @param string $name �������� ��������.
 * @param mixed $value ��������.
 */
function gui_propSet($id, $name, $value) {}


/**
 * ��������� �� ������������� �������� �������.
 * @param int $id ������������� �������.
 * @param string $name �������� ��������.
 * @return bool ���������� true, ���� �������� ������� ���������� � false, ���� ���.
 */
function gui_propExists($id, $name) {}


/**
 * ��������� ������ �� ������������ ����.
 * @param int $id ������������� �������.
 * @param string $type ���.
 * @return bool ���������� true, ���� ������ ������������� ���� � false, ���� ���.
 */
function gui_is($id, $type) {}


/**
 * �������� ������������� ���������.
 * @param int $id ������������� �������.
 * @return int ������������� ���������. ���� ��������� ���, ������������ ����.
 */
function gui_owner($id) {}


/**
 * ���������� ��� �������� �������������� ���������� �������.
 * @param int $id ������������� �������.
 * @param string|null $value ��������.
 * @return void|string ���������� ������, ���� $value = null, ����� ������.
 */
function control_helpkeyword($id, $value) {}