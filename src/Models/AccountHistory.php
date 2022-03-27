<?php

namespace Osarze\Account\Models;

use Illuminate\Database\Eloquent\Model;
use Osarze\Account\Models\Traits\UseUuid;

class AccountHistory extends Model
{
    use UseUuid;

    protected $guarded = [];

    public const TRANSACTION_TYPE = [
        'CREDIT' => 1,
        'DEBIT' => 2,
    ];

    public function setTable($table)
    {
        $this->table = config('account.account_history_table');

        return $this;
    }
}
