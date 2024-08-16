<?php

namespace Modules\Items\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Items\Database\Factories\ItemsFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use App\Models\User;
use Modules\Category\Models\Category;
use Modules\CategoryGroup\Models\CategoryGroup;

class Items extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'kode',
        'nama',
        'status',
        'kelompok_id',
        'kategori_id',
        'satuan',
        'hargajual',
        'hargamodal',
        'stok',
        'stokmin',
        'stokmax',
        'keterangan',
        'gambar',
        'created_by',
        'updated_by',
    ];
    
    protected $table = 'items';
    
    protected static function newFactory(): ItemsFactory
    {
        //return ItemsFactory::new();
    }

    public function getActivitylogOptions(): LogOptions
    {
        $LogOptions = LogOptions::defaults();
        return $LogOptions->logFillable()->useLogName('model');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        $string = "Items {$this->kode} {$eventName}";
        if ($eventName == 'created') {
            $string = 'Items "' . $this->kode . '" telah dibuat';
        }
        if ($eventName == 'updated') {
            $string = 'Items "' . $this->kode . '" telah diubah';
        }
        if ($eventName == 'deleted') {
            $string = 'Items "' . $this->kode . '" telah dihapus';
        }
        return $string;
    }

    protected static function booted()
    {
        static::creating(function ($items) {
            $items->created_by = auth()->id();
        });
        static::updating(function ($items) {
            $items->updated_by = auth()->id();
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

    public function category()
    {
        return $this->belongsTo(Category::class, 'kategori_id');
    }

    public function categoryGroup()
    {
        return $this->belongsTo(CategoryGroup::class, 'kelompok_id');
    }
}
