@extends('zahmetsizce::themes.main')

@section('content')
<h3 class="page-title"> Yeni Müşteri </h3>
	{{open('newCompany')}}
		<div class="form-body">
			{{text('Müşteri Kodu', 'company_code')}}
			{{text('Müşteri Adı', 'name')}}
		</div>
		<div class="form-actions">
			<div class="row">
				<div class="col-md-offset-3 col-md-9">
					{{addButton()}}
				</div>
			</div>
		</div>
	{{close()}}
@endsection

@section('pageTitle')
	Yeni Müşteri
@endsection

@section('breadcrumb')
{{breadcrumb([
	['Home', 'homePage'],
	['CRM', '#'],
	['Müşteriler', 'companies'],
	['Yeni']
])}}
@endsection