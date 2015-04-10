<?php if ($showLabel && $showField && ! $options[ 'is_child' ]): ?>
<div <?= $options[ 'wrapperAttrs' ] ?> >
    <?php endif; ?>

    <div class="form-relative">
        <div class="checkbox">
            <?php if ( $showField ): ?>
                <?= Form::checkbox( $name, $options[ 'default_value' ], $options[ 'checked' ], $options[ 'attr' ] ) ?>
            <?php endif; ?>

            <?php if ( $showLabel ): ?>
                <?php if ( $options[ 'is_child' ] ): ?>
                    <label <?= $options[ 'labelAttrs' ] ?>><?= $options[ 'label' ] ?></label>
                <?php else: ?>
                    <?= Form::label( $name, $options[ 'label' ], $options[ 'label_attr' ] ) ?>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <?php if ( $showError && isset( $errors ) ): ?>
            <?= $errors->first( array_get( $options, 'real_name', $name ), '<div '.$options[ 'errorAttrs' ].'>:message</div>' ) ?>
        <?php endif; ?>
    </div>

    <?php if ($showLabel && $showField && ! $options[ 'is_child' ]): ?>
</div>
<?php endif; ?>
