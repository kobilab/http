<?php

	use Collective\Html\FormFacade as Form;
	use Collective\Html\HtmlFacade as HTML;
	use Illuminate\Support\Facades\Input;

	if (!function_exists('select')) {
		/**
		 * Form select input oluşturmaya yarayan fonksiyon
		 *
		 * @param  string $title   Form başlığı
		 * @param  string $name    Form name değeri
		 * @param  array  $values  Kullanılacak olan veriler
		 * @param  string $default Ön tanımlı form değeri
		 * @return string          Form input içeren string
		 */
		function select($title, $name, $values, $default=null)
		{
			return '<div class="form-group">
						<label class="col-md-2 control-label">'.$title.'</label>
						<div class="col-md-10">
							'.Form::select($name, $values, Input::old($name, $default), ['class' => 'form-control']).'
						</div>
					</div>';
		}
	}

	if (!function_exists('css')) {
		/**
		 * CSS çağırma dosyasını oluşturan fonksiyon
		 * 
		 * @param  string $link       CSS dosyasının bulunduğu fonksiyon
		 * @param  array  $attributes CSS için ekstra etiketler varsa
		 * @return string             CSS dosyasını çağıran string
		 */
		function css($link, $attributes=[])
		{
			return HTML::style($link, $attributes);
		}
	}

	if (!function_exists('script')) {
		/**
		 * JS çağırma dosyasını oluşturan fonksiyon
		 * 
		 * @param  string $link       JS dosyasının bulunduğu fonksiyon
		 * @param  array  $attributes JS için ekstra etiketler varsa
		 * @return string             JS dosyasını çağıran string
		 */
		function script($link, $attributes=[])
		{
			return HTML::script($link, $attributes);
		}
	}


	if (!function_exists('modal')) {
		/**
		 * Modal derlemeye yarayan fonksiyon
		 * 
		 * @param  string 		$id          Modal ID değeri
		 * @param  string 		$route       Yönlendirme adı
		 * @param  string|array $routeDetail Yönlendirme detayları
		 * @param  string 		$title       Modalda kullanılacak olan başlık
		 * @param  string 		$desc        Modalda kullanılacak olan açıklama
		 * @return string       		     Modal html string
		 */
		function modal($id, $route, $routeDetail=null, $title='Onayla', $desc='Silmek istediğinize emin misiniz?')
		{
			return '<div id="'.$id.'" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
									<h4 class="modal-title">'.$title.'</h4>
								</div>
								<div class="modal-body">
									<p>
										'.$desc.'
									</p>
								</div>
								<div class="modal-footer">
									<button type="button" data-dismiss="modal" class="btn default">İptal</button>
									<a href="'.route($route, $routeDetail).'" class="btn blue-hoki">Sil</a>
								</div>
							</div>
						</div>
					</div>';
		}
	}





	function tableTitles($array)
	{
		$string = '<thead><tr>';
		foreach($array as $e) {
			$string .= '<th>'.$e.'</th>';
		}

		return $string.'</tr></thead>';
	}

	function buttonGroup($title, $dropdownMenu) {
		$string = '';

		$string .= '<div class="btn-group">
						<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> İşlemler
							<i class="fa fa-angle-down"></i>
						</button>';

		$string .= dropdownMenu($dropdownMenu) . '</div>';

		return $string;
	}

	function dropdownMenu($array)
	{
		$string = '<ul class="dropdown-menu" role="menu">';
		foreach($array as $e) {
			if($e=='divider') {
				$string .= '<li class="divider"></li>';
			} else {
				$string .= '<li>'. value($e) . '</li>';
			}
		}
		$string .= '</ul>';

		return $string;
	}

	if (!function_exists('newLink')) {
		function newLink($text, $route, $routeDetail=null, $modal = null)
		{
			return createLink('Yeni '.$text, $route, $routeDetail, 'plus', $modal);
		}		
	}

	if (!function_exists('editLink')) {
		function editLink($route, $routeDetail=null, $modal = null)
		{
			return createLink('Düzenle', $route, $routeDetail, 'edit', $modal);
		}		
	}

	if (!function_exists('showLink')) {
		function showLink($route, $routeDetail=null, $modal = null)
		{
			return createLink('İncele', $route, $routeDetail, 'info', $modal);
		}
	}

	if(!function_exists('deleteLink')) {
		function deleteLink($route, $routeDetail = null, $modal = null) {
			return createLink('Sil', $route, $routeDetail, 'remove', $modal);
		}
	}

	if(!function_exists('createLink')) {
		function createLink($text, $route, $routeDetail=null, $icon=null, $modal=null, $class = [])
		{
			$k = '';
			if(count($class)>0) {
				foreach($class as $key => $value) {
					$k .= ' '. $key .'="'.$value. '" ';
				}
			}
			if($modal==true) {
				$r = 'data-toggle="modal" href="#'.$route.'"';
			} else {
				$r = 'href="'.route($route, $routeDetail).'"';
			}

			if($icon===null) {
				$i = '';
			} else {
				$i = '<i class="fa fa-'.$icon.'"></i>';
			}

			return '<a '.$k.' '.$r.'"> '.$i.' '.$text.' </a>';
		}
	}

	if (!function_exists('breadcrumb')) {
		function breadcrumb($array) {
			$string = '';
			$count = count($array);

			$i = 1;
			foreach($array as $e) {
				if(isset($e[2])) {
					$routeDetail = $e[2];
				} else {
					$routeDetail = null;
				}
				if($i==$count) {
					if(isset($e[1])) {
						if($e[1]!='#') {
							$string .= '<li><a href="'.route($e[1], $routeDetail).'">'.$e[0].'</a></li>';
						} else {
							$string .= '<li><a href="#">'.$e[0].'</a></li>';
						}
					} else {
						$string .= '<li><span>'.$e[0].'</span></li>';
					}
				} else {
					if($e[1]!='#') {
				    	$string .= '<li><a href="'.route($e[1], $routeDetail).'">'.$e[0].'</a>';
					} else {
						$string .= '<li><a href="#">'.$e[0].'</a>';
					}
				    $string .= '<i class="fa fa-circle"></i></li>';
				}
				$i++;
			}

			return $string;
		}
	}

	if (!function_exists('open')) {
		/**
		 * Form açmaya yarayan fonksiyon
		 * 
		 * @param  array   $route Formun post edileceği adresi
		 * @return string         Form açılış etiketini içeren string
		 */
		function open($route)
		{
			return Form::open([
				'route'	=> $route,
				'class'	=> 'form-horizontal',
				'role'	=> 'form'
			]);
		}
	}

	if (!function_exists('text')) {
		/**
		 * Form içerisinde input(text) oluşturmaya yarayan fonksiyon
		 * 
		 * @param  string $title   Form başlığı
		 * @param  string $name    Form name değeri
		 * @param  string $default Ön tanımlı form değeri
		 * @return string          Form input içeren string
		 */
		function text($title, $name, $default=null)
		{
			return '<div class="form-group">
						<label class="col-md-2 control-label">'.$title.'</label>
						<div class="col-md-10">
							'.Form::text($name, Input::old($name, $default), ['class' => 'form-control', 'placeholder' => $title]).'
						</div>
					</div>';
		}
	}

	if (!function_exists('submit')) {
		/**
		 * Submit butonu oluşturan fonksiyon
		 * 
		 * @param  string $text  Butonda gözükecek başlık
		 * @param  string $value Butonun içereceği değer
		 * @return string        Submit içeren string
		 */
		function submit($text, $value=null, $name = null)
		{
			return Form::submit($text, ['class' => 'btn green', 'value' => $value, 'name' => $name]);
		}
	}

	if(!function_exists('addButton')) {
		function addButton()
		{
			return submit('Ekle');
		}
	}

	if(!function_exists('editButton')) {
		function editButton()
		{
			return submit('Düzenle');
		}
	}

	if (!function_exists('close')) {
		/**
		 * Form kapatmaya yarayan fonksiyon
		 * 
		 * @return string </form>
		 */
		function close()
		{
			return '</form>';
		}
	}


	if (!function_exists('listThem')) {
		/**
		 * Gelen verileri belirli kural içerisinde listelemeye yarayan foksiyon
		 * 
		 * @param  array   $data  Derlenecek verilerin hepsi
		 * @param  string  $key   Kullanılacak olan key
		 * @param  string  $value Kullanılacak olan value
		 * @param  boolean $empty Boş değer var mı yok mu?
		 * @return array          Sıralanmış dizi
		 */
		function listThem($data, $key, $value, $empty = false)
		{
			$cikti = [];
			if($empty) {
				$cikti[] = null;
			}
			foreach($data as $e) {
				$cikti[$e[$key]] = $e[$value];
			}

			return $cikti;
		}
	}