<?php if ($showLabel && $showField && ! $options[ 'is_child' ]): ?>
<div <?= $options[ 'wrapperAttrs' ] ?> >
<?php endif; ?>

    <?php if ( $showLabel ): ?>
        <?= Form::label( $name, ucfirst( $options[ 'label' ] ), $options[ 'label_attr' ] ) ?>
    <?php endif; ?>

    <?php if ($showLabel && $showField): ?>
        <div class="form-relative">
    <?php endif; ?>
        <?php if ( $showField ): ?>

            <?php if ( $type == 'file' ): ?>
                <div class="form-file">

<!--                    <a href="--><?//= $options[ 'default_value'] ?><!--" data-popup='true'>-->
<!--                        <img src="--><?//= $options[ 'default_value'] ?><!--"/>-->
<!--                    </a>-->

                    <span class="text" data-title="<?= trans('common.choose_file') ?>"><?= trans('common.choose_file') ?></span>
                    <?= Form::input( $type, $name, $options[ 'default_value' ], $options[ 'attr' ] ) ?>
                </div>

            <?php else: ?>
                <?= Form::input( $type, $name, $options[ 'default_value' ], $options[ 'attr' ] ) ?>
            <?php endif; ?>

        <?php endif; ?>

        <?php if ( $showError && isset( $errors ) ): ?>
            <?= $errors->first( array_get( $options, 'real_name', $name ), '<div '.$options[ 'errorAttrs' ].'>:message</div>' ) ?>
        <?php endif; ?>

        <?php if ($showLabel && $showField): ?>
            </div>
        <?php endif; ?>

    <?php if ($showLabel && $showField && ! $options[ 'is_child' ]): ?>
</div>
<?php endif; ?>
