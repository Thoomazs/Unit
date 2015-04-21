<?php namespace App\Forms\Admin;

use App\Models\Category;
use Kris\LaravelFormBuilder\Form;

class ProductForm extends Form
{
    public function buildForm()
    {
        $this->setData( 'categories', toChoices( Category::all() ) );

        if ( $this->model ) $this->add( 'id', 'hidden' );

        $this->add( 'name', 'text', [ 'label' => trans( 'common.Name' ).':' ] );

        $this->add( 'price', 'number', [ 'label' => trans( 'common.Price' ).':' ] );

        $this->add( 'stock', 'number', [ 'label' => trans( 'common.Stock' ).':' ] );

        $this->add( 'perex', 'textarea', [ 'label' => trans( 'common.Perex' ).':', 'attr' => [ 'rows' => 3, 'data-editor' => 'true' ] ] );

        $this->add( 'desc', 'textarea', [ 'label' => trans( 'common.Text' ).':', 'attr' => [ 'rows' => 3, 'data-editor' => 'true' ] ] );

        $this->add( 'keywords', 'textarea', [ 'label' => trans( 'common.Keywords' ).':', 'attr' => [ 'rows' => 1, 'data-resize' => 'true' ] ] );

        $this->add( 'upload_image', 'file', [ 'label' => trans( 'common.Main photo' ).':' ] );

        $this->add( 'photos', 'file', [ 'label' => trans( 'common.Main photo' ).':', 'attr' => [ 'multiple' => true ] ] );


        $this->add( 'categories', 'select', [ 'label'       => trans( 'common.Categories' ).':',
                                              'multiple'    => true,
                                              'empty_value' => trans( 'common.select_option' ),
                                              'choices'     => $this->getData( 'categories' ),
                                              'selected'    => ( $this->model ) ? $this->model->categories()->lists( 'id' ) : null ] );


        $this->add( 'store', 'submit', [ 'label' => trans( 'common.'.( ( $this->model ) ? 'Edit' : 'Store' ) ),
                                         'attr'  => [ 'class' => 'btn btn-lg btn-block btn-'.( ( $this->model ) ? 'success' : 'primary' ) ] ] );
    }
}