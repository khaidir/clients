<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\VisitorPerson;
use App\Models\Companies;
use App\Models\Country;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use DB;
use Auth;

class VisitorPersonController extends Controller
{
    public function index()
    {
        return view('admin.visitor-person.index');
    }

    public function getData($id)
    {
        $visitor = VisitorPerson::select('visitor_person.*')
            ->where('visitor_id', $id)
            ->get();

        $visitor->transform(function ($row) {
            $row->docs_citizenship = ($row->citizenship == 'Indonesian') ? 'KTP':'Passport/Kitas';
            return $row;
        });

        return DataTables::of($visitor)
            ->addColumn('action', function ($row) {
                return '
                    <a class="btn btn-sm btn-primary edit" href="/visitor/person/edit/' . $row->id . '">Edit</a>
                    <a class="btn btn-sm btn-danger delete" data-id="'.$row->id.'" href="javascript:void(0);"><i class="bx bxs-trash"></i></a>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create($id = null)
    {
        $countries = Country::all();
        return view('admin.visitor.form-person', compact('id', 'countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'citizenship' => 'required|string',
            'notes' => 'nullable',
            'status' => 'boolean',
        ],[
            'name.required' => 'Name is required',
            'citizenship.required' => 'Citizenship is required',
            'docs_citizenship.required' => 'Docs Citizenship is required',
        ]);

        DB::beginTransaction();
        try {

            $person = VisitorPerson::updateOrCreate([
                'id' => $request->id
            ], $request->only([
                'visitor_id', 'name',
                'citizenship', 'docs_citizenship',
                'notes', 'status',
            ]));

            DB::commit();
            return redirect()->route('visitor-person.index', @$request->visitor_id)->with(['success' => 'Data has been saved']);
        } catch (ValidationException $e)
        {
            DB::rollback();
            return redirect()->route('visitor-person.index', @$request->visitor_id)->with(['warning' => @$e->errors()]);
        } catch (\Exception $e)
        {
            DB::rollback();
            return redirect()->route('visitor-person.index', @$request->visitor_id)->with(['error' => @$e->getMessage()]);
        }
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '.' . $file->extension();
            $file->storeAs('uploads', $filename, 'public');

            return response()->json(['filename' => $filename, 'message' => 'File uploaded successfully'], 200);
        }

        return response()->json(['message' => 'File upload failed'], 400);
    }

    public function edit($id = null)
    {
        $countries = Country::all();
        $data = VisitorPerson::find($id);
        return view('admin.visitor.form-person', compact('data', 'countries'));
    }

    public function destroy($id)
    {

        DB::beginTransaction();
        try {
            $visitor = VisitorPerson::find($id);

            $visitor->delete();

            DB::commit();
            return redirect()->route('visitor-person.index', $visitor->visitor_id)->with(['success' => 'Data delete successfully']);
        } catch (ValidationException $e)
        {
            DB::rollback();
            return redirect()->route('visitor-person.index', $visitor->visitor_id)->with(['warning' => @$e->errors()]);
        } catch (\Exception $e)
        {
            DB::rollback();
            return redirect()->route('visitor-person.index', $visitor->visitor_id)->with(['error' => @$e->getMessage()]);
        }

    }
}
