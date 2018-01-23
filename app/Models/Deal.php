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
    protected $primaryKey = 'ID';

    public static function visi()
    {
        //  filtering parameters
        $filter = (isset($_GET['filter'])) ? (object)$_GET['filter'] : [];

        // query
        $query = DB::table('_DEALS')
            ->selectRaw('_DEALS.*, 
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
            ->orderBy('_DEALS.updated_at', 'DESC')
            //  filtering - conditional query
            ->when($filter, function ($query) use ($filter) {

                //  outlay
                if (isset($filter->outlay)) {
                    $query->where('_DEALS.OUTLAY', (int) $filter->outlay);
                }
                //  name
                if ($filter->name ?? FALSE) {
                    $query->where('_DEALS.NAME', 'like', "%{$filter->name}%");
                }
                //  amount
                if ($filter->amount ?? FALSE) {
                    $query->where('_DEALS.AMOUNT', $filter->amount);
                }
                //  performer
                if ($filter->performer ?? FALSE) {
                    $query->where('_DEALS.PERFORMER', 'like', "%{$filter->performer}%");
                }
                //  object
                if ($filter->objects_id ?? FALSE) {
                    $query->whereIn('_DEALS.OBJECTS_ID', $filter->objects_id);
                }
                //  sections
                if ($filter->sections_id ?? FALSE) {
                    $query->whereIn('_DEALS.SECTIONS_ID', $filter->sections_id);
                }
                //  elements
                if ($filter->elements_id ?? FALSE) {
                    $query->whereIn('_DEALS.ELEMENTS_ID', $filter->elements_id);
                }
                //  types
                if ($filter->types_id ?? FALSE) {
                    $query->whereIn('_DEALS.TYPES_ID', $filter->types_id);
                }
                //  systems
                if ($filter->systems_id ?? FALSE) {
                    $query->whereIn('_DEALS.SYSTEMS_ID', $filter->systems_id);
                }

                return $query;
            })
            ->paginate(config('system_params.deallist_items_per_page', 25));

        if ($filter) {
            $query = $query->appends(['filter' => (array)$filter]);
        }

        return $query;
    }
}
