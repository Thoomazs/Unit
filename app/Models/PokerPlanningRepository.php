<?php namespace App\Models;

use App\Support\Collection;
use App\Support\Repositories\Traits\FileManager;
use App\Support\Repositories\Traits\Slugable;
use App\Support\Repository;
use Illuminate\Support\Facades\Cookie;

/**
 * Class PokerPlanningRepository
 *
 * @package App\Http\Repositories
 */
class PokerPlanningRepository extends Repository
{
    use Slugable, FileManager;


    function __construct( PokerPlanning $poker )
    {
        $this->model = $poker;
    }



}