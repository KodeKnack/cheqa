<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Expense extends Model
{
    protected $fillable = [
        'description',
        'amount',
        'category_id',
        'payment_method_id',
        'expense_date',
        'user_id'
    ];

    protected $casts = [
        'expense_date' => 'date',
        'amount' => 'decimal:2'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilterByDateRange($query, $range)
    {
        switch ($range) {
            case 'daily':
                return $query->whereDate('expense_date', Carbon::today());
            case 'weekly':
                return $query->whereBetween('expense_date', [
                    Carbon::now()->startOfWeek(),
                    Carbon::now()->endOfWeek()
                ]);
            case 'monthly':
                return $query->whereMonth('expense_date', Carbon::now()->month)
                           ->whereYear('expense_date', Carbon::now()->year);
            case 'yearly':
                return $query->whereYear('expense_date', Carbon::now()->year);
            default:
                return $query;
        }
    }
}