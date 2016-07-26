@extends('zahmetsizce::themes.main')

@section('content')
<h3 class="page-title"> Parça Detayları </h3>
	<table class="table table-bordered">
		<tr>
			<th>Parça Kodu</th>
			<td>{{$detail['part_code']}}</td>
		</tr>
		<tr>
			<th>Parça Adı</th>
			<td>{{$detail['title']}}</td>
		</tr>
		<tr>
			<th>Bağlı Bomlar</th>
			<td>
				@if($detail->getBoms->count()>0)
					<table class="table table-bordered">
						{{tableTitles(['BOM', 'Açıklama', 'İşlemler'])}}
						<tbody>
							@foreach($detail->getBoms as $e)
								<tr>
									<td>{{$e->getBom['title']}}</td>
									<td>
										@if($e['default']==2)
											Ön tanımlı
										@endif
									</td>
									<td>{{buttonGroup('İşlemler', [
										createLink('Kaldır', 'removeConnectionPartBom', $e['id'], 'trash'),
										function() use ($e) {
											if($e['default']==1) return createLink('Öntanımlı yap', 'makeBomDefaultForPart', $e['id'], 'link');
											else return createLink('Öntanımı kaldır', 'removeDefaultBomFromPart', $e['id'], 'unlink');
										}
									])}}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				@else
					Bağlı BOM yok
				@endif
			</td>
		</tr>
		<tr>
			<th>Depodaki Toplam</th>
			<td>{{numberFormat($detail->getTotal['sumOf'])}}</td>
		</tr>
	</table>
@endsection

@section('title')
	Parça Detayları
@endsection

@section('breadcrumb')
{{breadcrumb([
	['Home', 'homePage'],
	['Üretim Yapılandırma', '#'],
	['Parçalar', 'parts'],
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
				{{editLink('editPart', $detail['id'])}}
			</li>
			<li>
				{{createLink('Ürün Ağacı Tanımla', 'defineBomToPart', $detail['id'], 'link')}}
		   	</li>
			<li>
				{{createLink('Lotları Listele', 'lotsOfPart', $detail['id'], 'star')}}
			</li>
		</ul>
	</div>
</div>
{{modal('sil', 'deletePart', $detail['id'])}}
@endsection