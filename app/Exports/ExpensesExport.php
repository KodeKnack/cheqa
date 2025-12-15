<?php

namespace App\Exports;

use App\Models\Expense;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExpensesExport implements FromCollection, WithHeadings, WithMapping
{
    protected $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function collection()
    {
        return Expense::with(['category', 'paymentMethod'])
            ->where('user_id', $this->userId)
            ->orderBy('expense_date', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Description',
            'Amount (R)',
            'Category',
            'Payment Method',
            'Date',
            'Created At'
        ];
    }

    public function map($expense): array
    {
        return [
            $expense->description,
            number_format($expense->amount, 2),
            $expense->category->name,
            $expense->paymentMethod->name,
            $expense->expense_date->format('Y-m-d'),
            $expense->created_at->format('Y-m-d H:i:s')
        ];
    }
}