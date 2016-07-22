<?php

	namespace KobiLab\Http\Controllers\Production\WorkCenters;

	use Illuminate\Routing\Controller;

	use KobiLab\WorkCenters;

	/**
	 * Üretim rotasyonları ile ilgili işlemleri yapan sınıf
	 */
	class WorkCentersController extends Controller
	{

		/**
		 * Sınıf içerisinde dolaşacak veriler
		 * 
		 * @var array
		 */
		var $data = [];

		public function __construct() {
			$this->data['theme'] = [
				'first'	=> 'production',
				'second'=> 'station'
			];
		}

		/**
		 * Rotasyonları listeleyen method
		 * 
		 * @return view
		 */
		public function index()
		{
			$this->data['routes'] = WorkCenters::all();

			return view('zahmetsizce::production.workcenters.list', $this->data);
		}
		
		/**
		 * Rotasyon eklemek için gerekli olan sayfayı derleyen method
		 * 
		 * @return view
		 */
		public function create()
		{
			return view('zahmetsizce::production.workcenters.create', $this->data);
		}
		
		/**
		 * Rotasyon eklemek için gerekli kontrolleri yapan ve ekleyen method
		 * 
		 * @return redirect
		 */
		public function store()
		{
			$result = WorkCenters::setFromAllInput()->autoCreate();

			if (!$result) {
				return redirectTo('newWorkCenter');
			} else {
				return redirectTo('workCenters');
			}
		}

		/**
		 * Rotasyon düzenlemek için gerekli olan sayfayı derlemeye yarayan method
		 * 
		 * @param  integer $rotaId Rotasyon Id
		 * @return view
		 */
		public function edit($routeId)
		{
			$this->data['detail'] = WorkCenters::find($routeId);

			return view('zahmetsizce::production.workcenters.edit', $this->data);
		}
		
		/**
		 * Rotasyonu veritabanında düzenleyen method
		 * 
		 * @param  integer $rotaId Rotasyon Id
		 * @return redirect
		 */
		public function update($routeId)
		{
			$result = WorkCenters::setId($routeId)->setFromAllInput()->autoUpdate();

			if (!$result) {
				return redirectTo('editWorkCenter', $routeId);
			} else {
				return redirectTo('workCenters');
			}
		}
		
		/**
		 * Rotasyon inceleme sayfasını derleyen mehod
		 * 
		 * @param  integer $rotaId Rotasyon Id
		 * @return view
		 */
		public function show($routeId)
		{
			$this->data['detail'] = WorkCenters::find($routeId);

			return view('zahmetsizce::production.workcenters.show', $this->data);
		}
		
		/**
		 * Rotasyon silme işlemini yapan method
		 * 
		 * @param  integer $rotaId Rotasyon Id
		 * @return redirect
		 */
		public function delete($routeId)
		{
			WorkCenters::find($routeId)->delete();

			return redirect()
					->route('workCenters');
		}

	}
