@extends('zahmetsizce::themes.main')

@section('content')
<h3 class="page-title"> Sipariş Detayları </h3>
	<table class="table table-bordered">
		<tr>
			<th>Sipariş Kodu</th>
			<td>{{$detail['order_code']}}</td>
		</tr>
		<tr>
			<th>Müşteri</th>
			<td>{{$detail->getCompany['name']}}</td>
		</tr>
		<tr>
			<th>Sipariş Detayları</th>
			<td>
				@if($detail->getOrderDetails->count() > 0)
					<table class="table table-bordered">
						{{tableTitles(['Parça', 'Adet', 'Durumu', 'Üretimde mi?', 'İşlemler'])}}
						<tbody>
							@foreach($detail->getOrderDetails as $e)
								<tr>
									<td>{{$e->getPart['title']}}</td>
									<td>{{numberFormat($e['quantity'])}}</td>
									<td>
										@if($e['status']==1)
											İşlemde
										@else
											Tamamlandı
										@endif
									</td>
									<td>
										@if($e['production_order_id']!=0)
											{{$e->getProductionOrder['production_order_code']}} {{showLink('showProductionOrder', $e->getProductionOrder['id'])}}
										@else
											Üretimde Değil
										@endif
									</td>
									<td>{{buttonGroup('İşlemler', [
										editLink('editPartOfOrder', $e['id']),
										deleteLink('deletePartOfOrder', $e['id']),
										createLink('Üret', 'produceOrderDetail', $e['id'], 'link')
									])}}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				@else
					Siparişe Tanımlı Parça Yok
				@endif
			</td>
		</tr>
	</table>
@endsection

@section('title')
	Sipariş İncele
@endsection

@section('breadcrumb')
{{breadcrumb([
	['Home', 'homePage'],
	['CRM', '#'],
	['Siparişler', 'orders'],
	['Sipariş İncele']
])}}
@endsection

@section('pageToolBar')
<div class="page-toolbar">
	<div class="btn-group pull-right">
		<button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown"> İşlemler
			<i class="fa fa-angle-down"></i>
		</button>
		<ul class="dropdown-menu pull-right" role="menu">
			<li>
				{{createLink('Siparişe Parça Ekle', 'addPartToOrder', $detail['id'], 'plus')}}
			</li>
		</ul>
	</div>
</div>
@endsection