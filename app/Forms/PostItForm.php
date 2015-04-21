<?php namespace App\Forms;

use App\Models\Category;
use App\Models\Product;
use Kris\LaravelFormBuilder\Form;

class PostItForm extends Form
{
    public function buildForm()
    {
        $this->setMethod( 'POST' );

        $this->setUrl( route( 'retrospective.postit.add' ) );

        if ( $this->model ) $this->add( 'id', 'hidden' );

        $this->add( 'board_id', 'hidden', [ 'default_value' => $this->getData('board_id')]);

        $this->add( 'text', 'textarea', [ 'label' => false, 'attr' => [ 'data-resize' => 'true', 'rows' => 2, 'placeholder' => 'Zadejte další bod' ] ] );


        $this->add( 'type', 'select', [ 'label'   => false,
                                        'choices' => [ 'START' => 'START', 'STOP' => 'STOP', 'KEEP DOING' => 'KEEP DOING' ] ] );


        $this->add( 'store', 'submit', [ 'label' => 'Přidat',
                                         'attr'  => [ 'class' => 'btn btn-block btn-success' ] ] );
    }
}