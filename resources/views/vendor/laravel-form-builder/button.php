<?php if ($showLabel && $showField): ?>
    <div <?= $options[ 'wrapperAttrs' ] ?> >
<?php endif; ?>
    <?= Form::button( $options[ 'label' ], $options[ 'attr' ] ) ?>
<?php if ($showLabel && $showField ): ?>
    </div>
<?php endif; ?>
