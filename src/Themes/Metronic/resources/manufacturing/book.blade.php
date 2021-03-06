@extends('zahmetsizce::themes.main')

@section('content')
<h3 class="page-title"> Parça Ayırt Et </h3>
<div class="row">
	<div class="col-md-12">
		{{open(['consumeProductionNeededParts', $detail['id']])}}
			<table class="table table-striped table-bordered table-hover order-column" id="sample_1">
				{{tableTitles(['Lot Kodu', 'Mevcut Adet', 'Kullanılacak Adet'])}}
				<tbody>
					@foreach($detail->getAvailableLots as $each)
					<tr>
						<td>{{$each['lot_code']}}</td>
						<td align="right">{{numberFormat($each['quantity'])}}</td>
						<td>
							{{Form::text($each['id'].'lot', Input::old($each['id'].'lot', 0), ['class' => 'form-control'])}}
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{{submit('Tüket')}}
		{{close()}}
	</div>
</div>

@endsection

@section('title')
	Parça Ayırt Et
@endsection

@section('breadcrumb')
{{breadcrumb([
	['Home', 'homePage'],
	['Üretim Emirleri', 'productionOrders'],
	[$detail->getEmir['production_order_code'], 'showProductionOrder', $detail['production_order_id']],
	['Parça Ayırt Et']
])}}
@endsection