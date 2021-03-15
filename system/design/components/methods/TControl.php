<?php

return array(
    'parent' => 'TComponent',
    'items' => array(
        array(
            'CAPTION' => tm('components.methods.show'),
            'PROP' => 'show()',
            'INLINE' => 'show ( void )',
        ),
        array(
            'CAPTION' => tm('components.methods.hide'),
            'PROP' => 'hide()',
            'INLINE' => 'hide ( void )',
        ),
        array(
            'CAPTION' => tm('components.methods.setFocus'),
            'PROP' => 'setFocus()',
            'INLINE' => 'setFocus ( void )',
        ),
        array(
            'CAPTION' => tm('components.methods.setDate'),
            'PROP' => 'setDate()',
            'INLINE' => 'setDate ( void )',
        ),
        array(
            'CAPTION' => tm('components.methods.setTime'),
            'PROP' => 'setTime()',
            'INLINE' => 'setTime ( void )',
        ),
        array(
            'CAPTION' => tm('components.methods.toBack'),
            'PROP' => 'toBack()',
            'INLINE' => 'toBack ( void )',
        ),
        array(
            'CAPTION' => tm('components.methods.toFront'),
            'PROP' => 'toFront()',
            'INLINE' => 'toFront ( void )',
        ),
        array(
            'CAPTION' => tm('components.methods.invalidate'),
            'PROP' => 'invalidate()',
            'INLINE' => 'invalidate ( void )',
        ),
        array(
            'CAPTION' => tm('components.methods.repaint'),
            'PROP' => 'repaint()',
            'INLINE' => 'repaint ( void )',
        ),
        array(
            'CAPTION' => tm('components.methods.perform'),
            'PROP' => 'perform',
            'INLINE' => 'perform ( string msg, int hparam, int lparam )',
        )
    )
);