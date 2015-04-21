<?php namespace App\Forms\Password;

use Kris\LaravelFormBuilder\Form;

class EmailForm extends Form
{
    public function buildForm()
    {
        $this->setMethod( 'POST' );

        $this->setUrl( route( 'password.email' ) );

        $this->add( 'email', 'email', [ 'label' => trans( 'common.Email' ).':' ] );

        $this->add( 'submit', 'submit', [ 'label' => trans( 'common.Request new password' ), 'attr' => [ 'class' => 'btn btn-lg btn-block btn-success' ] ] );
    }
}