<?php

	namespace KobiLab\Http\Controllers;

	use Illuminate\Routing\Controller;
	use Illuminate\Support\Facades\Input;

	use KobiLab\ProductionOrders;
	use KobiLab\Parts;

	class PagesController extends Controller
	{

		public function index()
		{
			$this->data = [
				'toplamEmir'	=> ProductionOrders::count(),
				'toplamParca'	=> Parts::count()
			];

			return view('zahmetsizce::welcome', $this->data);
		}

		public function goFast()
		{
			$key = Input::get('key');

			if(starts_with($key, 'E')) {
				return redirectTo('showProductionOrder', substr($key, 1));
			}
		}

	}
