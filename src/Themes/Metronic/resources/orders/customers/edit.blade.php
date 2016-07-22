@extends('zahmetsizce::themes.main')

@section('content')
	<h3>Müşteri Düzenle</h3>
	{{open(['editCompany', $detail['id']])}}
		<div class="form-body">
			{{text(trans('e.companyCode'), 'companyCode', $detail['company_code'])}}
			{{text(trans('e.companyName'), 'name', $detail['name'])}}
		</div>
		<div class="form-actions">
			<div class="row">
				<div class="col-md-offset-3 col-md-9">
					{{submit(trans('e.edit'))}}
				</div>
			</div>
		</div>
	{{close()}}
@endsection

@section('breadcrumb')
{{breadcrumb([
	['Home', 'homePage'],
	['Müşteriler', '#'],
	['Düzenle']
])}}
@endsection

@section('title')
	{{trans('e.companyEdit')}}
@endsection