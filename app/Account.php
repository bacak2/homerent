<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Account extends Model
{
    protected $languageId;

    public function getOtherEquipment($finds, $languageId){

        $this->languageId = $languageId;

        $finds->each(function ($item) {
            $equipment = DB::table("apartament_other_equipments")
                ->where('language_id', $this->languageId)
                ->whereRaw("equipment_id IN ($item->apartament_other_equipment)")
                ->pluck('equipment_name');
            $equipmentList = '';
            $i = 0;
            $len = count($equipment);
            foreach($equipment as $key=>$value){
                $equipmentList .= $value;
                if ($i == $len - 1) continue;
                $equipmentList .= ', ';
                $i++;
            }
            $item->apartament_other_equipment = $equipmentList;
        });

        $finds->each(function ($item) {
            $equipment = DB::table("apartament_other_equipments")
                ->where('language_id', $this->languageId)
                ->whereRaw("equipment_id IN ($item->apartament_other_bathroom_equipment)")
                ->pluck('equipment_name');
            $equipmentList = '';
            $i = 0;
            $len = count($equipment);
            foreach($equipment as $key=>$value){
                $equipmentList .= $value;
                if ($i == $len - 1) continue;
                $equipmentList .= ', ';
                $i++;
            }
            $item->apartament_other_bathroom_equipment = $equipmentList;
        });

        $finds->each(function ($item) {
            $equipment = DB::table("apartament_other_equipments")
                ->where('language_id', $this->languageId)
                ->whereRaw("equipment_id IN ($item->apartament_cooker)")
                ->pluck('equipment_name');
            $equipmentList = '';
            $i = 0;
            $len = count($equipment);
            foreach($equipment as $key=>$value){
                $equipmentList .= $value;
                if ($i == $len - 1) continue;
                $equipmentList .= ', ';
                $i++;
            }
            $item->apartament_cooker = $equipmentList;
        });

        return $finds;
    }
}
