@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')

@include('layouts.navbars.auth.topnav', ['title' => $title_menu ?? 'ISO Clauses'])

@php
$dataList = [];

if (isset($list)) {
    $dataList = $list;
} elseif (isset($result)) {
    $dataList = $result;
} elseif (isset($query)) {
    $dataList = $query;
} elseif (isset($data['list'])) {
    $dataList = $data['list'];
}
@endphp

<div class="container-fluid">
<div class="row">
<div class="col-md-12">

<div class="card">

{{-- HEADER --}}
<div class="card-header d-flex justify-content-between align-items-center">

<h5 class="mb-0">
List {{ $title_menu ?? 'ISO Clauses' }}
</h5>

@include('components.alert')

</div>

<hr class="horizontal dark mt-0">

{{-- ACTION BUTTON --}}
<div class="px-4 py-2">

<div class="d-flex gap-2">

@if(isset($authorize) && $authorize->add == '1')
<button
class="btn btn-primary btn-sm"
onclick="window.location='{{ URL::to($url_menu.'/add') }}'">

<i class="fas fa-plus me-1"></i>
Tambah

</button>
@endif

@if(isset($authorize) && $authorize->excel == '1')

<button class="btn btn-success btn-sm" id="btnExcel">

<i class="fas fa-file-excel me-1"></i>
Export Excel

</button>

@endif
@if(isset($authorize) && $authorize->pdf == '1')

<button class="btn btn-danger btn-sm" id="btnPdf">
<i class="fas fa-file-pdf me-1"></i>
Export PDF

</button>

@endif
</div>
</div>

{{-- TABLE --}}
<div class="px-4 py-2">

<div class="table-responsive">

<table
id="list_iso"
class="table table-bordered table-striped align-items-center mb-0"
style="width:100%">

<thead style="background-color:#00b7bd4f">

<tr>

<th class="text-center text-xs font-weight-bold">No</th>
<th class="text-center text-xs font-weight-bold">Standar ISO</th>
<th class="text-center text-xs font-weight-bold">No Klausul</th>
<th class="text-center text-xs font-weight-bold">Nama Klausul</th>
<th class="text-center text-xs font-weight-bold">Level</th>
<th class="text-center text-xs font-weight-bold">Status</th>
<th class="text-center text-xs font-weight-bold">Aksi</th>

</tr>

</thead>

<tbody>

@foreach ($dataList as $key => $row)

<tr>

<td class="text-center text-sm">
{{ $key + 1 }}
</td>

<td class="text-center text-sm">
{{ $row->iso_name ?? '-' }}
</td>

<td class="text-center text-sm">
{{ $row->clause_number ?? '-' }}
</td>

<td class="text-sm fw-bold">
{{ $row->clause_name ?? '-' }}
</td>

<td class="text-center text-sm">
<span class="badge bg-secondary">
{{ $row->level ?? '-' }}
</span>
</td>

<td class="text-center text-sm">

@if (($row->isactive ?? '0') == '1')

<span class="badge bg-success">
Active
</span>

@else

<span class="badge bg-danger">
Inactive
</span>

@endif

</td>

<td class="text-center">

{{-- VIEW --}}
@if(isset($authorize))

<a
href="{{ URL::to($url_menu.'/show/'.encrypt($row->idclauses)) }}"
class="btn btn-sm btn-info">

<i class="fas fa-eye"></i>

</a>

@endif


{{-- EDIT --}}
@if(isset($authorize) && $authorize->edit == '1')

<a
href="{{ URL::to($url_menu.'/edit/'.encrypt($row->idclauses)) }}"
class="btn btn-warning btn-sm">

<i class="fas fa-edit"></i>

</a>

@endif


{{-- DELETE --}}
@if(isset($authorize) && $authorize->delete == '1')

<form
action="{{ url($url_menu.'/'.encrypt($row->idclauses)) }}"
method="POST"
class="d-inline form-delete"
data-name="{{ $row->clause_name }}">

@csrf
@method('DELETE')

<button type="submit" class="btn btn-sm btn-danger">
<i class="fas fa-trash"></i>
</button>

</form>

@endif

</td>

</tr>

@endforeach

</tbody>

</table>

</div>
</div>

</div>

</div>
</div>
</div>

@endsection


@push('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.29/jspdf.plugin.autotable.min.js"></script>

<script>
$(document).ready(function(){
let table = $('#list_iso').DataTable({
language:{
paginate:{
previous:"<i class='fas fa-angle-left'></i>",
next:"<i class='fas fa-angle-right'></i>"
}
},

ordering:true,
info:true,
autoWidth:false,
responsive:true

});


/* DELETE CONFIRM */
$('.form-delete').submit(function(e){

e.preventDefault();

let form = this;
let name = $(this).data('name');

Swal.fire({
title: 'Apakah anda yakin?',
text: "Data " + name + " akan dinonaktifkan!",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#fe3333',
cancelButtonColor: '#3085d6',
confirmButtonText: 'Ya, hapus!',
cancelButtonText: 'Batal'
}).then((result)=>{

if(result.isConfirmed){
form.submit();
}

});

});
/* EXPORT EXCEL */
$('#btnExcel').click(function(){

let table = document.getElementById("list_iso");
let rows = table.querySelectorAll("tbody tr");

let csv = [];

/* HEADER */

let headers = [];
document.querySelectorAll("#list_iso thead th").forEach(function(th,index){

if(index != 6){ // skip kolom aksi
headers.push(th.innerText.trim());
}

});

csv.push(headers.join(","));

/* BODY */

rows.forEach(function(row){

let cols = row.querySelectorAll("td");
let rowData = [];

cols.forEach(function(col,index){

if(index != 6){

let text = col.innerText
.replace(/\n/g," ")
.replace(/\s+/g," ")
.trim();

rowData.push('"' + text + '"');

}

});

csv.push(rowData.join(","));

});


/* DOWNLOAD */

let csvFile = new Blob([csv.join("\n")],{
type:"application/vnd.ms-excel"
});

let downloadLink = document.createElement("a");

downloadLink.download = "ISO_CLAUSES_EXPORT.xls";
downloadLink.href = window.URL.createObjectURL(csvFile);

downloadLink.click();

});
/* EXPORT PDF */

$('#btnPdf').click(function(){

const { jsPDF } = window.jspdf;

let doc = new jsPDF('l','pt','A4');

let table = $('#list_iso').DataTable();
let rows = table.rows().nodes();

let grouped = {};

$(rows).each(function(){

let cols = $(this).find("td");

let iso = $(cols[1]).text().trim();

if(!grouped[iso]){
grouped[iso] = [];
}

grouped[iso].push([

$(cols[2]).text().trim(),
$(cols[3]).text().trim(),
$(cols[4]).text().trim(),
$(cols[5]).text().trim()

]);

});

let y = 40;

for(let iso in grouped){

doc.setFontSize(14);
doc.text("Standar ISO : " + iso, 40, y);

y += 20;

doc.autoTable({

startY: y,
head:[["No Klausul","Nama Klausul","Level","Status"]],
body: grouped[iso],
styles:{fontSize:9},
headStyles:{fillColor:[0,183,189]}

});

y = doc.lastAutoTable.finalY + 30;

}

doc.save("ISO_CLAUSES_REPORT.pdf");

});
});


</script>

@endpush