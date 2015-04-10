<?php namespace App\Forms\User;

use App\Models\Role;
use Kris\LaravelFormBuilder\Form;

class EditForm extends Form
{
    public function buildForm()
    {

        $this->setData('roles', toChoices( Role::all()));

        $this->setMethod('PATCH');

        $this->setUrl(route('my-account.profile'));

        $this->add( 'id', 'hidden' );

        $this->add( 'firstname', 'text', [ 'label' => trans( 'common.Firstname' ).':' ] );

        $this->add( 'lastname', 'text', [ 'label' => trans( 'common.Lastname' ).':' ] );

        $this->add( 'email', 'email', [ 'label' => trans( 'common.Email' ).':' ] );

        $this->add( 'password', 'password', [ 'label' => trans( 'common.Password' ).':' ] );

        $this->add( 'password_confirmation', 'password', [ 'label' => trans( 'common.Password_confirmation' ).':' ] );

        $this->add( 'roles', 'select', [ 'label'       => trans( 'common.Roles' ).':',
                                         'multiple'    => true,
                                         'empty_value' => trans( 'common.select_option' ),
                                         'choices'     => $this->getData( 'roles' ),
                                         'selected'    => $this->model->roles()->lists( 'id' ) ] );


        $this->add( 'edit', 'submit', [ 'label' => trans( 'common.Edit' ),
                                         'attr'  => [ 'class' => 'btn btn-lg btn-block btn-success' ] ] );
    }
}