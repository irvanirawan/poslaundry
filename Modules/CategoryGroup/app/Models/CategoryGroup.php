<?php

namespace Modules\CategoryGroup\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\CategoryGroup\Database\Factories\CategoryGroupFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use App\Models\User;

class CategoryGroup extends Model
{
    use HasFactory, LogsActivity;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'kode',
        'nama',
        'status',
        'created_by',
        'updated_by',
    ];
    
    protected $table = 'category_group';

    protected static function newFactory(): CategoryGroupFactory
    {
        //return CategoryGroupFactory::new();
    }

    public function getActivitylogOptions(): LogOptions
    {
        $LogOptions = LogOptions::defaults();
        return $LogOptions->logFillable()->useLogName('model');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        $string = "CategoryGroup {$this->kode} {$eventName}";
        if ($eventName == 'created') {
            $string = 'CategoryGroup "' . $this->kode . '" telah dibuat';
        }
        if ($eventName == 'updated') {
            $string = 'CategoryGroup "' . $this->kode . '" telah diubah';
        }
        if ($eventName == 'deleted') {
            $string = 'CategoryGroup "' . $this->kode . '" telah dihapus';
        }
        return $string;
    }

    protected static function booted()
    {
        static::creating(function ($categoryGroup) {
            $categoryGroup->created_by = auth()->id();
        });
        static::updating(function ($categoryGroup) {
            $categoryGroup->updated_by = auth()->id();
        });
    }

    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updatedByUser()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    public function category()
    {
        return $this->hasMany(Category::class, 'category_group_id', 'id');
    }
}
