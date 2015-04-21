<?php namespace App\Forms\Auth;

use Kris\LaravelFormBuilder\Form;

class LoginForm extends Form
{
    public function buildForm()
    {
        $this->setMethod( 'POST' );

        $this->setUrl( route( 'auth.login' ) );


        $this->add( 'email', 'email', [ 'label' => trans( 'common.Email' ).':' ] );

        $this->add( 'password', 'password', [ 'label' => trans( 'common.Password' ).':' ] );

        $this->add( 'remember', 'checkbox', [ 'label' => trans( 'common.Remember' ).':' ] );

        $this->add( 'submit', 'submit', [ 'label' => trans( 'common.Login' ), 'attr' => [ 'class' => 'btn btn-lg btn-block btn-success' ] ] );
    }
}