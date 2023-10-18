<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'tracking_code',
        'name',
        'phone',
        'service_type',
        'is_fastest',
        'reservation_datetime',
        'price',
        'end_at'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected $casts = [
        'reservation_datetime' => 'datetime',
        'end_at' => 'datetime'
    ];

    public function getPrice()
    {
        $priceMapping = [
            'wash-basin' => 25000,
            'interior-cleaning' => 30000,
            'zero-washing' => 80000,
        ];

        return $priceMapping[$this->service_type] ?? 0;
    }

    public function formattedPrice()
    {
        return number_format($this->getPrice()) . ' T';
    }

    public function hasExpired()
    {
        if ($this->end_at) {
            $currentTime = Carbon::now();
            return $this->end_at->isPast();
        }

        return false;
    }
}
