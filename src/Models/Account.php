<?php

namespace Osarze\Account\Models;

use Illuminate\Database\Eloquent\Model;
use Osarze\Account\Models\Traits\UseUuid;

class Account extends Model
{
    use UseUuid;

    protected $fillable = [
        'account_no',
        'user_id',
        'book_balance',
        'ledger_balance',
    ];

    public const STATUS = [
        'INACTIVE' => -1,
        'PENDING' => 0,
        'ACTIVE' => 1,
        'DORMANT' => 2,
    ];

    public function setTable($table)
    {
        $this->table = config('account.table_name');

        return $this;
    }
}
