<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Deal extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = '_DEALS';

    public static function visi()
    {

        $query = DB::table('_DEALS')
            ->selectRaw('_DEALS.ID, _DEALS.ORDER, _DEALS.OUTLAY, _DEALS.NAME, _DEALS.AMOUNT, _DEALS.PERFORMER, 
                        _OBJECTS.NR OBJECT_NR, _OBJECTS.NAME OBJECT_NAME, 
                        _ELEMENTS.NR ELEMENT_NR, _ELEMENTS.NAME ELEMENT_NAME,
                        _TYPES.NR TYPE_NR, _TYPES.NAME TYPE_NAME,
                        _SECTIONS.NR SECTION_NR, _SECTIONS.NAME SECTION_NAME,
                        _SYSTEMS.NR SYSTEM_NR, _SYSTEMS.NAME SYSTEM_NAME')
            ->leftJoin('_OBJECTS', '_DEALS.OBJECTS_ID', '=', '_OBJECTS.ID')
            ->leftJoin('_ELEMENTS', '_DEALS.ELEMENTS_ID', '=', '_ELEMENTS.ID')
            ->leftJoin('_TYPES', '_DEALS.TYPES_ID', '=', '_TYPES.ID')
            ->leftJoin('_SECTIONS', '_DEALS.SECTIONS_ID', '=', '_SECTIONS.ID')
            ->leftJoin('_SYSTEMS', '_DEALS.SYSTEMS_ID', '=', '_SYSTEMS.ID')
            ->paginate(25);

        return $query;
    }
}
