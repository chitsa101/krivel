<?php
require(ABSPATH.'/mailer/PHPMailerAutoload.php'); 


// $email_from = 'nuta.sav@yandex.ru'; 
// $name_from = 'Заявка с сайта'; 
// $email_to = 'nuta.sav@yandex.ru';

add_theme_support( 'post-thumbnails' );

add_action( 'wp_enqueue_scripts', 'my_scripts_method' );
function my_scripts_method(){
    wp_enqueue_style( 'style-name', get_stylesheet_directory_uri() . '/style.min.css');
	wp_enqueue_style( 'style', get_stylesheet_directory_uri() . '/assets/css/bootstrap.css');


    wp_enqueue_script( 'my-jquery', get_template_directory_uri() . '/assets/js/jquery.min.js', '', '', 'true');
    wp_enqueue_script( 'plugins', get_template_directory_uri() . '/assets/js/bootstrap.js', '', '', 'true');
    wp_enqueue_script( 'class', get_template_directory_uri() . '/assets/js/classie.js', '', '', 'true');
    wp_enqueue_script( 'mix', get_template_directory_uri() . '/assets/js/jquery.mixitup.min.js', '', '', 'true');
    wp_enqueue_script( 'scroll', get_template_directory_uri() . '/assets/js/jquery-scrolltofixed-min.js', '', '', 'true');
    wp_enqueue_script( 'valid', get_template_directory_uri() . '/assets/js/jquery.validate.min.js', '', '', 'true');
    wp_enqueue_script( 'vegas', get_template_directory_uri() . '/assets/js/jquery.vegas.js', '', '', 'true');
    wp_enqueue_script( 'main', get_template_directory_uri() . '/assets/js/script.js', '', '', 'true');

}

register_nav_menus(array(
    'main'    => 'Основное меню',    //Название месторасположения меню в шаблоне
));

//Автор статьи: Вывод контента в WordPress без изображений. 
function htm_image_content_filter($content){
  $content = preg_replace("/<img[^>]+\>/i", "", $content);
  $content = preg_replace("/<iframe[^>]+\>/i", "", $content);
  return $content;
}


/**
 * Альтернатива wp_pagenavi. Создает ссылки пагинации на страницах архивов.
 *
 * @param array  $args      Аргументы функции
 * @param object $wp_query  Объект WP_Query на основе которого строится пагинация. По умолчанию глобальная переменная $wp_query
 *
 * @version 2.6
 * @author  Тимур Камаев
 * @link    Ссылка на страницу функции: http://wp-kama.ru/?p=8
 */
function kama_pagenavi( $args = array(), $wp_query = null ){

	if( ! $wp_query ){
		wp_reset_query();
		global $wp_query;
	}

	// параметры по умолчанию
	$default = array(
		'before'          => '',   // Текст до навигации.
		'after'           => '',   // Текст после навигации.
		'echo'            => true, // Возвращать или выводить результат.

		'text_num_page'   => '',           // Текст перед пагинацией.
										   // {current} - текущая.
										   // {last} - последняя (пр: 'Страница {current} из {last}' получим: "Страница 4 из 60").
		'num_pages'       => 10,           // Сколько ссылок показывать.
		'step_link'       => 10,           // Ссылки с шагом (если 10, то: 1,2,3...10,20,30. Ставим 0, если такие ссылки не нужны.
		'dotright_text'   => '…',          // Промежуточный текст "до".
		'dotright_text2'  => '…',          // Промежуточный текст "после".
		'back_text'       => '« назад',    // Текст "перейти на предыдущую страницу". Ставим 0, если эта ссылка не нужна.
		'next_text'       => 'вперед »',   // Текст "перейти на следующую страницу".  Ставим 0, если эта ссылка не нужна.
		'first_page_text' => '« к началу', // Текст "к первой странице".    Ставим 0, если вместо текста нужно показать номер страницы.
		'last_page_text'  => 'в конец »',  // Текст "к последней странице". Ставим 0, если вместо текста нужно показать номер страницы.
	);

	// Cовместимость с v2.5: kama_pagenavi( $before = '', $after = '', $echo = true, $args = array() )
	if( func_num_args() && is_string( func_get_arg(0) ) ){
		$default['before'] = func_get_arg(0);
		$default['after']  = func_get_arg(1);
		$default['echo']   = func_get_arg(2);
	}

	$default = apply_filters( 'kama_pagenavi_args', $default ); // чтобы можно было установить свои значения по умолчанию

	$rg = (object) array_merge( $default, $args );

	//$posts_per_page = (int) $wp_query->get('posts_per_page');
	$paged          = (int) $wp_query->get('paged');
	$max_page       = $wp_query->max_num_pages;

	// проверка на надобность в навигации
	if( $max_page <= 1 )
		return false;

	if( empty( $paged ) || $paged == 0 )
		$paged = 1;

	$pages_to_show = intval( $rg->num_pages );
	$pages_to_show_minus_1 = $pages_to_show-1;

	$half_page_start = floor( $pages_to_show_minus_1/2 ); // сколько ссылок до текущей страницы
	$half_page_end   = ceil(  $pages_to_show_minus_1/2 ); // сколько ссылок после текущей страницы

	$start_page = $paged - $half_page_start; // первая страница
	$end_page   = $paged + $half_page_end;   // последняя страница (условно)

	if( $start_page <= 0 )
		$start_page = 1;
	if( ($end_page - $start_page) != $pages_to_show_minus_1 )
		$end_page = $start_page + $pages_to_show_minus_1;
	if( $end_page > $max_page ) {
		$start_page = $max_page - $pages_to_show_minus_1;
		$end_page = (int) $max_page;
	}

	if( $start_page <= 0 )
		$start_page = 1;

	$out = '';

	// создаем базу чтобы вызвать get_pagenum_link один раз
	$link_base = str_replace( 99999999, '___', get_pagenum_link( 99999999 ) );
	$first_url = get_pagenum_link( 1 );
	if( false === strpos( $first_url, '?') )
		$first_url = user_trailingslashit( $first_url );

	$out .= '<div class="wp-pagenavi">'."\n";

		if( $rg->text_num_page ){
			$rg->text_num_page = preg_replace( '!{current}|{last}!', '%s', $rg->text_num_page );
			$out.= sprintf( "<span class='pages'>$rg->text_num_page</span> ", $paged, $max_page );
		}
		// назад
		if ( $rg->back_text && $paged != 1 )
			$out .= '<a class="prev" href="'. ( ($paged-1)==1 ? $first_url : str_replace( '___', ($paged-1), $link_base ) ) .'">'. $rg->back_text .'</a> ';
		// в начало
		if ( $start_page >= 2 && $pages_to_show < $max_page ) {
			$out.= '<a class="first" href="'. $first_url .'">'. ( $rg->first_page_text ?: 1 ) .'</a> ';
			if( $rg->dotright_text && $start_page != 2 ) $out .= '<span class="extend">'. $rg->dotright_text .'</span> ';
		}
		// пагинация
		for( $i = $start_page; $i <= $end_page; $i++ ) {
			if( $i == $paged )
				$out .= '<span class="current">'.$i.'</span> ';
			elseif( $i == 1 )
				$out .= '<a href="'. $first_url .'">1</a> ';
			else
				$out .= '<a href="'. str_replace( '___', $i, $link_base ) .'">'. $i .'</a> ';
		}

		// ссылки с шагом
		$dd = 0;
		if ( $rg->step_link && $end_page < $max_page ){
			for( $i = $end_page + 1; $i <= $max_page; $i++ ){
				if( $i % $rg->step_link == 0 && $i !== $rg->num_pages ) {
					if ( ++$dd == 1 )
						$out.= '<span class="extend">'. $rg->dotright_text2 .'</span> ';
					$out.= '<a href="'. str_replace( '___', $i, $link_base ) .'">'. $i .'</a> ';
				}
			}
		}
		// в конец
		if ( $end_page < $max_page ) {
			if( $rg->dotright_text && $end_page != ($max_page-1) )
				$out.= '<span class="extend">'. $rg->dotright_text2 .'</span> ';
			$out.= '<a class="last" href="'. str_replace( '___', $max_page, $link_base ) .'">'. ( $rg->last_page_text ?: $max_page ) .'</a> ';
		}
		// вперед
		if ( $rg->next_text && $paged != $end_page )
			$out.= '<a class="next" href="'. str_replace( '___', ($paged+1), $link_base ) .'">'. $rg->next_text .'</a> ';

	$out .= '</div>';

	$out = apply_filters( 'kama_pagenavi', $rg->before . $out . $rg->after );

	if( $rg->echo )
		echo $out;
	else
		return $out;
}
/**
 * 2.6 (20-10-2018) - Убрал extract().
 *                  - Перенес параметры $before, $after, $echo в $args (старый вариант будет работать).
 * 2.5 - 2.5.1      - Автоматический сброс основного запроса.
 */


 /**
  * счетчик просмотров
  */
function getPostViews($postID){    

    $count_key = 'post_views_count';    
    
    $count = get_post_meta($postID, $count_key, true);    
    
    if($count==''){        
    
    delete_post_meta($postID, $count_key);       
    
    add_post_meta($postID, $count_key, '0');        
    
    return "0 ";    }    
    
	return $count.' ';
}
    
function setPostViews($postID) {    
    
    $count_key = 'post_views_count';    
    
    $count = get_post_meta($postID, $count_key, true);    
    
    if($count==''){        
    
    $count = 0;       
    
    delete_post_meta($postID, $count_key);       
    
    add_post_meta($postID, $count_key, '0');    
    
    }else{        
    
    $count++;        update_post_meta($postID, $count_key, $count);    
    }
}


/*Подзагрузка AJAX*/ 
add_action( 'wp_enqueue_scripts', 'myajax_data', 99 ); 
function myajax_data(){ 
	wp_localize_script('main', 'myajax', 
		array( 
			'url' => admin_url('admin-ajax.php') 
		) 
	); 
}

include_once('functions/shortcode_meta.php');

	// Отправка формы 
add_action('wp_ajax_form_otk', 'form_otk'); 
add_action('wp_ajax_nopriv_form_otk', 'form_otk'); 
function form_otk() { 
	global $email_from; 
	global $name_from; 
	global $email_to; 
	$mail = new PHPMailer; 
	$mail->setFrom(get_field('e-mail', 'option'), 'Заявка с сайта');
	$mail->addAddress(get_field('e-mail', 'option')); 
	$mail->IsHTML(true); 
	$mail->CharSet = 'UTF-8'; 

	$form = $_POST['form']; 

	$mail->Subject = 'Письмо с сайта'; 
	$echo = "Ваше сообщение отправлено"; 

	$mail->Body = ''; 

	foreach($form as $data){ 
	switch($data['name']){ 
		case 'subject': 
		$mail->Subject = $data['value']; 
		break; 

		case 'name': 
		$mail->Body .= 'Имя: '.$data['value'].'<br>'; 
		break;

		// case 'phone': 
		// $mail->Body .= 'Номер телефона: '.$data['value'].'<br>'; 
		// break; 
		
		case 'email': 
		$mail->Body .= 'email: '.$data['value'].'<br>'; 
		break; 

		case 'message': 
		$mail->Body .= 'Комментарий: '.$data['value'].'<br>'; 
		break; 

		// case 'echo': 
		// $echo = $data['value']; 
		// break; 
		}

	} 
	$result = $mail->Send(); 

	echo $echo; 

	die(); 
};
	
