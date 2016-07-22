	@extends('zahmetsizce::themes.main')

@section('content')
<h3 class="page-title"> Rotasyon İncele </h3>
	<table class="table table-bordered">
		<tr>
			<th>Rota Kodu</th>
			<td>{{$detail['route_code']}}</td>
		</tr>
		<tr>
			<th>Rota Adı</th>
			<td>{{$detail['title']}}</td>
		</tr>
		<tr>
			<th>Rota Detayları</th>
			<td>
				@if($detail->getRouteDetails->count()>0)
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>İşlem Adı</th>
								<th>İşlemler</th>
							</tr>
						</thead>
						<tbody>
							@foreach($detail->getRouteDetails as $e)
								<tr>
									<td>{{$e->getWorkType['title']}}</td>
									<td>İşlem Yok</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				@else
					Tanımlı işlem yok
				@endif
			</td>
		</tr>
		<tr>
			<th>Tanımlı Olduğu Bomlar</th>
			<td>
				@if($detail->getDefinedBoms->count()>0)
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>BOM</th>
								<th>İşlemler</th>
							</tr>
						</thead>
						<tbody>
							@foreach($detail->getDefinedBoms as $e)
								<tr>
									<td>{{$e->getBom['title']}}</td>
									<td>{{linka('Kaldır', 'removeConnectionBomRoute', $e['id'])}}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				@else
					Tanımlı olduğu BOM yok
				@endif
			</td>
		</tr>
	</table>
@endsection

@section('title')
	Rota Detayları
@endsection

@section('breadcrumb')
{{breadcrumb([
	['Home', 'homePage'],
	['Üretim Yapılandırma', '#'],
	['Rotasyonlar', 'routes'],
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
				 <a data-toggle="modal" href="#sil">
				 	<i class="icon-trash"></i> Sil </a>
			</li>
			<li>
				<a href="{{route('editRoute', $detail['id'])}}">
					<i class="icon-bell"></i> Düzenle </a>
			</li>
			<li>
				<a href="{{route('defineWorkTypeToRoute', $detail['id'])}}">
					<i class="icon-star"></i> Operasyon Tanımla </a>
		   	</li>
			<li>
				<a href="{{route('defineBomToRoute', $detail['id'])}}">
					<i class="icon-star"></i> Ürün Ağacına Bağla </a>
		   	</li>
		</ul>
	</div>
</div>
{{modal('sil', 'deleteRoute', $detail['id'])}}
@endsection