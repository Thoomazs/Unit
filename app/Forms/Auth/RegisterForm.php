<?php namespace App\Forms\Auth;

use Kris\LaravelFormBuilder\Form;

class RegisterForm extends Form
{
    public function buildForm()
    {

        $this->setMethod('POST');

        $this->setUrl(route('auth.register'));


        $this->add( 'firstname', 'text', [ 'label' => trans( 'common.Firstname' ).':' ] );

        $this->add( 'lastname', 'text', [ 'label' => trans( 'common.Lastname' ).':' ] );

        $this->add( 'email', 'email', [ 'label' => trans( 'common.Email' ).':' ] );

        $this->add( 'password', 'password', [ 'label' => trans( 'common.Password' ).':' ] );

        $this->add( 'password_confirmation', 'password', [ 'label' => trans( 'common.Password_confirmation' ).':' ] );

        $this->add( 'submit', 'submit', [ 'label' => trans( 'common.Register' ), 'attr' => [ 'class' => 'btn btn-lg btn-block btn-success' ] ] );
    }
}