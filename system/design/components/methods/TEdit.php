<?php

return array(
    'parent' => 'TControl',
    'items' => array(
        array(
            'CAPTION' => tm('components.methods.undo'),
            'PROP' => 'undo()',
            'INLINE' => 'undo ( void )'
        ),
        array(
            'CAPTION' => tm('components.methods.select'),
            'PROP' => 'select()',
            'INLINE' => 'select ( int start, int length )'
        ),
        array(
            'CAPTION' => tm('components.methods.selectAll'),
            'PROP' => 'selectAll()',
            'INLINE' => 'selectAll ( void )'
        ),
        array(
            'CAPTION' => tm('components.methods.clearSelected'),
            'PROP' => 'clearSelected()',
            'INLINE' => 'clearSelected ( void )'
        )
    )
);