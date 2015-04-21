<?php namespace App\Support\Repositories\Traits;

trait Slugable
{

    /**
     * Create slug from model name
     *
     * @param string $name
     * @param int    $id
     *
     * @return string
     */
    public function createSlug( $name, $id )
    {
        // generate base_slug
        $base_slug = slugify( $name );

        // find model instance from DB
        $model = $this->getModel()->find( $id );

        // get model slug
        $slug = ( $model and $model->slug ) ? $model->slug : $base_slug;

        // test until slug is available
        for ( $i = 1; $this->getModel()->whereSlug( $slug )->where( "id", "!=", $id )->first(); $i++ ) $slug = $base_slug."-".$i;

        return $slug;
    }

}