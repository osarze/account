<?php

namespace Osarze\Account\Services;

use Osarze\Account\Models\AccountHistory;
use Osarze\Account\Models\Account;

class AccountService
{
    /**
     * Create new aacount
     *
     * @param $userId
     * @return Account
     */
    public static function createNewAccount($userId): Account
    {
        return Account::create([
            'user_id' => $userId,
            'account_no' => self::generateUniqueAccountNumber(),
        ]);
    }

    /**
     * Genereate a unique account number
     * @return int
     * @throws \Exception
     */
    private static function generateUniqueAccountNumber(): int
    {
        do {
            $accountNumber = random_int(1000000000, 9999999999);
        } while (Account::where('account_no', $accountNumber)->count() !== 0);

        return $accountNumber;
    }

    /**
     * Credit the user account
     *
     * @param Account $account
     * @param float $amount
     */
    public static function creditAccount(Account $account, float $amount)
    {
        $account->balance += $amount;
        $account->save();

        self::logAccountHistory($account, $amount, AccountHistory::TRANSACTION_TYPE['CREDIT']);
    }

    /**
     * Debit the user account
     *
     * @param Account $account
     * @param float $amount
     */
    public static function debitAccount(Account $account, float $amount)
    {
        $account->balance -= $amount;
        $account->save();

        self::logAccountHistory($account, $amount, AccountHistory::TRANSACTION_TYPE['DEBIT']);
    }

    /**
     * Log the transaction history
     *
     * @param Account $account
     * @param float $amount
     * @param $transactionType
     */
    public static function logAccountHistory(Account $account, float $amount, $transactionType)
    {
        AccountHistory::create([
            'account_id' => $account->id,
            'amount' => $amount,
            'transaction_type' => $transactionType,
            'balance_after_transaction' => $account->balance
        ]);
    }
}
