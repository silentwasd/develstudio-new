<?php


/**
 * Создать компонент.
 * @param string $type Тип компонента.
 * @param int $owner Идентификатор компонента-владельца.
 * @return int Идентификатор созданного компонента. Если создать компонент не удалось, возвращается ноль.
 */
function component_create($type, $owner) {}


/**
 * Освободить объект из памяти.
 * @param int $id Идентификатор объекта.
 * @return bool Возвращает true, если объект был освобождён и false, если не удалось этого сделать.
 */
function gui_destroy($id) {}


/**
 * Безопасно освободить объект из памяти.
 * @param int $id Идентификатор объекта.
 * @return bool Возвращает true, если объект был освобождён и false, если не удалось этого сделать.
 */
function gui_safeDestroy($id) {}


/**
 * Получить значение свойства объекта.
 * @param int $id Идентификатор объекта.
 * @param string $name Название свойства.
 * @return mixed Значение.
 */
function gui_propGet($id, $name) {}


/**
 * Установить значение свойства объекта.
 * @param int $id Идентификатор объекта.
 * @param string $name Название свойства.
 * @param mixed $value Значение.
 */
function gui_propSet($id, $name, $value) {}


/**
 * Проверить на существование свойства объекта.
 * @param int $id Идентификатор объекта.
 * @param string $name Название свойства.
 * @return bool Возвращает true, если свойство объекта существует и false, если нет.
 */
function gui_propExists($id, $name) {}


/**
 * Проверить объект на соответствие типу.
 * @param int $id Идентификатор объекта.
 * @param string $type Тип.
 * @return bool Возвращает true, если объект соответствует типу и false, если нет.
 */
function gui_is($id, $type) {}


/**
 * Получить идентификатор владельца.
 * @param int $id Идентификатор объекта.
 * @return int Идентификатор владельца. Если владельца нет, возвращается ноль.
 */
function gui_owner($id) {}


/**
 * Установить или получить дополнительную информацию объекта.
 * @param int $id Идентификатор объекта.
 * @param string|null $value Значение.
 * @return void|string Возвращает строку, если $value = null, иначе ничего.
 */
function control_helpkeyword($id, $value) {}