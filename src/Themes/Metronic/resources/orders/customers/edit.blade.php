@extends('zahmetsizce::themes.main')

@section('content')
<h3 class="page-title">Müşteri Düzenle</h3>
	{{open(['editCompany', $detail['id']])}}
		<div class="form-body">
			{{text('Müşteri Kodu', 'companyCode', $detail['company_code'])}}
			{{text('Adı', 'name', $detail['name'])}}
		</div>
		<div class="form-actions">
			<div class="row">
				<div class="col-md-offset-3 col-md-9">
					{{editButton()}}
				</div>
			</div>
		</div>
	{{close()}}
@endsection

@section('breadcrumb')
{{breadcrumb([
	['Home', 'homePage'],
	['CRM', '#'],
	['Müşteriler', '#'],
	['Düzenle']
])}}
@endsection

@section('title')
	Müşteri Düzenle
@endsection