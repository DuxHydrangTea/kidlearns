{{-- filepath: c:\Users\DUNG\Documents\CO-PRO\eduKids\resources\views\client\file\show.blade.php --}}
@extends('client.layouts.layout')
@push('styles')
    <meta charset="UTF-8">
@endpush
@section('content')

{{-- <div id="docx-content" class="prose max-w-none bg-white p-6 rounded shadow"></div> --}}
<iframe src='https://docs.google.com/gview?url={{'http://edukids.test' . '/storage/uploads/1b8a2a35-4762-479e-9dae-d3dcf2f85e6aMẫu-nhận-xét-ntnt.docx'}}&embedded=true' width='1366px' height='623px' frameborder='0'>This is an embedded <a target='_blank' href='http://office.com'>Microsoft Office</a> document, powered by <a target='_blank' href='http://office.com/webapps'>Office Online</a>.</iframe>




@endsection