<?php if ($showLabel && $showField): ?>
<div <?= $options[ 'wrapperAttrs' ] ?> >
    <?php endif; ?>

    <?php if ( $showLabel ): ?>
        <?= Form::label( $name, $options[ 'label' ], $options[ 'label_attr' ] ) ?>
    <?php endif; ?>

    <div class="form-relative">
        <?php if ( $showField ): ?>

            <?php if ( ! isset($options[ 'multiple' ]) ) $options[ 'multiple' ] = false; ?>

            <?php if ( $options[ 'multiple' ] ): ?>
                <ul class="list-group select hidden">
                    <?php foreach ( (array)$options[ 'selected' ] as $v ):  ?>
                        <?= Form::hidden( $name, $v ) ?>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>


            <?php $emptyVal = $options[ 'empty_value' ] ? [ '' => $options[ 'empty_value' ] ] : null; ?>
            <?php if ( $options[ 'multiple' ] ) $options[ 'attr' ][ 'class' ] .= ' multiple'; ?>
            <?php if ( $options[ 'multiple' ] ) $options[ 'attr' ][ 'data-name' ] = $name; ?>
            <div class="form-select">
                <?= Form::select( $options[ 'multiple' ] ? "{$name}-select" : $name, (array)$emptyVal + $options[ 'choices' ], (array)$options[ 'selected' ], $options[ 'attr' ] ) ?>
            </div>

        <?php endif; ?>
    </div>


    <?php if ( $showError && isset( $errors ) ): ?>
        <?= $errors->first( array_get( $options, 'real_name', $name ), '<div '.$options[ 'errorAttrs' ].'>:message</div>' ) ?>
    <?php endif; ?>

    <?php if ($showLabel && $showField): ?>
</div>
<?php endif; ?>
