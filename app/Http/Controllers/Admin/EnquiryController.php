<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enquiry;

class EnquiryController extends Controller
{
  public function index()
  {
    $enquiry = Enquiry::all();
    return view('admin.enquiry', compact('enquiry'));
  }
  public function store(Request $request)
  {
    dd($request->all());
    $data =   $request->validate([
      'name' => 'required',
      'email' => 'required',
      'subject' => 'required',
      'message' => 'required',
      'status' => 'required',
    ]);
    Enquiry::create($data);
    return redirect("contact")->with("success", "Data submit Successfully");
  }
  public function status(Request $request)
  {
    $enqId = $request->enqueryId;
    Enquiry::where("id", $enqId)->update(["status" => 2]);
    echo '<button class="btn btn-success">Read</button>';
  }

  public function destroy($id)
  {
    $enqry =   Enquiry::findOrFail($id);
    $enqry->delete();
    return back()->with('success', 'Data delete Successfully');
  }
}
