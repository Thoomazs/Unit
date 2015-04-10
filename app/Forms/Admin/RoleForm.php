<?php namespace App\Forms\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Kris\LaravelFormBuilder\Form;

class RoleForm extends Form
{
    public function buildForm()
    {
        $this->setData( 'users', toChoices( User::all() ) );

        if ( $this->model ) $this->add( 'id', 'hidden' );

        $this->add( 'name', 'text', [ 'label' => trans( 'common.Name' ).':' ] );

        $this->add( 'users', 'select', [ 'label'       => trans( 'common.Users' ).':',
                                              'multiple'    => true,
                                              'empty_value' => trans( 'common.select_option' ),
                                              'choices'     => $this->getData( 'users' ),
                                              'selected'    => ( $this->model ) ? $this->model->users()->lists( 'id' ) : null ] );




        $this->add( 'store', 'submit', [ 'label' => trans( 'common.'.( ( $this->model ) ? 'Edit' : 'Store' ) ),
                                         'attr'  => [ 'class' => 'btn btn-lg btn-block btn-'.( ( $this->model ) ? 'success' : 'primary' ) ] ] );
    }
}