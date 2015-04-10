<?php namespace App\Forms\Admin;

use App\Models\Category;
use App\Models\Product;
use Kris\LaravelFormBuilder\Form;

class CategoryForm extends Form
{
    public function buildForm()
    {
        $this->setData( 'products', toChoices( Product::all() ) );

        $this->setData( 'categories', toChoices( Category::all() ) );

        if ( $this->model ) $this->add( 'id', 'hidden' );

        $this->add( 'name', 'text', [ 'label' => trans( 'common.Name' ).':' ] );

        $this->add( 'desc', 'textarea', [ 'label' => trans( 'common.Description' ).':', 'attr' => [ 'data-resize' => 'true' ] ] );


        $this->add( 'superior_id', 'select', [ 'label'       => trans( 'common.Superior' ).':',
                                               'empty_value' => trans( 'common.select_option' ),
                                               'choices'     => $this->getData( 'categories' )
                                               //                                         'selected'    => ( $this->model ) ? $this->model->superior() : null
        ] );

        $this->add( 'products', 'select', [ 'label'       => trans( 'common.Products' ).':',
                                            'multiple'    => true,
                                            'empty_value' => trans( 'common.select_option' ),
                                            'choices'     => $this->getData( 'products' ),
                                            'selected'    => ( $this->model ) ? $this->model->products()->lists( 'id' ) : null ] );


        $this->add( 'store', 'submit', [ 'label' => trans( 'common.'.( ( $this->model ) ? 'Edit' : 'Store' ) ),
                                         'attr'  => [ 'class' => 'btn btn-lg btn-block btn-'.( ( $this->model ) ? 'success' : 'primary' ) ] ] );
    }
}