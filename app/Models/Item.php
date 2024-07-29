<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    protected $perPage = 40;

    public function propertyValues()
    {
        return $this->belongsToMany(PropertyValue::class);
    }


    /**
     * filterByProperties()
     * @param Builder $query
     * @param array $properties
     * @return void
     */
    public function scopeFilterByProperties(Builder $builder, array $properties): void
    {
        foreach ($properties as $key => $value) {
            $builder->where(function($query) use ($key, $value) {
                $query->whereRelation('propertyValues.property', 'slug', 'LIKE', $key);
                if (is_array($value)) {
                    for($i = 0; $i <= count($value) - 1; $i++) {
                        if ($i == 0) {
                            $query->whereRelation('propertyValues', 'value', '=', $value[$i]);
                        } else {
                            $query->orWhereRelation('propertyValues', 'value', '=', $value[$i]);
                        }
                    }

                } else {
                    $query->whereRelation('propertyValues', 'value', '=', $value);
                }
            });
        }
    }

}
