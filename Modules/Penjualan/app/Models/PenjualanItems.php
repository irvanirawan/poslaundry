<?php

namespace Modules\Penjualan\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Penjualan\Database\Factories\PenjualanFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use App\Models\User;

class PenjualanItems extends Model
{
    use HasFactory, LogsActivity;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'penjualan_id',
        'item_id',
        'qty',
        'harga',
        'total_harga',
        'keterangan',
        'created_by',
        'updated_by',
    ];

    protected $table = 'penjualan_items';

    protected static function newFactory(): PenjualanItemsFactory
    {
        //return PenjualanItemsFactory::new();
    }

    public function getActivitylogOptions(): LogOptions
    {
        $LogOptions = LogOptions::defaults();
        return $LogOptions->logFillable()->useLogName('model');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        $string = "PenjualanItems {$this->penjualan_id} {$eventName}";
        if ($eventName == 'created') {
            $string = 'PenjualanItems "' . $this->penjualan_id . '" telah dibuat';
        }
        if ($eventName == 'updated') {
            $string = 'PenjualanItems "' . $this->penjualan_id . '" telah diubah';
        }
        if ($eventName == 'deleted') {
            $string = 'PenjualanItems "' . $this->penjualan_id . '" telah dihapus';
        }
        return $string;
    }

    protected static function booted()
    {
        static::creating(function ($penjualan_items) {
            $penjualan_items->created_by = auth()->id();
        });
        static::updating(function ($penjualan_items) {
            $penjualan_items->updated_by = auth()->id();
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

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'penjualan_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
