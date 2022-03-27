#Installation

You can install the package via composer:

`composer require osarze/account dev-main`


Run Migration
<pre><code>php artisan migrate</code></pre>

## End Points
To create account, Create a Post request
`/account`

To Credit Account Create a Post request to 
`/credit` passing the `amount` and `account` as the request body

To Debit Account Create a Post request to
`/credit` passing the `amount` and `account` as the request body

To check account balance send a Get request to
`{accountNo}/balance` Replacing `accountNo` with the actual account number