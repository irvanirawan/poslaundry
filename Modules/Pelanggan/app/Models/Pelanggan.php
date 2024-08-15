<?php

namespace Modules\Pelanggan\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Pelanggan\Database\Factories\PelangganFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use App\Models\User;

class Pelanggan extends Model
{
    use HasFactory, LogsActivity;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'kode',
        'nama',
        'alamat',
        'telepon',
        'status',
        'created_by',
        'updated_by',
    ];
    
    protected $table = 'pelanggan';

    protected static function newFactory(): PelangganFactory
    {
        //return PelangganFactory::new();
    }
    
    public function getActivitylogOptions(): LogOptions
    {
        $LogOptions = LogOptions::defaults();
        return $LogOptions->logFillable()->useLogName('model');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        $string = "Pelanggan {$this->kode} {$eventName}";
        if ($eventName == 'created') {
            $string = 'Pelanggan "' . $this->kode . '" telah dibuat';
        }
        if ($eventName == 'updated') {
            $string = 'Pelanggan "' . $this->kode . '" telah diubah';
        }
        if ($eventName == 'deleted') {
            $string = 'Pelanggan "' . $this->kode . '" telah dihapus';
        }
        return $string;
    }

    protected static function booted()
    {
        static::creating(function ($pelanggan) {
            $pelanggan->created_by = auth()->id();
        });
        static::updating(function ($pelanggan) {
            $pelanggan->updated_by = auth()->id();
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

    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
