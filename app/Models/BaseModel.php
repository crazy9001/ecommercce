<?php
/**
 * Created by PhpStorm.
 * User: PC01
 * Date: 10/24/2018
 * Time: 11:31 AM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    public function scopeSortOrder($query, $direction = 'DESC')
    {
        return $query->orderBy('sort_order', $direction)->orderBy('id', 'DESC');
    }

    public function move($id, $direction = 'up')
    {
        try {
            $current_item = $this->find($id);
            \DB::beginTransaction();
            switch ($direction) {
                case 'up':
                    $select_item = $this->sortOrder('ASC')
                        ->where('sort_order', '>', $current_item->sort_order)
                        ->first();
                    $position = $select_item->sort_order;
                    $select_item->sort_order = $current_item->sort_order;
                    $select_item->save();
                    $current_item->sort_order = $position;
                    $current_item->save();
                    break;
                case 'down':
                    $select_item = $this->sortOrder()
                        ->where('sort_order', '<', $current_item->sort_order)
                        ->select('id', 'sort_order')
                        ->first();
                    $position = $select_item->sort_order;
                    $select_item->sort_order = $current_item->sort_order;
                    $select_item->save();
                    $current_item->sort_order = $position;
                    $current_item->save();
                    break;
                case 'top':
                    $current_item->sort_order = $this->max('sort_order') + 1;
                    $current_item->save();
                    break;
                case 'bottom':
                    $current_item->sort_order = $this->min('sort_order') - 1;
                    $current_item->save();
            }
            \DB::commit();
            return true;
        } catch (\Exception $e) {
            \DB::rollback();
            return false;
        }
    }
}