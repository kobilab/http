<?php

	namespace KobiLab\Http\Controllers\Manufacturing;

	use Illuminate\Routing\Controller;

	use KobiLab\ProductionControl;
	use KobiLab\ProductionOrders;
	use KobiLab\Parts;
	use KobiLab\ProductionOrderRotations;
	use KobiLab\ProductionOrderNeededParts;
	use KobiLab\ProductionOrderComposedParts;

	use Illuminate\Support\Facades\Input;
	use KobiLab\ReduceFromNeededPart;
	use Illuminate\Support\Facades\Validator;
	/**
	 * Üretim yönetimi ve takibini yapan sınıf
	 */
	class ManufacturingController extends Controller
	{
		
		/**
		 * Sınıf içerisinde dolaşacak veriler
		 * 
		 * @var array
		 */
		var $data = [];

		public function __construct() {
			$this->data['theme'] = [
				'first'	=> 'manufacturing'
			];
		}

		/**
		 * Üretim emirlerinin listelenmesini yapan method
		 * 
		 * @return view
		 */
		public function index()
		{
			$this->data['orders'] = ProductionOrders::all();

			return view('zahmetsizce::manufacturing.list', $this->data);
		}
		
		/**
		 * Yeni üretim emri oluşturmak için gerekli olan sayfayı derleyen method
		 * 
		 * @return view
		 */
		public function create()
		{
			$this->data['parts'] = Parts::all();

			return view('zahmetsizce::manufacturing.create', $this->data);
		}
		
		/**
		 * Üretim emri oluşturmak için kontrol eden ve ekleyen method
		 *
		 * @return redirect
		 */
		public function store()
		{
			$result = ProductionOrders::setFromAllInput()->setRulesForTable('production_order')->autoCreate();

			if (!$result) {
				return redirectTo('newProductionOrder');
			} else {
				return redirectTo('productionOrders');
			}
		}
		
		/**
		 * Üretim emrinin inceleme sayfasını derlemeye yarayan method
		 * 
		 * @param  integer $uretimEmirId Üretim Emir Id
		 * @return view
		 */
		public function show($orderId)
		{
			$find = ProductionOrderNeededParts::where('production_order_id', $orderId)->get();

			$sonuclar = [];

			foreach ($find as $e) {
				$sonuclar[$e['upper_part_id']][] = $e;
			}

			$this->data['gerekenMalzemeler'] = $sonuclar;

			$rotasyonIslemler = ProductionOrderRotations::where('production_order_id', $orderId)->get();
			$rotasyonlar = [];
			foreach ($rotasyonIslemler as $e) {
				$s = [];
				foreach($e->getWorkType->getStations as $d) {
					$s[$d['work_center_id']] = $d->getWorkCenter['title'];
				}
				$e['stations'] = $s;
				$rotasyonlar[$e['part_id']][] = $e;
			}

			$this->data['islemler'] = $rotasyonlar;

			$olusacaklar = ProductionOrderComposedParts::where('production_order_id', $orderId)->get();

			$this->data['olusacaklar'] = $olusacaklar;
			$this->data['detail'] = ProductionOrders::find($orderId);

			return view('zahmetsizce::manufacturing.show', $this->data);
		}
		
		/**
		 * Üretim emrinin silinme işlemini yapan method
		 *
		 * @param  integer $uretimEmirId Üretim Emir Id
		 * @return redirect
		 */
		public function delete($orderId)
		{
			ProductionOrders::find($orderId)->delete();

			return redirectTo('productionOrders');
		}
		
		/**
		 * Herhangi bir rotasyonu bitirme işlemini yapan method
		 *
		 * @param  integer $uretimRotasyonId Üretim Rotasyon Id
		 * @return redirect
		 */
		public function workFinish($productionRotationId)
		{
			$detay = ProductionOrderRotations::find($productionRotationId)->update(['status'=>2]);

			ProductionControl::fire($detay['production_order_id']);

			return redirectTo('productionOrders');
		}
		
		/**
		 * Üretimde kullanılması gereken malzemenin tüketilmesini için
		 * gerekli olan sayfayı lotlarla beraber listeleyen method
		 *
		 * @param  integer $uretimGerekenId Üretim Gereken Id
		 * @return view
		 */
		public function consume($productionNeededId)
		{
			$this->data['detail'] = ProductionOrderNeededParts::find($productionNeededId);

			return view('zahmetsizce::manufacturing.book', $this->data);
		}
		
		/**
		 * Üretim için gerekli olan Partsi veritabanından düşme işlemini gerçekletiren method
		 *
		 * @param  integer $uretimGerekenId Üretim Gereken Id
		 * @return redirect
		 */
		public function consumed($productionNeededId)
		{
			$detay = ProductionOrderNeededParts::find($productionNeededId);
			$gelenVeriler = [];
			$kurallar = [];
			$okunakli = [];

			foreach ($detay->getUygunLotlar as $each) {
				$gelenVeriler[$each['id'].'lot'] = Input::get($each['id'].'lot');
				$kurallar[$each['id'].'lot'] = 'required|numeric|between:0,'.$each['quantity'];
				$okunakli[$each['id'].'lot'] = $each['lot_code'];
			}

			$validator = Validator::make($gelenVeriler, $kurallar);
			$validator->setAttributeNames($okunakli);

			$toplam = 0;
			foreach ($detay->getUygunLotlar as $e) {
				if (Input::get($e['id'].'lot')!=0) {
					$toplam = $toplam + Input::get($e['id'].'lot');
				}
			}

			if ($validator->fails()) {
				if ($validator->fails()) {
					
				}
				if ($toplam>$detay['quantity']) {
					
				}

				return redirectTo('consumeProductionNeededParts', $productionNeededId);
			} else {
				$sonuc = ReduceFromNeededPart::start($productionNeededId);
				if($sonuc) {
					ProductionControl::fire($detay['production_order_id']);

					return redirectTo('showProductionOrder', $detay['production_order_id']);
				} else {
					return redirectTo('consumeProductionNeededParts', $productionNeededId);
				}
			}
		}
		

		public function defineWorkCenter($rotationId)
		{
			ProductionOrderRotations::find($rotationId)->update(['work_center_id' => Input::get('workCenterId')]);

			return redirect()->back();
		}

		/**
		 * 
		 */
		public function isinBiKisminiYap($rotationId)
		{
			ProductionOrderRotations::find($rotationId)->update(['remainder'=>Input::get('remainder')]);

			return redirect()->back();
		}

		public function jobList($workTypeId)
		{
			$this->data['list'] = ProductionOrderRotations::where('work_type_id', $workTypeId)->get();

			return view('zahmetsizce::manufacturing.joblist', $this->data);
		}

		public function workCenterList($workCenterId)
		{
			$this->data['list'] = ProductionOrderRotations::where('work_center_id', $workCenterId)->get();

			return view('zahmetsizce::manufacturing.centerlist', $this->data);
		}
	}
