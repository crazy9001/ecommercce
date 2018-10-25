<?php
/**
 * Created by PhpStorm.
 * User: PC01
 * Date: 10/25/2018
 * Time: 3:04 PM
 */

namespace App\Http\Controllers\Backend;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends BackendController
{
    public function index(Request $request)
    {
        return view('backend.contact.index');
    }

    public function dataTable()
    {
        return Contact::dataTable();
    }

    public function update($id, Request $request)
    {
        $contact = Contact::find($id);
        if ($contact) {
            $data = $request->except(['_token', 'method']);
            $contact->update($data);
        }
        return $this->response(null, ['datatable' => true]);
    }

    public function destroy($id)
    {
        Contact::find($id)->delete();
        return $this->response(null, ['datatable' => true]);
    }
}