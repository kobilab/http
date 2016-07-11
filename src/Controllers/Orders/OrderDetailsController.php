<?php

	namespace KobiLab\Http\Controllers\Orders;

	use Illuminate\Routing\Controller;

	use KobiLab\Parts;
	use KobiLab\Orders;

	/**
	 * Siparişlerle alakalı işlemleri yapan sınıf
	 */
	class OrderDetailsController extends Controller
	{

		/**
		 * Sınıf içerisinde dolaşacak veriler
		 * 
		 * @var array
		 */
		var $data = [];

		public function __construct() {
			$this->data['theme'] = [
				'first'	=> 'crm',
				'second'=> 'orders'
			];
		}

		/**
		 * Siparişe sipariş itemi eklemek için gerekli olan sayfayı derleyen method
		 * 
		 * @param integer $siparisId Sipariş Id
		 * @return view
		 */
		public function addPartToOrder($siparisId)
		{
			$this->data['parts'] = Parts::all();
			$this->data['detail'] = Orders::find($siparisId);

			return view('zahmetsizce::customers.orders.addPart', $this->data);
		}

		/**
		 * Siparişe eklenen itemi veritabanına eklemeye yarayayn method
		 *
		 * @param  integer $siparisId Sipariş Id
		 * @return redirect
		 */
		public function storePartToOrder($orderId)
		{
			$result = OrderDetails::setFromAllInput()->setRulesForTable('order_details');

			if (!$result->autoCreate()) {
				return redirectTo('newLot');
			} else {
				return redirectTo('lots');
			}

			$veriler = [
				'order_id'	=> $orderId,
				'part_id'	=> Input::get('partId'),
				'quantity'	=> Input::get('quantity'),
				'remainder'	=> Input::get('quantity'),
				'reserved'	=> 0
			];

			$kurallar = [
				'quantity'	=> 'required|numeric',
				'part_id'	=> 'required'
			];

			$okunakli = [
				'quantity'	=> 'Adet',
				'part_id'	=> 'Parça'
			];

			$validator = Validator::make($veriler, $kurallar);
			$validator->setAttributeNames($okunakli);

			if ($validator->fails()) {
				Messages::error($validator->errors()->all());

				return redirect()
						->route('addPartToOrder', $orderId)
						->withMessages(Messages::all())
						->withInput(Input::all());
			} else {
				OrderDetails::create($veriler);
				
				Messages::success('Siparişe parça eklendi.');

				return redirect()
						->route('showOrder', $orderId)
						->withMessages(Messages::all());
			}
		}

		/**
		 * Sipariş itemini düzenlemek için gerekli olan sayfayı derlemeye yarayan method
		 * 
		 * @param  integer $siparisDetayId Sipariş Detay Id
		 * @return view
		 */
		public function partEdit($orderDetailId)
		{
			$this->data['detail'] = OrderDetails::find($orderDetailId);

			return view('customers.orders.partEdit', $this->data);
		}

		/**
		 * Sipariş itemini veritabanında düzenleme işlemini gerçekleştiren method
		 *
		 * @see    burda şöyle bir sıkıntı oluşabilir. sipariş için ayırtılan itemden daha düşük bir sayıya güncelleme yaparsa 
		 *         stokta tutarsızlık olacaktır.
		 * @param  integer $siparisDetayId Sipariş Detay Id
		 * @return redirect
		 */
		public function partUpdate($orderDetailId)
		{
			$veriler = [
				'quantity' => Input::get('quantity')
			];

			$kurallar = [
				'quantity' => 'required|numeric'
			];

			$okunakli = [
				'quantity' => 'Adet'
			];

			$validator = Validator::make($veriler, $kurallar);
			$validator->setAttributeNames($okunakli);

			if ($validator->fails()) {
				Messages::error($validator->errors()->all());

				return redirect()
						->route('editPartOfOrder', $orderDetailId)
						->withMessages(Messages::all())
						->withInput(Input::all());
			} else {
				OrderDetails::find($orderDetailId)->update($veriler);
				
				Messages::success('Sipariş parçası düzenlendi.');

				return redirect()
						->back()
						->withMessages(Messages::all());
			}
		}

		/**
		 * Sipariş itemini silmeye yarayan method
		 *
		 * @see    yukardaki sorunun aynısı siparişe parça ayırt edilmişse ve 
		 *         sipariş silinirse stokta tutarsızlık olacaktır.
		 * @param  integer $siparisDetayId Sipariş Detay Id
		 * @return redirect
		 */
		public function partDelete($orderDetailId)
		{
			OrderDetails::find($orderDetailId)->delete();

			Messages::success('Siparisten parça silindi.');

			return redirect()
					->route('orders')
					->withMessages(Messages::all());
		}

	}
