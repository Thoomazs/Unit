<?php namespace App\Forms\Password;

use Kris\LaravelFormBuilder\Form;

class ResetForm extends Form
{
    public function buildForm()
    {

        $this->setMethod('POST');

        $this->setUrl(route('password.reset'));

        $this->add( 'token', 'hidden', [ 'default_value' => $this->getData('token') ] );

        $this->add( 'email', 'email', [ 'label' => trans( 'common.Email' ).':' ] );

        $this->add( 'password', 'password', [ 'label' => trans( 'common.Password' ).':' ] );

        $this->add( 'password_confirmation', 'password', [ 'label' => trans( 'common.Password_confirmation' ).':' ] );

        $this->add( 'submit', 'submit', [ 'label' => trans( 'common.Reset Password' ), 'attr' => [ 'class' => 'btn btn-lg btn-block btn-success' ] ] );
    }
}