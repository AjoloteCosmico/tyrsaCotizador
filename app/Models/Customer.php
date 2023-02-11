<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    /** Relaciones uno a muchos */
       
    public function contacts(){
        return $this->hasMany(Contact::class);
    }

    public function quotations(){
        return $this->hasMany(Quotation::class);
    }

    /** Relaciones uno a uno */

    public function customer_classification(){
        return $this->belongsTo(CustomerClassification::class);
    }

    public function customer_types(){
        return $this->belongsTo(CustomerType::class);
    }

    public function sector(){
        return $this->hasOne(Sector::class);
    }

    public function users(){
        return $this->hasOne(User::class);
    }
    
}
