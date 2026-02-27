@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')

@include('layouts.navbars.auth.topnav', ['title' => 'Edit ISO Clause'])

<div class="container-fluid py-4">

<div class="row">
<div class="col-md-12">

<div class="card">

<div class="card-header pb-0">
<h6>Edit ISO Clause</h6>
</div>

<div class="card-body">

@include('components.alert')

<form
action="{{ url($url_menu.'/'.encrypt($row->idclauses)) }}"
method="POST">

@csrf
@method('PUT')

<div class="row">

<div class="col-md-4">

<label class="form-label">Standar ISO</label>

<select
name="idstandards"
class="form-control"
required>

<option value="">-- Pilih ISO --</option>

@foreach($isoStandards as $iso)

<option
value="{{ $iso->idstandards }}"
{{ $row->idstandards == $iso->idstandards ? 'selected' : '' }}>

{{ $iso->code }} - {{ $iso->name }}

</option>

@endforeach

</select>

</div>


<div class="col-md-4">

<label class="form-label">Nomor Klausul</label>

<input
type="text"
name="clause_number"
class="form-control"
value="{{ $row->clause_number }}"
required>

</div>


<div class="col-md-4">

<label class="form-label">Level</label>

<input
type="number"
class="form-control"
value="{{ $row->level }}"
readonly>

</div>

</div>


<div class="row mt-3">

<div class="col-md-12">

<label class="form-label">Nama Klausul</label>

<input
type="text"
name="clause_name"
class="form-control"
value="{{ $row->clause_name }}"
required>

</div>

</div>


<div class="row mt-3">

<div class="col-md-12">

<label class="form-label">Deskripsi</label>

<textarea
name="description"
class="form-control"
rows="4">

{{ $row->description }}

</textarea>

</div>

</div>


<div class="mt-4">

<button class="btn btn-primary">
<i class="fas fa-save me-1"></i>
Update
</button>

<a
href="{{ url($url_menu) }}"
class="btn btn-secondary">

Kembali

</a>

</div>

</form>

</div>

</div>

</div>

</div>

</div>

@endsection