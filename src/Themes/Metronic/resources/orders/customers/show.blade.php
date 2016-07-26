@extends('zahmetsizce::themes.main')

@section('content')
<h3 class="page-title"> Müşteri Detayları </h3>
	<table class="table table-bordered">
		<tr>
			<th>Müşteri Adı</th>
			<td>{{$detail['name']}}</td>
		</tr>
		<tr>
			<th>Müşterinin Siparişleri</th>
			<td>
				<table class="table table-bordered">
					{{tableTitles(['Sipariş Kodu', 'Durumu', 'İşlemler'])}}
					<tbody>
					@foreach($detail->getOrders as $e)
						<tr>
							<td>{{$e['order_code']}}</td>
							<td>
								@if($e['status']==1)
									İşlemde
								@else
									Tamamlandı
								@endif
							</td>
							<td>{{buttonGroup('İşlemler', [
								createLink('Siparişi İncele', 'showOrder', $e['id'], 'info')
							])}}</td>
						</tr>
					@endforeach
				</table>
			</td>
		</tr>
	</table>
@endsection

@section('title')
	Müşteri İncele
@endsection

@section('breadcrumb')
{{breadcrumb([
	['Home', 'homePage'],
	['CRM', '#'],
	['Müşteriler', '#'],
	['Yeni']
])}}
@endsection