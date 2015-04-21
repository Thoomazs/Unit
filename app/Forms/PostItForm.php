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

        $this->add( 'text', 'textarea', [ 'label' => trans( 'common.Description' ).':', 'attr' => [ 'data-resize' => 'true' ] ] );


        $this->add( 'type', 'select', [ 'label'   => trans( 'common.Superior' ).':',
                                        'choices' => [ 'START' => 'START', 'STOP' => 'STOP', 'KEEP DOING' => 'KEEP DOING' ] ] );


        $this->add( 'store', 'submit', [ 'label' => trans( 'common.'.( ( $this->model ) ? 'Edit' : 'Store' ) ),
                                         'attr'  => [ 'class' => 'btn btn-lg btn-block btn-'.( ( $this->model ) ? 'success' : 'primary' ) ] ] );
    }
}