<?php

namespace Osarze\Account\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Osarze\Account\Traits\JsonApiResponse;
use Illuminate\Routing\Controller;
use Osarze\Account\Http\Requests\AccountTransactionRequest;
use Osarze\Account\Http\Requests\CreateAccountRequest;
use Osarze\Account\Models\Account;
use Osarze\Account\Services\AccountService;

class AccountController extends Controller
{
    use JsonApiResponse;

    /**
     * Create Account
     *
     * @param CreateAccountRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createAccount(CreateAccountRequest $request): JsonResponse
    {
        $account = AccountService::createNewAccount($request->user_id);
        return $this->successResponse($account->toArray());
    }

    /**
     * Credit User account
     *
     * @param AccountTransactionRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function creditAccount(AccountTransactionRequest $request): JsonResponse
    {
        $account = Account::where('account_no', $request->account_no)->first();

        AccountService::creditAccount($account, $request->amount);

        return $this->successResponse(null, "Account credited successfully");
    }

    /**
     * @param AccountTransactionRequest $request
     * @return JsonResponse
     */
    public function debitAccount(AccountTransactionRequest $request): JsonResponse
    {
        $account = Account::where('account_no', $request->account_no)->first();

        AccountService::debitAccount($account, $request->amount);

        return $this->successResponse(null, "Account debited successfully");
    }

    /**
     * @param $accountNo
     * @return JsonResponse
     */
    public function getBalance($accountNo): JsonResponse
    {
        $account = Account::where('account_no', $accountNo)->firstOrFail();

        return $this->successResponse([
            'balance' => $account->balance
        ]);
    }
}
