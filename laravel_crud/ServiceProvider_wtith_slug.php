<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ServiceProvider extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $slug = Str::slug($model->name_en);

            //check if slug with this title already exist
            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $model->slug = $count ? "{$slug}-{$count}" : $slug;
        });

        static::updating(function ($model) {
            $slug = Str::slug($model->name_en);

            //check if slug with this title already exist
            $count = static::where('id', '!=', $model->id)->whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $model->slug = $count ? "{$slug}-{$count}" : $slug;
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_en', 'name_bn', 'slug', 'description_en', 'description_bn', 'contact_person_en', 'contact_person_bn', 'contact_number', 'contact_address_en', 'contact_address_bn', 'logo', 'featured_image', 'featured', 'order', 'status', 'service_provider_type_id', 'parent_company_id', 'created_by', 'updated_by'
    ];

    public function serviceProviderType(){
        return $this->belongsTo('App\Models\ServiceProviderType');
    }

    public function patientVisits(){
        return $this->hasMany('App\Models\PatientVisit');
    }

    public function doctors(){
        return $this->belongsToMany('App\Models\Doctor');
    }

    public function diseases(){
        return $this->belongsToMany('App\Models\Disease');
    }

    public function appointments(){
        return $this->hasMany('App\Models\Appointment');
    }

    public function createdBy(){
        return $this->belongsTo('App\Models\User', 'created_by', 'id');
    }

    public function updatedBy(){
        return $this->belongsTo('App\Models\User', 'updated_by', 'id');
    }
}
