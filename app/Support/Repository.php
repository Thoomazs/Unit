<?php namespace App\Support;

/**
 * Class Repository
 *
 * @package App\Support
 */
abstract class Repository
{

    /**
     * @var Model
     */
    protected $model;

    /**
     * @var Query
     */
    protected $query;

    /**
     * Get Model
     *
     * @return Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Get Query Builder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getQuery()
    {
        if ( is_null( $this->query ) ) $this->query = $this->getModel()->newQuery();

        return $this->query;
    }

    /**
     * Add basic query
     *
     * @return $this
     */
    public function addBasicQuery()
    {
        $this->query = $this->getQuery();

        return $this;
    }

    /**
     * Return all model instance
     *
     * @return Collection
     */
    public function all( $columns = [ '*' ] )
    {
        $this->addBasicQuery();

        $data = $this->getQuery()->get( $columns );

        $this->query = null;

        return $data;
    }

    /**
     * Return first model instance
     *
     * @return Collection
     */
    public function first( $columns = [ '*' ] )
    {
        $this->addBasicQuery();

        $data = $this->getQuery()->get( $columns );

        $this->query = null;

        if(count($data) == 0) return null;

        return $data[0];
    }

    /**
     * Return all model instance paginated
     *
     * @return Collection
     */
    public function paginate( $perPage = 50, $columns = [ '*' ] )
    {
        $this->addBasicQuery();

        $data = $this->getQuery()->paginate( $perPage, $columns );

        $this->query = null;

        return $data;
    }

    /**
     * Find model instance
     *
     * @param int $id
     *
     * @return mixed
     */
    public function find( $id )
    {
        return $this->getModel()->find( $id );
    }

    /**
     * Create model instance
     *
     * @param array $data
     *
     * @return Model
     */
    public function create( array $data )
    {
        // create new model instance
        $model = $this->getModel()->newInstance();

        // fill data
        if ( method_exists( $this, 'fillData' ) )
        {
            $model = $this->fillData( $model, Collection::make( $data ) );
        }
        else $model->fill( $data );

        // persist data
        $model->save();

        // Logger
        \Event::fire( 'entity.created: '.get_class( $model ), $model );

        // return created model
        return $model;
    }

    /**
     * Update model instance
     *
     * @param array $data
     *
     * @return Model
     */
    public function update( array $data )
    {
        // find model by its ID
        $model = $this->getModel()->findOrNew( $data[ 'id' ] );

        // fill data
        if ( method_exists( $this, 'fillData' ) )
        {
            $model = $this->fillData( $model, Collection::make( $data ) );
        }
        else $model->fill( $data );

        // persist data
        $model->save();

        // Logger
        \Event::fire( 'entity.updated: '.get_class( $model ), $model );

        // return updated model
        return $model;
    }

    /**
     * Delete model
     *
     * @param $id
     *
     * @return bool
     */
    public function delete( $id )
    {
        // try to find model
        $model = $this->getModel()->find( $id );

        // if it doesn't exist
        if ( is_null( $model ) ) return false;

        $model->delete();

        // Logger
        \Event::fire( 'entity.deleted: '.get_class( $model ), $model );

        return true;
    }

}