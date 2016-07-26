@extends('zahmetsizce::themes.main')

@section('content')
<h3 class="page-title"> Sipariş Detayını Düzenle </h3>
	{{open(['editPartOfOrder', $detail['id']])}}
		<div class="form-body">
			{{text('Adet', 'quantity', $detail['quantity'])}}
			{{select('Durumu', 'status', [1=>'İşlemde', 2=>'Tamamlandı'])}}
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
	Sipariş Detayını Düzenle
@endsection

@section('breadcrumb')
{{breadcrumb([
	['Home', 'homePage'],
	['CRM', '#'],
	['Siparişler', 'orders'],
	['Sipariş Detayını Düzenle']
])}}
@endsection