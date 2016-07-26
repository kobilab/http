 @extends('zahmetsizce::themes.main')

@section('content')
<h3 class="page-title"> Oluşacak Parça Ekle </h3>
<div class="row">
	<div class="col-md-12">
		{{open(['addComposedPartToBom', $detail['id']])}}
			<input type="hidden" value="{{$detail['id']}}" name="bom_id" />
			<div class="form-body">
				{{select('Oluşacak Parça', 'part_id', listThem($parts, 'id', 'title'))}}
			</div>
			<div class="form-actions">
				<div class="row">
					<div class="col-md-offset-2 col-md-10">
						{{addButton()}}
					</div>
				</div>
			</div>
		{{close()}}
	</div>
</div>

@endsection

@section('title')
	Oluşacak Parça Ekle
@endsection

@section('breadcrumb')
{{breadcrumb([
	['Home', 'homePage'],
	['Üretim Yapılandırma', '#'],
	['Ürün Ağaçları', 'boms'],
	[$detail['title'], 'showBom', $detail['id']],
	['Oluşan Parça Ekle']
])}}
@endsection