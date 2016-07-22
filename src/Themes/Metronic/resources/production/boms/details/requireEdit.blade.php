 @extends('zahmetsizce::themes.main')

@section('content')
<h3 class="page-title"> Gerekli Parça Düzenle </h3>
<div class="row">
	<div class="col-md-12">
		{{open(['editNeededPartForBom', $detail['id']])}}
			<div class="form-body">
				{{select('Gereken Parça', 'part_id', listThem($parts, 'id', 'title'), $detail['part_id'])}}
				{{text('Gereken Adet', 'quantity', $detail['quantity'])}}
			</div>
			<div class="form-actions">
				<div class="row">
					<div class="col-md-offset-2 col-md-10">
						{{submit('Düzenle')}}
					</div>
				</div>
			</div>
		{{close()}}
	</div>
</div>

@endsection

@section('title')
	Gerekli Parça Düzenle
@endsection

@section('breadcrumb')
{{breadcrumb([
	['Home', 'homePage'],
	['Üretim Yapılandırma', '#'],
	['Ürün Ağaçları', 'boms'],
	[$detail->getBom['title'], 'showBom', $detail->getBom['id']],
	['Gereken Parça Düzenle']
])}}
@endsection