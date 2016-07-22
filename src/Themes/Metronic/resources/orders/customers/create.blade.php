@extends('zahmetsizce::themes.main')

@section('content')
	{{open('newCompany')}}
		<div class="form-body">
			{{text(trans('e.companyCode'), 'companyCode')}}
			{{text(trans('e.companyName'), 'name')}}
		</div>
		<div class="form-actions">
			<div class="row">
				<div class="col-md-offset-3 col-md-9">
					{{submit(trans('e.add'))}}
				</div>
			</div>
		</div>
	{{close()}}
@endsection

@section('pageTitle')
	{{trans('e.newCompany')}}
@endsection

@section('breadcrumb')
{{breadcrumb([
	['Home', 'homePage'],
	['Müşteriler', '#'],
	['Yeni']
])}}
@endsection