<?php

namespace Modules\Penjualan\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Penjualan\Database\Factories\PenjualanFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use App\Models\User;

class Penjualan extends Model
{
    use HasFactory, LogsActivity;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'kode_penjualan',
        'pelanggan_id',
        'total_harga',
        'total_item',
        'total_bayar',
        'total_kembalian',
        'status',
        'diskon',
        'pajak',
        'total_harga_final',
        'keterangan',
        'created_by',
        'updated_by',
    ];

    protected $table = 'penjualan';

    protected static function newFactory(): PenjualanFactory
    {
        //return PenjualanFactory::new();
    }

    public function getActivitylogOptions(): LogOptions
    {
        $LogOptions = LogOptions::defaults();
        return $LogOptions->logFillable()->useLogName('model');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        $string = "Penjualan {$this->kode_penjualan} {$eventName}";
        if ($eventName == 'created') {
            $string = 'Penjualan "' . $this->kode_penjualan . '" telah dibuat';
        }
        if ($eventName == 'updated') {
            $string = 'Penjualan "' . $this->kode_penjualan . '" telah diubah';
        }
        if ($eventName == 'deleted') {
            $string = 'Penjualan "' . $this->kode_penjualan . '" telah dihapus';
        }
        return $string;
    }

    protected static function booted()
    {
        static::creating(function ($penjualan) {
            $penjualan->created_by = auth()->id();
        });
        static::updating(function ($penjualan) {
            $penjualan->updated_by = auth()->id();
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

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }

    public function items()
    {
        return $this->hasMany(PenjualanItems::class, 'penjualan_id');
    }

    public function getTotalHargaAttribute($value)
    {
        return number_format($value, 0, ',', '.');
    }
}
