<?php namespace App\Models;

use App\Support\Collection;
use App\Support\Repositories\Traits\FileManager;
use App\Support\Repositories\Traits\Slugable;
use App\Support\Repository;
use Illuminate\Filesystem\Filesystem;


/**
 * Class ProductRepository
 *
 * @package App\Http\Repositories
 */
class ProductRepository extends Repository
{
    use Slugable, FileManager;

    /**
     * Create a product repository instance.
     *
     * @param Product    $product
     * @param Filesystem $filesystem
     */
    function __construct( Product $product, Filesystem $filesystem )
    {
        $this->model      = $product;
        $this->filesystem = $filesystem;
    }


    /**
     * Add basic query
     *
     * @return $this
     */
    public function addBasicQuery()
    {
        $this->query = $this->getQuery()->with( 'categories' )->orderBy( "name", "ASC" );

        return $this;
    }

    /**
     * Search products by name
     *
     * @param $search
     *
     * @return $this
     */
    public function search( $search )
    {
        $this->query = $this->getQuery()->where( "name", "like", "%".$search."%" )->orWhere( "id", "=", $search );

        return $this;
    }

    /**
     * Fill data to model instance
     *
     * @param Product    $role
     * @param Collection $data
     *
     * @return mixed
     */
    public function fillData( Product $product, Collection $data )
    {
        // if updated name -> generate new slug
        $data->slug = $this->createSlug( $data->name, $data->get( 'id', 0 ) );

        // if uploaded new cover photo -> delete the last one
        if ( ! $data->isEmpty( 'upload_image' ) ) $this->deleteFile( $product->image );

        // fill attributes into model
        $product->fill( $data->toArray() );

        // save model to get ID
        $product->save();

        // sync categories
        if ( $data->has( 'categories' ) ) $product->categories()->sync( $data->get( 'categories', [ ] ) );

        if ( ! $data->isEmpty( 'upload_image' ) )
        {
            $product->image = $this->uploadFile( '/uploads/products/'.$product->id.'/', $data->upload_image );
            $product->save();
        }

        return $product;
    }

    /**
     * Check if product have enought in stock
     *
     * @param int $id
     * @param int $quantity
     *
     * @return bool
     */
    public function checkStock( $id, $quantity )
    {
        // find product by its ID
        $product = $this->find( $id );

        // product doesn't exist
        if ( is_null( $product ) ) return false;

        // not enough items in stock
        if ( $product->stock < $quantity ) return false;

        // else OK
        return true;
    }

    /**
     * Reduce stock
     *
     * @param int $id
     * @param int $quantity
     *
     * @return bool
     */
    public function reduceStock( $id, $quantity )
    {
        // find product by its ID
        $product = $this->find( $id );

        // product doesn't exist
        if ( is_null( $product ) ) return false;

        // not enough items in stock
        if ( $product->stock < $quantity ) return false;

        // lower stock
        $product->fill( [ 'id' => $product->id, 'stock' => $product->stock - $quantity ] );

        $product->save();

        return true;
    }

    /**
     * Increase stock
     *
     * @param int $id
     * @param int $quantity
     *
     * @return bool
     */
    public function increaseStock( $id, $quantity )
    {
        // find product by its ID
        $product = $this->find( $id );

        // product doesn't exist
        if ( is_null( $product ) ) return false;

        // lower stock
        $product->fill( [ 'id' => $product->id, 'stock' => $product->stock + $quantity ] );

        $product->save();

        return true;
    }
}