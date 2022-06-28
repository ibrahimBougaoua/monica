<?php

namespace App\Contact\ManageContact\Web\Controllers;

use App\Contact\ManageContact\Services\ToggleArchiveContact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactArchiveController extends Controller
{
    public function update(Request $request, int $vaultId, int $contactId)
    {
        $data = [
            'account_id' => Auth::user()->account_id,
            'author_id' => Auth::user()->id,
            'vault_id' => $vaultId,
            'contact_id' => $contactId,
        ];

        (new ToggleArchiveContact())->execute($data);

        return response()->json([
            'data' => route('contact.show', [
                'vault' => $vaultId,
                'contact' => $contactId,
            ]),
        ], 200);
    }
}
