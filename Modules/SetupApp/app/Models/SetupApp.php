<?php

namespace Modules\SetupApp\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SetupApp\Database\Factories\SetupAppFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use App\Models\User;

class SetupApp extends Model
{
    use HasFactory, LogsActivity;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'pajak_pb1',
        'struk_header1',
        'struk_header2',
        'struk_header3',
        'struk_header4',
        'struk_header5',
        'struk_footer1',
        'struk_footer2',
        'struk_footer3',
        'struk_footer4',
        'struk_footer5',
        'created_by',
        'updated_by',
    ];
    
    protected $table = 'setup_app';

    protected static function newFactory(): SetupAppFactory
    {
        //return SetupAppFactory::new();
    }

    public function getActivitylogOptions(): LogOptions
    {
        $LogOptions = LogOptions::defaults();
        return $LogOptions->logFillable()->useLogName('model');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        $string = "SetupApp {$this->pajak_pb1} {$eventName}";
        if ($eventName == 'created') {
            $string = 'SetupApp "' . $this->pajak_pb1 . '" telah dibuat';
        }
        if ($eventName == 'updated') {
            $string = 'SetupApp "' . $this->pajak_pb1 . '" telah diubah';
        }
        if ($eventName == 'deleted') {
            $string = 'SetupApp "' . $this->pajak_pb1 . '" telah dihapus';
        }
        return $string;
    }

    protected static function booted()
    {
        static::creating(function ($setupApp) {
            $setupApp->created_by = auth()->id();
        });

        static::updating(function ($setupApp) {
            $setupApp->updated_by = auth()->id();
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
}
