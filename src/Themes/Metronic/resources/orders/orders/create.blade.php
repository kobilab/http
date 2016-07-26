@extends('zahmetsizce::themes.main')

@section('content')
<h3 class="page-title"> Yeni Sipariş </h3>
	{{open('newOrder')}}
		<div class="form-body">
			{{text('Sipariş Kodu', 'order_code')}}
			{{select('Müşteri', 'company_id', listThem($companies, 'id', 'name'))}}
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

@section('title')
	Sipariş Ekle
@endsection

@section('breadcrumb')
{{breadcrumb([
	['Home', 'homePage'],
	['CRM', '#'],
	['Siparişler', 'orders'],
	['Sipariş Ekle']
])}}
@endsection