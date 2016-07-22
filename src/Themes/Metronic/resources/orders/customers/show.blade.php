@extends('zahmetsizce::themes.main')

@section('content')
	Gelecek
@endsection

@section('title')
	Müşteri İncele
@endsection

@section('breadcrumb')
{{breadcrumb([
	['Home', 'homePage'],
	['Müşteriler', '#'],
	['Yeni']
])}}
@endsection