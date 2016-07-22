 @extends('zahmetsizce::themes.main')

@section('content')
<h3 class="page-title"> Gerekli Parça Ekle </h3>
<div class="row">
	<div class="col-md-12">
		{{open(['addNeededPartToBom', $detail['id']])}}
			<input type="hidden" value="{{$detail['id']}}" name="bom_id" />
			<div class="form-body">
				{{select('Gereken Parça', 'part_id', listThem($parts, 'id', 'title'))}}
				{{text('Gereken Adet', 'quantity')}}
			</div>
			<div class="form-actions">
				<div class="row">
					<div class="col-md-offset-2 col-md-10">
						{{submit('Ekle')}}
					</div>
				</div>
			</div>
		{{close()}}
	</div>
</div>

@endsection

@section('title')
	Gerekli Parça Ekle
@endsection

@section('breadcrumb')
{{breadcrumb([
	['Home', 'homePage'],
	['Üretim Yapılandırma', '#'],
	['Ürün Ağaçları', 'boms'],
	[$detail['title'], 'showBom', $detail['id']],
	['Gereken Parça Ekle']
])}}
@endsection