<?php

	Route::group(['middleware' => 'auth'], function() {

		Route::get('/', 'PagesController@index')->name('homePage');

		Route::group([ 'prefix' => 'customers', 'namespace' => 'Orders' ], function() {
			Route::group([ 'prefix' => 'orders' ], function() {
				Route::get('/', 'OrdersController@index')->name('orders');

				Route::get('new', 'OrdersController@create')->name('newOrder');
				Route::post('new', 'OrdersController@store');

				Route::get('show/{orderId}', 'OrdersController@show')->name('showOrder');

				Route::get('edit/{orderId}', 'OrdersController@edit')->name('editOrder');
				Route::post('edit/{orderId}', 'OrdersController@update');

				Route::get('delete/{orderId}', 'OrdersController@delete')->name('deleteOrder');

				Route::group([ 'prefix' => 'parts' ], function() {

					Route::get('new/{orderId}', 'OrderDetailsController@create')->name('addPartToOrder');
					Route::post('new/{orderId}', 'OrderDetailsController@store');

					Route::get('edit/{orderPartId}', 'OrderDetailsController@edit')->name('editPartOfOrder');
					Route::post('edit/{orderPartId}', 'OrderDetailsController@update');

					Route::get('delete/{orderPartId}', 'OrderDetailsController@delete')->name('deletePartOfOrder');
				});
			});

			Route::group([ 'prefix' => 'companies', 'namespace' => 'Customers' ], function() {
				Route::get('/', 'CompaniesController@index')->name('companies');

				Route::get('new', 'CompaniesController@create')->name('newCompany');
				Route::post('new', 'CompaniesController@store');

				Route::get('show/{companyId}', 'CompaniesController@show')->name('showCompany');

				Route::get('edit/{companyId}', 'CompaniesController@edit')->name('editCompany');
				Route::post('edit/{companyId}', 'CompaniesController@update');

				Route::get('delete/{companyId}', 'CompaniesController@delete')->name('deleteCompany');
			});	
		});

		Route::group(
			[
				'prefix' => 'production',
				'namespace' => 'Production'
			],
			function() {
				Route::group(
					[
						'prefix' => 'parts',
						'namespace' => 'Parts'
					],
					function() {
						Route::get('/', 'PartsController@index')->name('parts');

						Route::get('new', 'PartsController@create')->name('newPart');
						Route::post('new', 'PartsController@store');

						Route::get('show/{partId}', 'PartsController@show')->name('showPart');

						Route::get('edit/{partId}', 'PartsController@edit')->name('editPart');
						Route::post('edit/{partId}', 'PartsController@update');

						Route::get('delete/{partId}', 'PartsController@delete')->name('deletePart');
					}
				);

				Route::group(
					[
						'prefix' => 'boms',
						'namespace' => 'Boms'
					],
					function() {
						Route::get('/', 'BomController@index')->name('boms');

						Route::get('new', 'BomController@create')->name('newBom');
						Route::post('new', 'BomController@store');

						Route::get('edit/{bomId}', 'BomController@edit')->name('editBom');
						Route::post('edit/{bomId}', 'BomController@update');

						Route::get('show/{bomId}', 'BomController@show')->name('showBom');

						Route::get('delete/{bomId}', 'BomController@delete')->name('deleteBom');

						Route::group(
							[
								'prefix' => 'composed',
							],
							function() {
								Route::get('add/{bomId}', 'BomComposedPartsController@create')->name('addComposedPartToBom');
								Route::post('add/{bomId}', 'BomComposedPartsController@store');

								Route::get('delete/{uretim_sonucu_olusan_id}', 'BomComposedPartsController@delete')->name('deleteComposedPartFromBom');
							}
						);

						Route::group(
							[
								'prefix' => 'needed'
							],
							function() {
								Route::get('add/{bomId}', 'BomNeededPartsController@create')->name('addNeededPartToBom');
								Route::post('add/{bomId}', 'BomNeededPartsController@store');

								Route::get('edit/{bomNeededPartId}', 'BomNeededPartsController@edit')->name('editNeededPartForBom');
								Route::post('edit/{bomNeededPartId}', 'BomNeededPartsController@update');

								Route::get('delete/{bomNeededPartId}', 'BomNeededPartsController@delete')->name('deleteNeededPartFromBom');
							}
						);
					}
				);

				Route::group(
					[
						'prefix' => 'routes',
						'namespace' => 'Routes'
					],
					function() {
						Route::get('/', 'RoutesController@index')->name('routes');

						Route::get('new', 'RoutesController@create')->name('newRoute');
						Route::post('new', 'RoutesController@store');

						Route::get('edit/{routeId}', 'RoutesController@edit')->name('editRoute');
						Route::post('edit/{routeId}', 'RoutesController@update');

						Route::get('show/{routeId}', 'RoutesController@show')->name('showRoute');

						Route::get('delete/{routeId}', 'RoutesController@delete')->name('deleteRoute');
					}
				);

				Route::group(
					[
						'prefix' => 'partbomroute',
						'namespace' => 'PartBomRoute'
					],
					function() {
						Route::group(
							[
								'prefix' => 'define'
							],
							function() {
								Route::get('bomToPart/{partId}', 'DefineController@bomToPart')->name('defineBomToPart');
								Route::post('bomToPart/{partId}', 'DefineController@bomToPartStore');

								Route::get('routeToBom/{bomId}', 'DefineController@routeToBom')->name('defineRouteToBom');
								Route::post('routeToBom/{bomId}', 'DefineController@routeToBomStore');

								Route::get('partToBom/{bomId}', 'DefineController@partToBom')->name('definePartToBom');
								Route::post('partToBom/{bomId}', 'DefineController@partToBomStore');

								Route::get('bomToRoute/{routeId}', 'DefineController@bomToRoute')->name('defineBomToRoute');
								Route::post('bomToRoute/{routeId}', 'DefineController@bomToRouteStore');

								Route::get('workTypeToRoute/{routeId}', 'DefineController@workTypeToRoute')->name('defineWorkTypeToRoute');
								Route::post('workTypeToRoute/{routeId}', 'DefineController@workTypeToRouteStore');

								Route::get('workCenterToWorkType/{workTypeId}', 'DefineController@workCenterToWorkType')->name('defineWorkCenterToWorkType');
								Route::post('workCenterToWorkType/{workTypeId}', 'DefineController@workCenterToWorkTypeStore');
							}
						);

						Route::group(
							[
								'prefix' => 'remove'
							],
							function() {
								Route::get('partbom/{partBomId}', 'RemoveController@partBom')->name('removeConnectionPartBom');
								Route::get('bomroute/{bomRouteId}', 'RemoveController@bomRoute')->name('removeConnectionBomRoute');
								Route::get('routeworktype/{routeWorkTypeId}', 'RemoveController@routeWorkType')->name('removeConnectionRouteWorkType');
								Route::get('worktypeworkcenter/{worktypeworkcenter}', 'RemoveController@workTypeWorkCenter')->name('removeConnectionWorkTypeWorkCenter');
							}
						);

						Route::group(
							[
								'prefix' => 'default'
							],
							function() {
								Route::get('bomForPart/{partBomId}', 'DefaultController@bomForPart')->name('makeBomDefaultForPart');
								Route::get('removeDefaultBomFromPart/{partBomId}', 'DefaultController@removeBomForPart')->name('removeDefaultBomFromPart');

								Route::get('routeForBom/{bomRouteId}', 'DefaultController@routeForBom')->name('makeRouteDefaultForBom');
								Route::get('removeDefaultRouteFromBom/{bomRouteId}', 'DefaultController@removeRouteFromBom')->name('removeDefaultRouteFromRoute');
							}
						);
					}
				);

				Route::group(
					[
						'prefix' => 'operations',
						'namespace'	=> 'WorkTypes'
					],
					function() {
						Route::get('/', 'WorkTypesController@index')->name('workTypes');

						Route::get('new', 'WorkTypesController@create')->name('newWorkType');
						Route::post('new', 'WorkTypesController@store');

						Route::get('edit/{workTypeId}', 'WorkTypesController@edit')->name('editWorkType');
						Route::post('edit/{workTypeId}', 'WorkTypesController@update');

						Route::get('show/{workTypeId}', 'WorkTypesController@show')->name('showWorkType');

						Route::get('delete/{workTypeId}', 'WorkTypesController@delete')->name('deleteWorkType');


					}
				);

				Route::group(
					[
						'prefix' => 'operations/centers',
						'namespace' => 'WorkCenters'
					],
					function() {
						Route::get('/', 'WorkCentersController@index')->name('workCenters');

						Route::get('new', 'WorkCentersController@create')->name('newWorkCenter');
						Route::post('new', 'WorkCentersController@store');

						Route::get('edit/{workCenterId}', 'WorkCentersController@edit')->name('editWorkCenter');
						Route::post('edit/{workCenterId}', 'WorkCentersController@update');

						Route::get('show/{workCenterId}', 'WorkCentersController@show')->name('showWorkCenter');

						Route::get('delete/{workCenterId}', 'WorkCentersController@delete')->name('deleteWorkCenter');
					}
				);
			}
		);

		Route::group(
			[
				'prefix' => 'inventory',
				'namespace'	=> 'Inventory'
			],
			function() {
				Route::get('/', 'StockController@index')->name('lots');

				Route::get('new', 'StockController@create')->name('newLot');
				Route::post('new', 'StockController@store');

				Route::get('show/{lotId}', 'StockController@show')->name('showLot');

				Route::get('delete/{lotId}', 'StockController@delete')->name('deleteLot');

				Route::get('inventory', 'StockController@inventory')->name('inventory');

				Route::get('lotsOf/{itemId}', 'StockController@lotsOf')->name('lotsOfPart');
			}
		);

		Route::group(
			[
				'prefix' => 'manufacturing',
				'namespace' => 'Manufacturing'
			],
			function() {
				Route::get('/', 'ManufacturingController@index')->name('productionOrders');

				Route::get('new', 'ManufacturingController@create')->name('newProductionOrder');
				Route::post('new', 'ManufacturingController@store');

				Route::get('show/{productionOrderId}', 'ManufacturingController@show')->name('showProductionOrder');

				Route::get('delete/{productionOrderId}', 'ManufacturingController@delete')->name('deleteProductionOrder');

				Route::get('work/finish/{productionRotationId}', 'ManufacturingController@workFinish')->name('finishProductionRotation');

				Route::get('consume/{productionNeededPartId}', 'ManufacturingController@consume')->name('consumeProductionNeededParts');
				Route::post('consume/{productionNeededPartId}', 'ManufacturingController@consumed');

				Route::post('defineMachine/{rotationId}', 'ManufacturingController@defineWorkCenter')->name('defineWorkCenterForManufacturing');

				Route::post('isinbikisminiyap/{rotationId}', 'ManufacturingController@isinbikisminiyap')->name('isinBiKisminiYap');

				Route::get('joblist/{workTypeId}', 'ManufacturingController@jobList')->name('manufacturingOfJob');
				Route::get('getOutputJobList/{workTypeId}', 'ManufacturingController@getOutputJobList')->name('getOutputJobList');

				Route::get('machinelist/{workCenterId}', 'ManufacturingController@workCenterList')->name('manufacturingOfMachine');
			}
		);

		Route::group(['namespace' => 'Auth'], function(){
			Route::get('logout', 'AuthController@logout')->name('logout');
		});


	});


	Route::group(['middleware' => 'unauth'], function(){
		Route::group(['namespace' => 'Auth'], function() {
			Route::get('login', 'AuthController@login')->name('login');
			Route::post('login', 'AuthController@doLogin');
		});

	});