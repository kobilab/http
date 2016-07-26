@extends('zahmetsizce::themes.main')

@section('content')
<h3 class="page-title"> Siparişi Düzenle </h3>
	{{open(['editOrder', $detail['id']])}}
		<div class="form-body">
			{{text('Sipariş Kodu', 'order_code', $detail['order_code'])}}
			{{select('Müşteri', 'company_id', listThem($companies, 'id', 'name'), $detail['company_id'])}}
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

@section('title')
	Sipariş Düzenle
@endsection

@section('breadcrumb')
{{breadcrumb([
	['Home', 'homePage'],
	['CRM', '#'],
	['Siparişler', 'orders'],
	['Sipariş Düzenle']
])}}
@endsection