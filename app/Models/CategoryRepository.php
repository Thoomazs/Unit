<?php namespace App\Models;

use App\Support\Repositories\Traits\Slugable;
use App\Support\Repository;
use Illuminate\Support\Collection;

/**
 * Class CategoryRepository
 *
 * @package App\Http\Repositories
 */
class CategoryRepository extends Repository
{
    use Slugable;

    /**
     * Create a category repository instance.
     *
     * @param Category $category
     */
    function __construct( Category $category )
    {
        $this->model = $category;
    }

    /**
     * Add basic query
     *
     * @return $this
     */
    public function addBasicQuery()
    {
        $this->query = $this->getQuery()->with( 'products' )->orderBy( "name", "ASC" );

        return $this;
    }

    /**
     * Search
     *
     * @param $search
     *
     * @return $this
     */
    public function search( $search )
    {
        $this->query = $this->getQuery()->where( "name", "like", "%".$search."%" );

        return $this;
    }


    /**
     * Fill data to model instance
     *
     * @param Category   $category
     * @param Collection $data
     *
     * @return mixed
     */
    public function fillData( Category $category, Collection $data )
    {
        $data->slug = $this->createSlug( $data->name, $data->get( 'id', 0 ) );

        if ( $data->isEmpty( 'superior_id' ) ) $data->forget( 'superior_id' );

        $category->fill( $data->toArray() );

        $category->save();

        $category->products()->sync( $data->get( 'products', [ ] ) );

        return $category;
    }
}