@extends('zahmetsizce::themes.main')

@section('content')
<h3 class="page-title"> Sipariş Detay Ekle </h3>
	{{open(['addPartToOrder', $detail['id']])}}
		<div class="form-body">
			{{select('Parça', 'part_id', listThem($parts, 'id', 'title'))}}
			{{text('Adet', 'quantity')}}
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
	Siparişe Detay Ekle
@endsection

@section('breadcrumb')
{{breadcrumb([
	['Home', 'homePage'],
	['CRM', '#'],
	['Siparişler', 'orders'],
	['Sipariş Ekle']
])}}
@endsection