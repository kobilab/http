@extends('zahmetsizce::themes.main')

@section('boxTools')
	{{tool(trans('e.cancel'), 'showOrder', $detail['id'])}}
@endsection

@section('boxBodyClass') form @endsection

@section('boxBody')
	{{open(['editPartOfOrder', $detail['id']])}}
		<div class="form-body">
			{{text(trans('e.quantity'), 'quantity', $detail['quantity'])}}
		</div>
		<div class="form-actions">
			<div class="row">
				<div class="col-md-offset-3 col-md-9">
					{{submit(trans('e.edit'))}}
				</div>
			</div>
		</div>
	{{close()}}
@endsection

@section('pageTitle')
	{{trans('e.editPartOfOrder')}}
@endsection