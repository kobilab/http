@extends('zahmetsizce::themes.main')

@section('content')
<h3 class="page-title"> Yeni Üretim Emri </h3>
<div class="row">
		<div class="col-md-12">
		{{open(['editProductionOrder', $detail['id']])}}
			<div class="form-body">
				{{text('Emir Kodu', 'production_order_code', $detail['production_order_code'])}}
				{{text('Notlar', 'notes', $detail['notes'])}}
			</div>
			<div class="form-actions">
				<div class="row">
					<div class="col-md-offset-2 col-md-10">
						{{editButton()}}
					</div>
				</div>
			</div>
		{{close()}}
	</div>
</div>

@endsection

@section('title')
	Yeni Üretim Emri
@endsection

@section('breadcrumb')
{{breadcrumb([
	['Home', 'homePage'],
	['Üretim Emirleri', 'productionOrders'],
	['Yeni']
])}}
@endsection