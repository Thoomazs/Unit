<?php namespace App\Support\Repositories\Traits;


trait FileManager
{

    protected $filesystem;

    /**
     * Delete a file|s at a given path.
     *
     * @param  string|array $paths
     *
     * @return bool
     */
    public function deleteFile( $filename )
    {
        // delete file on server
        return (bool)$this->filesystem->delete( public_path().$filename );
    }

    /**
     * Delete directory at a given path.
     *
     * @param string $dirname
     *
     * @return bool
     */
    public function deleteDirectory( $dirname )
    {
        // delete directory on server
        return (bool)$this->filesystem->deleteDirectory( public_path().$dirname );
    }

    /**
     * Upload new file to given path
     *
     * @param string $pathname
     * @param string $file
     *
     * @return string
     */
    public function uploadFile( $pathname, $file )
    {
        // add server public path
        $path = public_path().$pathname;

        // generate unique filename
        $filename = str_random( 12 ).'.'.$file->guessClientExtension();

        // create directory if it not exists
        if ( ! $this->filesystem->isDirectory( $path ) ) $this->filesystem->makeDirectory( $path, 0755, true );

        // copy uploaded file to path
        $file->move( $path, $filename );

        // return local full path to file
        return $pathname.$filename;
    }

}