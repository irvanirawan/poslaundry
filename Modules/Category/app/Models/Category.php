<?php

namespace Modules\Category\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Category\Database\Factories\CategoryFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use App\Models\User;
use Modules\CategoryGroup\Models\CategoryGroup;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'kode',
        'nama',
        'status',
        'created_by',
        'updated_by',
        'category_group_id',
    ];
    
    protected $table = 'category';

    protected static function newFactory(): CategoryFactory
    {
        //return CategoryFactory::new();
    }

    public function getActivitylogOptions(): LogOptions
    {
        $LogOptions = LogOptions::defaults();
        return $LogOptions->logFillable()->useLogName('model');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        $string = "Category {$this->kode} {$eventName}";
        if ($eventName == 'created') {
            $string = 'Category "' . $this->kode . '" telah dibuat';
        }
        if ($eventName == 'updated') {
            $string = 'Category "' . $this->kode . '" telah diubah';
        }
        if ($eventName == 'deleted') {
            $string = 'Category "' . $this->kode . '" telah dihapus';
        }
        return $string;
    }

    protected static function booted()
    {
        static::creating(function ($category) {
            $category->created_by = auth()->id();
        });
        static::updating(function ($category) {
            $category->updated_by = auth()->id();
        });
    }

    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedByUser()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function categoryGroup()
    {
        return $this->belongsTo(CategoryGroup::class, 'category_group_id');
    }

    public function items()
    {
        return $this->hasMany(Item::class, 'category_id');
    }
}
