<?php

	namespace KobiLab\Http\Controllers\Production\PartBomRoute;

	use Illuminate\Routing\Controller;

	use KobiLab\BomRoute;
	use KobiLab\PartBom;


	class RemoveController extends Controller {

		/**
		 * İtemBom tablosundaki bağlantıyı kaldırmaya yarayan method
		 * 
		 * @param  integer $PartBomId PartBom Id
		 * @return redirect
		 */
		public function partBom($partBomId)
		{
			PartBom::find($partBomId)->delete();

			return redirectTo('parts');
		}

		/**
		 * BomRoute bağlantısını kalırma işlemini yapan method
		 * 
		 * @param  integer $BomRouteId BomRoute Id
		 * @return redirect
		 */
		public function bomRoute($bomRouteId)
		{
			BomRoute::find($bomRouteId)->delete();

			return redirectTo('boms');
		}


	}