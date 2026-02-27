<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class IsoclsController extends MasterController
{

    public function index($data)
    {
        
        $data['list'] = DB::table('mst_iso_clauses as c')
            ->leftJoin('mst_iso_standards as s', 's.idstandards', '=', 'c.idstandards')
            ->select(
                'c.*',
                DB::raw("concat(s.code,' - ',s.name) as iso_name")
            )
            ->orderBy('c.clause_number')
            ->get();

        return view('master.isocls.list', $data);
    }


    public function add($data)
    {
        $data['isoStandards'] = DB::table('mst_iso_standards')
            ->where('isactive', '1')
            ->orderBy('code')
            ->get();

        return view('master.isocls.add', $data);
    }


    public function store($data)
    {
        try {

            $idstandards = request()->input('idstandards');
            $clauseNumbers = request()->input('clause_number');
            $clauseNames = request()->input('clause_name');
            $descriptions = request()->input('description');

            if (!$idstandards) {
                Session::flash('message', 'Standar ISO wajib dipilih!');
                Session::flash('class', 'danger');
                return redirect($data['url_menu']);
            }

            if (!$clauseNumbers) {
                Session::flash('message', 'Minimal 1 klausul harus diisi!');
                Session::flash('class', 'danger');
                return redirect($data['url_menu']);
            }

            foreach ($clauseNumbers as $key => $number) {

                if (!$number || !$clauseNames[$key]) {
                    continue;
                }

                DB::table('mst_iso_clauses')->insert([
                    'idstandards'   => $idstandards,
                    'clause_number' => $number,
                    'clause_name'   => $clauseNames[$key],
                    'description'   => $descriptions[$key] ?? null,
                    'parent_id'     => null,
                    'level'         => 1,
                    'isactive'      => '1',
                    'user_create'   => session('username'),
                    'created_at'    => now(),
                ]);
            }

            Session::flash('message', 'Tambah Data Berhasil!');
            Session::flash('class', 'success');

            return redirect($data['url_menu']);

        } catch (\Exception $e) {

            Session::flash('message', $e->getMessage());
            Session::flash('class', 'danger');

            return redirect($data['url_menu']);
        }
    }

  public function destroy($data)
    {
        try {

            $id = decrypt($data['idencrypt']);

            DB::table('mst_iso_clauses')
            ->where('idclauses',$id)
            ->update([
                'isactive' => '0',
                'user_update' => session('username'),
                'updated_at' => now()
            ]);

            Session::flash('message','Data berhasil dinonaktifkan!');
            Session::flash('class','success');

            return redirect($data['url_menu']);

        } catch (\Exception $e) {

            Session::flash('message',$e->getMessage());
            Session::flash('class','danger');

            return redirect($data['url_menu']);
        }
    }


    public function edit($data)
    {
        $id = decrypt($data['idencrypt']);

        $data['row'] = DB::table('mst_iso_clauses')
            ->where('idclauses', $id)
            ->first();

        $data['isoStandards'] = DB::table('mst_iso_standards')
            ->where('isactive', '1')
            ->orderBy('code')
            ->get();

        return view('master.isocls.edit', $data);
    }

    public function update($data)
    {
        try {

            $id = decrypt($data['idencrypt']);

            DB::table('mst_iso_clauses')
            ->where('idclauses', $id)
            ->update([

                'idstandards' => request('idstandards'),
                'clause_number' => request('clause_number'),
                'clause_name' => request('clause_name'),
                'description' => request('description'),

                'user_update' => session('username'),
                'updated_at' => now()

            ]);

            Session::flash('message','Edit Data Berhasil!');
            Session::flash('class','success');

            return redirect($data['url_menu']);

        } catch(\Exception $e){

            Session::flash('message',$e->getMessage());
            Session::flash('class','danger');

            return redirect($data['url_menu']);
        }
    }

    public function show($data)
    {
        try {

            $idEncrypt = request()->segment(3);
            $id = decrypt($idEncrypt);

            $data['row'] = DB::table('mst_iso_clauses as c')
                ->leftJoin('mst_iso_standards as s','s.idstandards','=','c.idstandards')
                ->select(
                    'c.*',
                    's.code',
                    's.name',
                    's.version_year'
                )
                ->where('c.idclauses',$id)
                ->first();

            return view('master.isocls.show',$data);

        } catch(\Exception $e){

            Session::flash('message','Data tidak ditemukan');
            Session::flash('class','danger');

            return redirect($data['url_menu']);
        }
    }
    
}
