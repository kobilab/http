@extends('zahmetsizce::themes.main')

@section('content')
<h3 class="page-title"> Ürün Ağacı Düzenle </h3>
<div class="row">
	<div class="col-md-12">
		{{open(['editBom', $detail['id']])}}
			<div class="form-body">
			{{text('BOM Kodu', 'bom_code', $detail['bom_code'])}}
			{{text('BOM Başlık', 'title', $detail['title'])}}
			<div class="form-actions">
				<div class="row">
					<div class="col-md-offset-2 col-md-9">
						{{editButton()}}
					</div>
				</div>
			</div>
		{{close()}}
	</div>
</div>

@endsection

@section('title')
	Ürün Ağacı Düzenle
@endsection

@section('breadcrumb')
{{breadcrumb([
	['Home', 'homePage'],
	['Üretim Yapılandırma', '#'],
	['Ürün Ağaçları', 'boms'],
	[$detail['title'], 'showBom', $detail['id']],
	['Düzenle']
])}}
@endsection