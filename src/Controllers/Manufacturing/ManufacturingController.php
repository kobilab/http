<?php

	namespace KobiLab\Http\Controllers\Manufacturing;

	use Illuminate\Routing\Controller;

	use PHPExcel; 
	use PHPExcel_IOFactory;
	use KobiLab\ProductionControl;
	use KobiLab\ProductionOrders;
	use KobiLab\WorkTypes;
	use KobiLab\WorkCenters;
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
				return redirectTo('newProductionOrder')
						->withErrors($result->getErrors())
						->withInput($result->getOld());
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

			return redirectTo('showProductionOrder', ProductionOrderRotations::find($productionRotationId)['production_order_id']);
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

			foreach ($detay->getAvailableLots as $each) {
				$gelenVeriler[$each['id'].'lot'] = Input::get($each['id'].'lot');
				$kurallar[$each['id'].'lot'] = 'required|numeric|between:0,'.$each['quantity'];
				$okunakli[$each['id'].'lot'] = $each['lot_code'];
			}

			$validator = Validator::make($gelenVeriler, $kurallar);
			$validator->setAttributeNames($okunakli);

			$toplam = 0;
			foreach ($detay->getAvailableLots as $e) {
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
			$this->data['detail'] = WorkTypes::find($workTypeId);
			$this->data['list'] = ProductionOrderRotations::where('work_type_id', $workTypeId)->get();

			return view('zahmetsizce::manufacturing.joblist', $this->data);
		}

		public function getOutputJobList($workTypeId)
		{
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
/** Include PHPExcel */
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("PHPExcel Test Document")
							 ->setSubject("PHPExcel Test Document")
							 ->setDescription("Test document for PHPExcel, generated using PHP classes.")
							 ->setKeywords("office PHPExcel php")
							 ->setCategory("Test result file");
// Add some data
$k = 2;
foreach(ProductionOrderRotations::where('work_type_id', $workTypeId)->get() as $emir) {
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$k, $emir->getProductionOrder['production_order_code'])
				->setCellValue('B'.$k, $emir->getPart['part_code'])
				->setCellValue('C'.$k, 'Hello')
				->setCellValue('D'.$k, 'world!');
	$k++;
}
$objPHPExcel->setActiveSheetIndex(0);
// Save Excel 2007 file
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
return response()->file(__DIR__.'/ManufacturingController.xlsx');
		}

		public function workCenterList($workCenterId)
		{
			$this->data['detail'] = WorkCenters::find($workCenterId);
			$this->data['list'] = ProductionOrderRotations::where('work_center_id', $workCenterId)->get();

			return view('zahmetsizce::manufacturing.centerlist', $this->data);
		}

		public function getOutputMachineList($workCenterId)
		{
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
/** Include PHPExcel */
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("PHPExcel Test Document")
							 ->setSubject("PHPExcel Test Document")
							 ->setDescription("Test document for PHPExcel, generated using PHP classes.")
							 ->setKeywords("office PHPExcel php")
							 ->setCategory("Test result file");
// Add some data
$k = 2;
foreach(ProductionOrderRotations::where('work_center_id', $workCenterId)->get() as $emir) {
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$k, $emir->getProductionOrder['production_order_code'])
				->setCellValue('B'.$k, $emir->getPart['part_code'])
				->setCellValue('C'.$k, 'Hello')
				->setCellValue('D'.$k, 'world!');
	$k++;
}
$objPHPExcel->setActiveSheetIndex(0);
// Save Excel 2007 file
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
return response()->file(__DIR__.'/ManufacturingController.xlsx');
		}

		public function operationsOfManufacturing()
		{
			$this->data['operations'] = ProductionOrderRotations::selectRaw('work_type_id, count(*) as sum')
																->groupBy('work_type_id')
																->get();

			return view('zahmetsizce::manufacturing.operations', $this->data);
		}

		public function centersOfManufacturing()
		{
			$this->data['centers'] = ProductionOrderRotations::selectRaw('work_center_id, count(*) as sum')
															->where('work_center_id', '!=', 0)
															->groupBy('work_center_id')
															->get();

			return view('zahmetsizce::manufacturing.centers', $this->data);
		}

		public function edit($productionOrderId)
		{
			$this->data['detail'] = ProductionOrders::find($productionOrderId);

			return view('zahmetsizce::manufacturing.edit', $this->data);
		}

		public function update($productionOrderId)
		{
			$result = ProductionOrders::setFromAllInput()->setId($productionOrderId)->setRulesForTable('production_order_edit')->autoUpdate();

			if (!$result) {
				return redirectTo('newProductionOrder')
						->withErrors($result->getErrors())
						->withInput($result->getOld());
			} else {
				return redirectTo('productionOrders');
			}			
		}
	}
