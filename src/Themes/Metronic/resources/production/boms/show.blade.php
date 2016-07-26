@extends('zahmetsizce::themes.main')

@section('content')
<h3 class="page-title"> Ürün Ağacı Detayları </h3>
	<table class="table table-bordered">
		<tr>
			<th>Ürün Ağacı Kodu</th>
			<td>{{$detail['bom_code']}}</td>
		</tr>
		<tr>
			<th>Ürün Ağacı Başlığı</th>
			<td>{{$detail['title']}}</td>
		</tr>
		<tr>
			<th>Oluşan Parçalar</th>
			<td>
				@if($detail->getComposedParts->count()>0)
					<table class="table table-bordered">
						{{tableTitles(['Parça', 'İşlemler'])}}
						<tbody>
							@foreach($detail->getComposedParts as $e)
								<tr>
									<td>{{$e->getPart['title']}}</td>
									<td>{{buttonGroup('İşlemler', [
										createLink('Kaldır', 'deleteComposedPartFromBom', $e['id'], 'unlink'),
										createLink('Parçayı İncele', 'showPart', $e['part_id'], 'info')
									])}}
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				@else
					Oluşacak Parça Yok
				@endif
			</td>
		</tr>
		<tr>
			<th>Gerekli Parçalar</th>
			<td>
				@if($detail->getNeededParts->count()>0)
					<table class="table table-bordered">
						{{tableTitles(['Parça', 'Adet', 'İşlemler'])}}
						<tbody>
							@foreach($detail->getNeededParts as $e)
								<tr>
									<td>{{$e->getPart['title']}}</td>
									<td>{{numberFormat($e['quantity'])}}</td>
									<td>{{buttonGroup('İşlemler', [
										createLink('Kaldır', 'deleteNeededPartFromBom', $e['id'], 'unlink'),
										editLink('editNeededPartForBom', $e['id']),
										createLink('Parçayı İncele', 'showPart', $e['part_id'], 'info')
									])}}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				@else
					Gerekli parça yok
				@endif
			</td>
		</tr>
		<tr>
			<th>Bağlı Parçalar</th>
			<td>
				@if($detail->getConnectedParts->count()>0)
					<table class="table table-bordered">
						{{tableTitles(['Parça', 'İşlemler'])}}
						<tbody>
							@foreach($detail->getConnectedParts as $e)
								<tr>
									<td>{{$e->getPart['title']}}</td>
									<td>{{buttonGroup('İşlemler', [
										createLink('Kaldır', 'removeConnectionPartBom', $e['id'], 'unlink'),
										createLink('Parçayı İncele', 'showPart', $e['part_id'], 'info')
									])}}
								</tr>
							@endforeach
						</tbody>
					</table>
				@else
					Bağlı parça yok
				@endif
			</td>
		</tr>
		<tr>
			<th>Bağlı rotalar</th>
			<td>
				@if($detail->getConnectedRoutes->count()>0)
					<table class="table table-bordered">
						{{tableTitles(['Rota', 'Açıklama', 'İşlemler'])}}
						<tbody>
							@foreach($detail->getConnectedRoutes as $e)
								<tr>
									<td>{{$e->getRoute['title']}}</td>
									<td>
										@if($e['default']==2)
											Öntanımlı
										@endif
									</td>
									<td>
										{{createLink('Kaldır', 'removeConnectionBomRoute', $e['id'], 'unlink')}}
										@if($e['default']==1)
											{{createLink('Öntanımlı yap', 'makeRouteDefaultForBom', $e['id'], 'link')}}
										@else
											{{createLink('Öntanımı kaldır', 'removeDefaultRouteFromRoute', $e['id'], 'unlink')}}
										@endif
										{{createLink('Rotayı İncele', 'showRoute', $e['route_id'], 'info')}}
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				@else
					Bağlı rotasyon yok
				@endif
			</td>
		</tr>
	</table>
@endsection

@section('title')
	Ürün Ağacı Detayları
@endsection

@section('breadcrumb')
{{breadcrumb([
	['Home', 'homePage'],
	['Üretim Yapılandırma', '#'],
	['Ürün Ağaçları', 'boms'],
	[$detail['title']]
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
				{{deleteLink('sil', null, true)}}
			</li>
			<li>
				{{editLink('editBom', $detail['id'])}}
			</li>
			<li>
				{{createLink('Oluşan Parça Ekle', 'addComposedPartToBom', $detail['id'], 'star')}}
		   	</li>
			<li>
				{{createLink('Gerekli Parça Ekle', 'addNeededPartToBom', $detail['id'], 'star')}}
		   	</li>
			<li class="divider"> </li>
			<li>
				{{createLink('Parça Tanımla', 'definePartToBom', $detail['id'], 'link')}}
			</li>
			<li>
				{{createLink('Rota Tanımla', 'defineRouteToBom', $detail['id'], 'link')}}
			</li>
		</ul>
	</div>
</div>
{{modal('sil', 'deleteBom', $detail['id'])}}
@endsection