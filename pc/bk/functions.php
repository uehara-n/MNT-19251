<?php
//--------------------------------画像サイズ/
add_theme_support('post-thumbnails');
add_image_size('w160', 160, 9999, false);//施工事例詳細スタッフ写真・お客様の声スタッフ写真
add_image_size('w160', 160, 9999, false);//施工事例詳細スタッフ写真
add_image_size('w230', 230, 9999, false);//施工事例一覧
add_image_size('w330', 330, 9999, false);//施工事例詳細 大型施工事例間取り
add_image_size('w350', 350, 9999, false);//施工事例詳細
//add_image_size('w800', 800, 9999, false);
add_image_size('w500', 500, 9999, false);//お客様の声
add_image_size('w640', 640, 9999, false);//イベント情報詳細
//add_image_size('w750', 750, 9999, false);
add_image_size('w710', 710, 9999, false);//施工事例詳細
add_image_size('w1400', 1400, 9999, false);//施工事例詳細

//------------------------------------------------------------------------
//                                ショートコード
//------------------------------------------------------------------------
//サイトURL
function shortcode_url() {
    return get_bloginfo('url');
}
add_shortcode('url', 'shortcode_url');
/* 投稿内で [url] と記述する */

//テンプレートURL
function shortcode_templateurl() {
    return get_template_directory_uri();
}
add_shortcode('tmpl_url', 'shortcode_templateurl');
/* 投稿内で [tmpl_url] と記述する */
//　投稿の古い順に表示する　スタッフ
function set_post_types_admin_order( $wp_query ) {
  if (is_admin()) {
  $post_type = $wp_query->query['post_type'];
      if ( $post_type == 'staff' ) {
      $wp_query->set('orderby', 'date');
      $wp_query->set('order', 'ASC');
      }
  }
}
add_filter('pre_get_posts', 'set_post_types_admin_order');

//会社名
//function comname() {
//    return "会社名";
//}
//add_shortcode('comname', 'comname');
/* 投稿内で [comname] と記述する */

//株+会社名
//function comnamekabu() {
//    return "株式会社会社名";
//}
//add_shortcode('comnamekabu', 'comnamekabu');
/* 投稿内で [comnamekabu] と記述する */


//電話番号
//function tel() {
//    return "050-0000-0000";
//}
//add_shortcode('tel', 'tel');
/* 投稿内で [tel] と記述する */

//FAX
//function fax() {
//    return "050-0000-0000";
//}
//add_shortcode('fax', 'fax');
/* 投稿内で [fax] と記述する */

//住所改行あり
//function addbr() {
//    return "〒000-0000<br>○○県○○市○○町0-0-0 <br>○○ビル1F";
//}
//add_shortcode('addbr', 'addbr');
/* 投稿内で [addbr] と記述する */

//住所改行なし
//function add() {
//    return "〒000-0000 ○○県○○市○○町0-0-0 ○○ビル1F";
//}
//add_shortcode('add', 'add');
/* 投稿内で [add] と記述する */


//お問い合わせバナー
function contact_bnr() {
	ob_start();?>
	    <div class="contact_bnr">
      <img src="<?php echo get_template_directory_uri(); ?>/images/common/contact/contact_bg.png" alt="お急ぎの方はお電話がスムーズです　お気軽にお電話ください！　<?php the_field('comtel',  'Options'); ?>"><a href="<?php bloginfo('url'); ?>/contact" class="btn1 btn"><img src="<?php echo get_template_directory_uri(); ?>/images/common/contact/contact_off.png" alt="お問い合わせ" width="178" height="73"></a><a class="btn2 btn" href="<?php bloginfo('url'); ?>/raiten"><img src="<?php echo get_template_directory_uri(); ?>/images/common/contact/raiten_off.png" alt="来店予約" width="178" height="73"></a>
    </div>


<?	$output = ob_get_clean();
	return $output;
}
add_shortcode('contact_bnr', 'contact_bnr');
/* 投稿内で [contact_bnr] と記述する */

//回遊バナー
function kaiyu_bnr() {
	ob_start();?>
	<div class="kaiyu_bnr">ここに回遊バナーがはいるよ</div>

<?	$output = ob_get_clean();
	return $output;
}
add_shortcode('kaiyu_bnr', 'kaiyu_bnr');
/* 投稿内で [kaiyu_bnr] と記述する */



//--------施工事例
function seko_archive($atts){
	extract(shortcode_atts(array(
        'seko_cat' => $seko_cat,
        'staff_id' => $staff_id,
        'kensu' => $kensu,
        'hukusu' => $hukusu,
    ), $atts));
    if($hukusu == 'yes'){
$args = array(
	'post_type' => 'seko', /* 投稿タイプ */
	'seko_cat' => array($seko_cat),
	'seko_staff' => $staff_id,
	'paged' => $paged,
	'posts_per_page' => $kensu /* 件数表示 */
);
    }else{
if(is_singular( 'staff' ) ){
$staff_id = get_the_id();
}
if(is_tax('seko_cat') ){
$term = get_term_by( 'slug', get_query_var( 'term' ), 'seko_cat' );
$term_slug = $term->slug;
$seko_cat = $term_slug;
}
$args = array(
	'post_type' => 'seko', /* 投稿タイプ */
	'seko_cat' => $seko_cat,
	'seko_staff' => $staff_id,
	'paged' => $paged,
	'posts_per_page' => $kensu /* 件数表示 */
);
}
$postslist = new WP_Query( $args );
	ob_start();
//-----------------------------表示される部分はここから
?>
<div class="seko_archive">
	<ul class="list">
		<?php if ( $postslist->have_posts() ) : while ( $postslist->have_posts() ) : $postslist->the_post();
		$pic = get_field( 'seko_after_image' );
		$pic_src = wp_get_attachment_image_src($pic, 'w350'); //表示サイズ
		$img_csv_after = get_field('csv2');//csv用
		?>

          <li><a href="<?php the_permalink(); ?>"><?if ($pic||$img_csv_after){echo '<span class="pic">';
				if ($pic){
				echo '<img src="'.$pic_src[0].'" width="'.$pic_src[1].'" height="'.$pic_src[2].'" alt="'.get_the_title().'" class="img_over">';
				}elseif($img_csv_after){
					echo '<img src="'.get_template_directory_uri().'/'.$img_csv_after.'" alt="写真" width="350" height="" class="img_over">';
				}
				$days = 30; //Newを表示させたい期間の日数
                $today = date_i18n('U');
                $entry = get_the_time('U');
                $kiji = date('U',($today - $entry)) / 86400 ;
                if( $days > $kiji ){
                echo '<img src="';
                bloginfo('template_directory');
                echo '/images/common/icon_new.png" width="93" height="86" alt="new" class="icon_new" />';}
                echo '</span>';
				}
				$seko_name = get_field('seko_name');
			$seko_city = get_field('seko_city');
			if($seko_name||$seko_city){?> <span class="text"><? if($seko_city){
					echo $seko_city.'　';
				}
				if($seko_name){
					echo $seko_name;
				}}?><br>
            <?php if(get_the_title()){ the_title();} ?></span>
            <?
	$field_name = 'seko_sekomachi';
	$field = get_field_object($field_name);
	$field_key = get_field($field_name);
	if ($field_key) {
		$label = $field['choices'][$field_key];
		}
		if($field_key !== 'none'){?>
            <span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/page_image/seko/icon_<?php echo $field_key;?>.png" alt="<? echo $label;?>"></span><? }?>
</a> </li>

				<?php $i++;endwhile;
					else: ?>
<p class="no_data">現在登録されておりません。</p>
<?php endif;
	wp_reset_postdata(); ?>
			</ul>
		</div>
<?
//-----------------------------表示される部分はここまで
	$output = ob_get_clean();
	return $output;
}
add_shortcode('seko_archive', 'seko_archive');



	//--------インタビュー
function interview_archive($atts){
	extract(shortcode_atts(array(
        'post_type' => 'interview',
        'posts_per_page' => $kensu,
    ), $atts));
    $args = array(
	'post_type' => 'interview', /* 投稿タイプ */
	'paged' => $paged,
	'posts_per_page' => $kensu /* 件数表示 */
);

$postslist = new WP_Query( $args );
	ob_start();
//-----------------------------表示される部分はここから
?>
<div class="interview_archive">
	<div class="inner">
		<?php if ( $postslist->have_posts() ) : while ( $postslist->have_posts() ) : $postslist->the_post();
		$pic = get_field( 'mainpic' );
		$pic_src = wp_get_attachment_image_src($pic, 'w230'); //表示サイズ
		?>

		<div class="box"> <a href="<?php the_permalink(); ?>">
			<?if ($pic){
				echo '<span class="pic">';
				echo '<img src="'.$pic_src[0].'" width="'.$pic_src[1].'" height="'.$pic_src[2].'" alt="'.get_the_title().'" class="img_over">';
			}
			echo '<span class="text">'.the_title().'</span>';
			$city = get_field('city');
			$name = get_field('name');
			if($name||$city){
				echo '<span class="name">';
				if($city){
					echo $city.'　';
				}
				if($name){
					echo $name;
				}
				echo '</span>';
			}
			?>
		</a>

					</div>
				<?php $i++;endwhile;
					else: ?>
<p class="no_data">現在登録されておりません。</p>
<?php endif;
	wp_reset_postdata(); ?>
			</div>
		</div>
<?
//-----------------------------表示される部分はここまで
	$output = ob_get_clean();
	return $output;
}
add_shortcode('interview_archive', 'interview_archive');


//----------------------------------------------------------------
//　　　　　　　　　　　　関数化
//----------------------------------------------------------------

//--------一覧ページのページナビ
function pagenavi_a(){ ?>
<div class="customer_navi clearfix">
	<div class="customer_navi_left">
		<p class="customer_red">
			<?php echo gr_get_posts_count(); ?>件</p>
	</div>

	<div class="customer_navi_right">
		<?php if ( function_exists( 'wp_pagenavi' ) ) wp_pagenavi(); ?>
	</div>
</div>

<? }

//--------詳細ページのページナビ
function pagenavi_s(){
	$typelabel = get_post_type_object(get_post_type())->label;
	$typename = get_post_type_object(get_post_type())->name;
 ?>
<div class="customer_navi_c clearfix">
	<div class="page_back_btn01">
		<p class="page_back_text01">
			<?php previous_post_link('%link', '&lt; 前の'.$typelabel.'へ'); ?>
		</p>
	</div>
	<div class="page_back_btn02">
		<p class="page_back_text02"><a href="<?php echo get_post_type_archive_link( $typename ); ?>"><?php echo $typelabel;?> 一覧</a>
		</p>
	</div>
	<div class="page_back_btn02">
		<p class="page_back_text02">
			<?php next_post_link('%link', '次の'.$typelabel.'へ &gt;'); ?>
		</p>
	</div>
</div>
<? }



//--------動画関数化
 function func_movie_archive(){
	 $terms = get_the_terms( $post->ID, 'movie_cat' );

  if ( $terms && ! is_wp_error( $terms ) ) {
      foreach ( $terms as $term ) {
          $slug    = $term->slug;
          $name    = $term->name;
      }
?>
<div class="other_movie">
<?php query_posts( array( 'movie_cat' => $slug, 'posts_per_page' => 3 ));
	if ( have_posts() ): ?>
<h4><? echo($name);?></h4>
		<div id="movie_list">
<?php while( have_posts() ) : the_post(); ?>
		<div class="movie_c">
			<p class="post_thumbnail">
				<a href="<?php the_permalink(); ?>" class="opacity">
					<?php if( get_field( 'youtubeid' ) ):
						$youtubetag = esc_attr( get_field( 'youtubeid' ) ); preg_match( '/www.youtube.[-_\/A-Za-z0-9]*/', $youtubetag, $youtubeUrl ); $youtubeId = str_replace("www.youtube.com/embed/","",$youtubeUrl[0]); echo '<img src="http://img.youtube.com/vi/'.$youtubeId.'/0.jpg">';
							 endif; ?>
				</a>
			</p>
			<div class="post_ttl_wrap">
				<p class="post_ttl"><a href="<?php the_permalink(); ?>"><span class="comment"><?php the_title(); ?></span></a>
				</p>
			</div>
		</div>
<?php endwhile; ?>
		</div>
<?php endif; ?>
<?php wp_reset_query(); ?>
</div>
<? } }

//------------------------------------------------------------------------
//                    カスタムフィールド&カスタム投稿タイプの追加
//------------------------------------------------------------------------
function gr_register_terms( $terms, $taxonomy ) {
	foreach ( $terms as $key => $label ) {
		$keys = explode( '/', $key );
		if ( 1 < count( $keys ) ) {
			$key = $keys[1];
			$parent_id = get_term_by( 'slug', $keys[0], $taxonomy )->term_id;
		} else {
			$parent_id = 0;
		}
		if ( ! term_exists( $key, $taxonomy ) ) {
			wp_insert_term( $label, $taxonomy, array( 'slug' => $key, 'parent' => $parent_id ) );
		}
	}
}

add_action( 'init', 'bc_create_customs', 0 );
function bc_create_customs() {

	// お知らせ
	//register_post_type( 'whatsnew', array(
	//		'labels' => array(
	//	'name' => __( 'お知らせ' ),
	//		),
	//		'public' => true,
	//		'has_archive' => true,
	//		'menu_position' => 5,
	//'supports' => array( 'title', 'editor','author' ),
	//) );
	//register_taxonomy( 'whatsnew_cat', 'whatsnew', array(
	//		 'label' => 'お知らせカテゴリー',
	//	     'hierarchical' => true,
	//) );

	// 施工事例
    register_post_type( 'seko', array(
        'labels' => array(
            'name' => __( '施工事例' ),
        ),
        'public' => true,
        'has_archive' => true,
        'menu_position' => 5,
		'menu_icon' => 'dashicons-admin-tools',
        'supports' => array( 'title', 'editor','author' ),
    ) );

    register_taxonomy( 'seko_cat', 'seko', array(
         'label' => '施工事例カテゴリー',
         'hierarchical' => true,
    ) );



	register_taxonomy( 'seko_staff', 'seko', array(
		'label' => 'スタッフカテゴリー',
         	'hierarchical' => true,
	) );

	// 大型施工事例
//    register_post_type( 'special', array(
//        'labels' => array(
//            'name' => __( '大型施工事例' ),
//        ),
//        'menu_icon' => 'dashicons-admin-tools',
//        'public' => true,
//        'has_archive' => true,
//        'menu_position' => 5,
//        'supports' => array( 'title', 'editor','author' ),
//    ) );

//	register_taxonomy( 'special_staff', 'special', array(
//		'label' => 'スタッフカテゴリー',
//         	'hierarchical' => true,
//	) );
	// インタビュー
//	register_post_type( 'interview', array(
//			'labels' => array(
//		'name' => __( 'インタビュー' ),
//			),
//			'menu_icon' => 'dashicons-format-chat',
//			'public' => true,
//			'has_archive' => true,
//			'menu_position' => 5,
//	'supports' => array( 'title', 'editor','author' ),
//	) );



	// イベント
	register_post_type( 'event', array(
			'labels' => array(
		'name' => __( 'イベント' ),
			),
			'menu_icon' => 'dashicons-universal-access',
			'public' => true,
			'has_archive' => true,
			'menu_position' => 5,
	'supports' => array( 'title', 'editor','author' ),
	) );

	// 動画コンテンツ
//	register_post_type( 'movie', array(
//			'labels' => array(
//		'name' => __( '動画コンテンツ' ),
//			),
//			'menu_icon' => 'dashicons-format-video',
//			'public' => true,
//			'has_archive' => true,
//			'menu_position' => 5,
//	'supports' => array( 'title', 'editor','author' ),
//	) );
//	register_taxonomy( 'movie_cat', 'movie', array(
//			 'label' => '動画カテゴリー',
//				     'hierarchical' => true,
//	) );

	// メディア掲載実績
//	register_post_type( 'media', array(
//			'labels' => array(
//		'name' => __( 'メディア掲載実績' ),
//			),
//			'menu_icon' => 'dashicons-video-alt2',
//			'public' => true,
//			'has_archive' => true,
//			'menu_position' => 5,
//	'supports' => array( 'title', 'editor','author' ),
//	) );

	// よくあるご質問
//	register_post_type( 'faq', array(
//			'labels' => array(
//		'name' => __( 'よくあるご質問' ),
//			),
//			'menu_icon' => 'dashicons-format-chat',
//			'public' => true,
//			'has_archive' => true,
//			'menu_position' => 5,
//	'supports' => array( 'title', 'editor','author' ),
//	) );
//	register_taxonomy( 'faq_cat', 'faq', array(
//			 'label' => 'よくあるご質問カテゴリー',
//				     'hierarchical' => true,
//	) );

	// 現場日記
//	register_post_type( 'genbanikki', array(
//			'labels' => array(
//		'name' => __( '現場日記' ),
//			),
//			'menu_icon' => 'dashicons-welcome-widgets-menus',
//			'public' => true,
//			'has_archive' => true,
//			'menu_position' => 5,
//	'supports' => array( 'title', 'editor','author' ),
//	) );
//	register_taxonomy( 'genba_cat', 'genbanikki', array(
//			 'label' => '現場日記カテゴリー',
//				     'hierarchical' => true,
//	) );
	// お客様の声
	register_post_type( 'voice', array(
			'labels' => array(
			'name' => __( 'お客様の声' ),
			),
			'menu_icon' => 'dashicons-controls-volumeon',
			'public' => true,
			'has_archive' => true,
			'menu_position' => 5,
	'supports' => array( 'title', 'editor','author' ),
	) );
	register_taxonomy( 'voice_staff', 'voice', array(
			 'label' => 'スタッフカテゴリー',
		     'hierarchical' => true,
	) );



	// スタッフ
	register_post_type( 'staff', array(
			'labels' => array(
		'name' => __( 'スタッフ' ),
			),
			'menu_icon' => 'dashicons-businessman',
			'public' => true,
			'menu_position' => 5,
		    'has_archive' => true,
	'supports' => array( 'title', 'editor','author' ),
	) );

	// プロタイムズ通信
	register_post_type( 'news-letter', array(
			'labels' => array(
		'name' => __( 'プロタイムズ通信' ),
		'singular_name' => __( 'プロタイムズ通信')
			),
			'menu_icon' => 'dashicons-media-document',
			'public' => true,
			'has_archive' => true,
			'menu_position' => 5,
	'supports' => array( 'title', 'editor','author' ),
	) );

	// チラシ
	//register_post_type( 'chirashi', array(
	//		'labels' => array(
	//	'name' => __( 'チラシ' ),
	//	'singular_name' => __( 'チラシ')
	//		),
	//		'menu_icon' => 'dashicons-media-document',
	//		'public' => true,
	//		'has_archive' => true,
	//		'menu_position' => 5,
	//'supports' => array( 'title', 'editor','author' ),
	//) );

	// スタッフブログ
	register_post_type( 'blog', array(
			'labels' => array(
		'name' => __( 'スタッフブログ' ),
			),
			'menu_icon' => 'dashicons-welcome-widgets-menus',
			'public' => true,
			'has_archive' => true,
			'menu_position' => 5,
	'supports' => array( 'title', 'editor','author' ),
	) );
	register_taxonomy( 'blog_cat', 'blog', array(
			 'label' => 'スタッフブログカテゴリー',
		     'hierarchical' => true,
	) );
	// コラム
//	register_post_type( 'column', array(
//			'labels' => array(
//		'name' => __( 'コラム' ),
//			),
//			'menu_icon' => 'dashicons-media-text',
//			'public' => true,
//			'has_archive' => true,
//			'menu_position' => 5,
//	'supports' => array( 'title', 'editor','author' ),
//	) );
//	register_taxonomy( 'column_tag', 'column', array(
//			 'label' => 'コラムタグクラウド',
//		     'public' => true,
//			 'show_ui' => true,
//			 'hierarchical' => false
//	) );


}

//// hooks
add_filter( 'wp_list_categories', 'gr_list_categories', 10, 2 );
function gr_list_categories( $output, $args ) {
	return preg_replace( '@</a>\s*\((\d+)\)@', ' ($1)</a>', $output );
}

add_action( 'pre_get_posts', 'gr_pre_get_posts' );
function gr_pre_get_posts( $query ) {
	if ( is_admin() ) {
		if ( in_array( $query->get( 'post_type' ), array( 'seko', 'staff' ) ) ) {
			$query->set( 'posts_per_page', -1 );
		}
		return;
	}
/*
	if ( is_post_type_archive() ) {
		if ( 'seko' == get_query_var( 'post_type' ) ) {
			$query->tax_query[] = array(
				'taxonomy' =>	'seko_cat',
				'term'     => 'kitchen',
				'field'    => 'slug',
			);
		}
	}
*/
}

function gr_adjacent_post_join( $join, $in_same_cat, $excluded_categories ) {
	if ( false && $in_same_cat ) {
		global $post, $wpdb;

		$taxonomy  = $post->post_type . '_cat';
		$terms     = implode( ',', wp_get_object_terms( $post->ID, $taxonomy, array('fields' => 'ids') ) );
		$join      = " INNER JOIN $wpdb->term_relationships AS tr ON p.ID = tr.object_id INNER JOIN $wpdb->term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id";
		$join     .= $wpdb->prepare( " AND tt.taxonomy = %s AND tt.term_id IN ($terms)", $taxonomy );
	}

	return $join;
}
function gr_get_posts_count() {
	global $wp_query;
	return get_query_var( 'posts_per_page' ) ? $wp_query->found_posts : $wp_query->post_count;
}


function gr_image_id( $key ) {
    $imagefield = get_field( $key );
    return  preg_replace('/(\[)([0-9]+)(\])(http.+)?/', '$2', $imagefield );
}

function gr_get_image( $key, $att = '' ) {
	$id = gr_image_id( $key );

	if ( is_numeric( $id ) ) {
		if ( isset( $att['size'] ) ) {
			$size = $att['size'];
			unset( $att['size'] );
		}
		if ( isset( $att['width'] ) ) {
			$size = array( $att['width'], 99999 );
			unset( $att['width'] );
		}
		return wp_get_attachment_image( $id, $size, false, $att );
	}

	if ( $id ) {
		/* ファイル存在チェック
		 * $id = /images/seko/289-2-t.jpg のようなパスでここに渡ってくるので
		 * get_stylesheet_directory_uri()のようなhttpで絶対パスを指定せず
		 * dirname(__FILE__)でチェック
		 */
		if( file_exists( dirname(__FILE__) . "$id" ) ) {
			return sprintf(
				'<img src="%1$s%2$s"%3$s%4$s%5$s />',
				get_stylesheet_directory_uri(),
				$id,
				( $att['width' ] ? ' width="' .$att['width' ].'"' : '' ),
				( $att['height'] ? ' height="'.$att['height'].'"' : '' ),
				( $att['alt'   ] ? ' alt="'   .$att['alt'   ].'"' : '' )
			);
		}
	}

	return '';
}

function gr_get_image_src( $key ) {
	$id = gr_image_id( $key );
	$src = '';

	if ( is_numeric( $id ) ) {
		@list( $src, $width, $height ) = wp_get_attachment_image_src( $id, $size, false );
	} else if ( $id ) {
		$src = get_stylesheet_directory_uri() . $id;
	}
	return $src;
}
//------------------------------------------------------------------------
//                    　　　　　　　　　　回　遊
//------------------------------------------------------------------------
function gr_contact_banner() {
?>
<!-- ======================問合わせテーブルここから======================= -->
<div class="k_contact">
<a href="/contact"><img src="<?php bloginfo('template_url'); ?>/images/kaiyu/toi_new2.png" width="730" height="180" alt="お問い合わせ" class="img_over"/></a>
</div>
<!-- ======================問合わせテーブルここまで======================= -->

<?php
}

function gr_kaiyu() {
?>

<!-- ======================回遊バナーここから======================= -->
<div class="kaiyu">
<span class="fl img_over mb10 mr8"><a href="/seko_cat/gaiheki"><img src="<?php bloginfo('template_url'); ?>/page_image/top/kaiyu01.jpg" width="342" height="163" alt="外壁塗装" class="img_over"/></a></span>
<!-- <span class="fl mb10 mr8"><a href="/seko_cat/yanetoso"><img src="<?php bloginfo('template_url'); ?>/page_image/top/bnrg_yane.png" width="224" height="134" alt="屋根塗装" class="img_over"/></a></span> -->
<span class="fl mb10"><a href="/seko_cat/apart"><img src="<?php bloginfo('template_url'); ?>/page_image/top/kaiyu02.jpg" width="342" height="163" alt="ビル・アパート・マンション" class="img_over"/></a></span>

<span class="fl mb10 mr8 ml15"><a href="/seko_cat/daiwahouse"><img src="<?php bloginfo('template_url'); ?>/page_image/top/kaiyu03.jpg" alt="大和ハウス" width="215" height="163" class="img_over"/></a></span>
<span class="fl mb10 mr8"><a href="/seko_cat/misawahome"><img src="<?php bloginfo('template_url'); ?>/page_image/top/kaiyu04.jpg" alt="ミサワホーム" width="215" height="163" class="img_over"/></a></span>
<span class="fl mb10 mr8"><a href="/seko_cat/panahome"><img src="<?php bloginfo('template_url'); ?>/page_image/top/kaiyu05.jpg" alt="パナホーム" width="215" height="163" class="img_over"/></a></span>
<span class="fl mb10 mr8 ml127"><a href="/seko_cat/toyotahome"><img src="<?php bloginfo('template_url'); ?>/page_image/top/kaiyu06.jpg" alt="トヨタホーム" width="215" height="163" class="img_over"/></a></span>
<span class="fl mb10"><a href="/seko_cat/sekisuihouse"><img src="<?php bloginfo('template_url'); ?>/page_image/top/kaiyu07.jpg" alt="積水ホーム" width="215" height="163" class="img_over"/></a></span>
</div>
<!-- ======================回遊バナーここまで======================= -->

<?php
}

//---------------------------------------------------------------------------
//                                   パンくず
//---------------------------------------------------------------------------

function the_pankuzu_keni( $separator = '　→　', $multiple_separator = '　|　' )
{
	global $wp_query;

	echo("<li><a href=\""); bloginfo('url'); echo("\">HOME</a>$separator</li>" );

	$queried_object = $wp_query->get_queried_object();

	if( is_page() )
	{
		//ページ
		if( $queried_object->post_parent )
		{
			echo( get_page_parents_keni( $queried_object->post_parent, $separator ) );
		}
		echo '<li>'; the_title(); echo '</li>';
	}
	else if( is_archive() )
	{
		if( is_post_type_archive() )
		{
			echo '<li>'; post_type_archive_title(); echo '</li>';
		}
		else if( is_category() )
		{
			//カテゴリアーカイブ
			if( $queried_object->category_parent )
			{
				echo get_category_parents( $queried_object->category_parent, 1, $separator );
			}
			echo '<li>'; single_cat_title(); echo '</li>';
		}
		else if( is_day() )
		{
			echo '<li>'; printf( __('Archive List for %s','keni'), get_the_time(__('F j, Y','keni'))); echo '</li>';
		}
		else if( is_month() )
		{
			echo '<li>'; printf( __('Archive List for %s','keni'), get_the_time(__('F Y','keni'))); echo '</li>';
		}
		else if( is_year() )
		{
			echo '<li>'; printf( __('Archive List for %s','keni'), get_the_time(__('Y','keni'))); echo '</li>';
		}
		else if( is_author() )
		{
			echo '<li>'; _e('Archive List for authors','keni'); echo '</li>';
		}
		else if(isset($_GET['paged']) && !empty($_GET['paged']))
		{
			echo '<li>'; _e('Archive List for blog','keni'); echo '</li>';
		}
		else if( is_tag() )
		{
			//タグ
			echo '<li>'; printf( __('Tag List for %s','keni'), single_tag_title('',0)); echo '</li>';
		}
	}
	else if( is_single() )
	{
		$obj = get_post_type_object( $queried_object->post_type );
		if ( $obj->has_archive ) {
			printf(
				'<li><a href="%1$s">%2$s</a>%3$s</li>',
				get_post_type_archive_link( $obj->name ),
				apply_filters( 'post_type_archive_title', $obj->labels->name ),
				$separator
			);
		} else {
			//シングル
			echo '<li>'; the_category_keni( $separator, 'multiple', false, $multiple_separator ); echo '</li>';
			echo( $separator );
		}
		echo '<li>'; the_title(); echo '</li>';
	}
	else if( is_search() )
	{
		//検索
		echo '<li>'; printf( __('Search Result for %s','keni'), strip_tags(get_query_var('s'))); echo '</li>';
	}
	else
	{
		$request_value = "";
		foreach( $_REQUEST as $request_key => $request_value ){
			if( $request_key == 'sitemap' ){ $request_value = $request_key; break; }
		}

		if( $request_value == 'sitemap' )
		{
			echo '<li>'; _e('Sitemap','keni'); echo '</li>';
		}
		else
		{
			echo '<li>'; the_title(); echo '</li>';
		}
	}
}

function get_page_parents_keni( $page, $separator )
{
	$pankuzu = "";

	$post = get_post( $page );

	$pankuzu = '<li><a href="'. get_permalink( $post ) .'">' . $post->post_title . '</a>' . $separator . '</li>';

	if( $post->post_parent )
	{
		$pankuzu = get_page_parents_keni( $post->post_parent, $separator ) . $pankuzu;
	}

	return $pankuzu;
}

function the_category_keni($separator = '', $parents='', $post_id = false, $multiple_separator = '/') {
	echo get_the_category_list_keni($separator, $parents, $post_id, $multiple_separator);
}

function get_the_category_list_keni($separator = '', $parents='', $post_id = false, $multiple_separator = '/')
{
	global $wp_rewrite;
	$categories = get_the_category($post_id);
	if (empty($categories))
		return apply_filters('the_category', __('Uncategorized', 'keni'), $separator, $parents);

	$rel = ( is_object($wp_rewrite) && $wp_rewrite->using_permalinks() ) ? 'rel="category tag"' : 'rel="category"';

	$thelist = '';
	if ( '' == $separator ) {
		$thelist .= '<ul class="post-categories">';
		foreach ( $categories as $category ) {
			$thelist .= "\n\t<li>";
			switch ( strtolower($parents) ) {
				case 'multiple':
					if ($category->parent)
						$thelist .= get_category_parents($category->parent, TRUE, $separator);
					$thelist .= '<a href="' . get_category_link($category->term_id) . '" title="' . sprintf(__('View all posts in %s', 'keni'), $category->name) . '" ' . $rel . '>' . $category->name.'</a></li>';
					break;
				case 'single':
					$thelist .= '<a href="' . get_category_link($category->term_id) . '" title="' . sprintf(__('View all posts in %s', 'keni'), $category->name) . '" ' . $rel . '>';
					if ($category->parent)
						$thelist .= get_category_parents($category->parent, FALSE);
					$thelist .= $category->name.'</a></li>';
					break;
				case '':
				default:
					$thelist .= '<a href="' . get_category_link($category->term_id) . '" title="' . sprintf(__('View all posts in %s', 'keni'), $category->name) . '" ' . $rel . '>' . $category->cat_name.'</a></li>';
			}
		}
		$thelist .= '</ul>';
	} else {
		$i = 0;
		foreach ( $categories as $category ) {
			if ( 0 < $i )
				$thelist .= $multiple_separator . ' ';
			switch ( strtolower($parents) ) {
				case 'multiple':
					if ( $category->parent )
						$thelist .= get_category_parents($category->parent, TRUE, $separator);
					$thelist .= '<a href="' . get_category_link($category->term_id) . '" title="' . sprintf(__('View all posts in %s', 'keni'), $category->name) . '" ' . $rel . '>' . $category->cat_name.'</a>';
					break;
				case 'single':
					$thelist .= '<a href="' . get_category_link($category->term_id) . '" title="' . sprintf(__('View all posts in %s', 'keni'), $category->name) . '" ' . $rel . '>';
					if ( $category->parent )
						$thelist .= get_category_parents($category->parent, FALSE);
					$thelist .= "$category->cat_name</a>";
					break;
				case '':
				default:
					$thelist .= '<a href="' . get_category_link($category->term_id) . '" title="' . sprintf(__('View all posts in %s', 'keni'), $category->name) . '" ' . $rel . '>' . $category->name.'</a>';
			}
			++$i;
		}
	}
	return apply_filters('the_category', $thelist, $separator, $parents);
}


//カレンダー
function widget_customCalendar($args) {
	extract($args);
	echo $before_widget;
	echo get_calendar_custom(カスタム投稿名);
	echo $after_widget;
}


function get_calendar_custom($posttype,$initial = true) {
	global $wpdb, $m, $monthnum, $year, $wp_locale, $posts;

	$key = md5( $m . $monthnum . $year );
	if ( $cache = wp_cache_get( 'get_calendar_custom', 'calendar_custom' ) ) {
		if ( isset( $cache[ $key ] ) ) {
			echo $cache[ $key ];
			return;
		}
	}

	ob_start();
	// Quick check. If we have no posts at all, abort!
	if ( !$posts ) {
		$gotsome = $wpdb->get_var("SELECT ID from $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish' ORDER BY post_date DESC LIMIT 1");
		if ( !$gotsome )
			return;
	}

	if ( isset($_GET['w']) )
		$w = ''.intval($_GET['w']);

	// week_begins = 0 stands for Sunday
	$week_begins = intval(get_option('start_of_week'));

	// Let's figure out when we are
	if ( !empty($monthnum) && !empty($year) ) {
		$thismonth = ''.zeroise(intval($monthnum), 2);
		$thisyear = ''.intval($year);
	} elseif ( !empty($w) ) {
		// We need to get the month from MySQL
		$thisyear = ''.intval(substr($m, 0, 4));
		$d = (($w - 1) * 7) + 6; //it seems MySQL's weeks disagree with PHP's
		$thismonth = $wpdb->get_var("SELECT DATE_FORMAT((DATE_ADD('${thisyear}0101', INTERVAL $d DAY) ), '%m')");
	} elseif ( !empty($m) ) {
		$thisyear = ''.intval(substr($m, 0, 4));
		if ( strlen($m) < 6 )
				$thismonth = '01';
		else
				$thismonth = ''.zeroise(intval(substr($m, 4, 2)), 2);
	} else {
		$thisyear = gmdate('Y', current_time('timestamp'));
		$thismonth = gmdate('m', current_time('timestamp'));
	}

	$unixmonth = mktime(0, 0 , 0, $thismonth, 1, $thisyear);

	// Get the next and previous month and year with at least one post
	$previous = $wpdb->get_row("SELECT DISTINCT MONTH(post_date) AS month, YEAR(post_date) AS year
		FROM $wpdb->posts
		LEFT JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id)
		LEFT JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)

		WHERE post_date < '$thisyear-$thismonth-01'

		AND post_type = '$posttype' AND post_status = 'publish'
			ORDER BY post_date DESC
			LIMIT 1");

	$next = $wpdb->get_row("SELECT	DISTINCT MONTH(post_date) AS month, YEAR(post_date) AS year
		FROM $wpdb->posts
		LEFT JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id)
		LEFT JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)

		WHERE post_date >	'$thisyear-$thismonth-01'

		AND MONTH( post_date ) != MONTH( '$thisyear-$thismonth-01' )
		AND post_type = '$posttype' AND post_status = 'publish'
			ORDER	BY post_date ASC
			LIMIT 1");

	echo '<div id="calendar_wrap">
	<table id="wp-calendar" summary="' . __('Calendar') . '">
	<caption>' . date('Y年n月', $unixmonth) . '</caption>
	<thead>
	<tr>';

	$myweek = array();

	for ( $wdcount=0; $wdcount<=6; $wdcount++ ) {
		$myweek[] = $wp_locale->get_weekday(($wdcount+$week_begins)%7);
	}

	foreach ( $myweek as $wd ) {
		$day_name = (true == $initial) ? $wp_locale->get_weekday_initial($wd) : $wp_locale->get_weekday_abbrev($wd);
		echo "\n\t\t<th abbr=\"$wd\" scope=\"col\" title=\"$wd\">$day_name</th>";
	}

	echo '
	</tr>
	</thead>

	<tfoot>
	<tr>';

	echo '
	</tr>
	</tfoot>
	<tbody>
	<tr>';

	// Get days with posts
	$dyp_sql = "SELECT DISTINCT DAYOFMONTH(post_date)
		FROM $wpdb->posts

		LEFT JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id)
		LEFT JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)

		WHERE MONTH(post_date) = '$thismonth'

		AND YEAR(post_date) = '$thisyear'
		AND post_type = '$posttype' AND post_status = 'publish'
		AND post_date < '" . current_time('mysql') . "'";

	$dayswithposts = $wpdb->get_results($dyp_sql, ARRAY_N);

	if ( $dayswithposts ) {
		foreach ( (array) $dayswithposts as $daywith ) {
			$daywithpost[] = $daywith[0];
		}
	} else {
		$daywithpost = array();
	}

	if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false || strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'camino') !== false || strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'safari') !== false)
		$ak_title_separator = "\n";
	else
		$ak_title_separator = ', ';

	$ak_titles_for_day = array();
	$ak_post_titles = $wpdb->get_results("SELECT post_title, DAYOFMONTH(post_date) as dom "
		."FROM $wpdb->posts "

		."LEFT JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id) "
		."LEFT JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id) "

		."WHERE YEAR(post_date) = '$thisyear' "

		."AND MONTH(post_date) = '$thismonth' "
		."AND post_date < '".current_time('mysql')."' "
		."AND post_type = '$posttype' AND post_status = 'publish'"
	);
	if ( $ak_post_titles ) {
		foreach ( (array) $ak_post_titles as $ak_post_title ) {

				$post_title = apply_filters( "the_title", $ak_post_title->post_title );
				$post_title = str_replace('"', '&quot;', wptexturize( $post_title ));

				if ( empty($ak_titles_for_day['day_'.$ak_post_title->dom]) )
					$ak_titles_for_day['day_'.$ak_post_title->dom] = '';
				if ( empty($ak_titles_for_day["$ak_post_title->dom"]) ) // first one
					$ak_titles_for_day["$ak_post_title->dom"] = $post_title;
				else
					$ak_titles_for_day["$ak_post_title->dom"] .= $ak_title_separator . $post_title;
		}
	}

	// See how much we should pad in the beginning
	$pad = calendar_week_mod(date('w', $unixmonth)-$week_begins);
	if ( 0 != $pad )
		echo "\n\t\t".'<td colspan="'.$pad.'" class="pad">&nbsp;</td>';

	$daysinmonth = intval(date('t', $unixmonth));
	for ( $day = 1; $day <= $daysinmonth; ++$day ) {
		if ( isset($newrow) && $newrow )
			echo "\n\t</tr>\n\t<tr>\n\t\t";
		$newrow = false;

		if ( $day == gmdate('j', (time() + (get_option('gmt_offset') * 3600))) && $thismonth == gmdate('m', time()+(get_option('gmt_offset') * 3600)) && $thisyear == gmdate('Y', time()+(get_option('gmt_offset') * 3600)) )
			echo '<td id="today">';
		else
			echo '<td>';

		if ( in_array($day, $daywithpost) ) // any posts today?
				echo '<a href="' .  $home_url . '/' . $posttype .  '/date/' . $thisyear . '/' . $thismonth . '/' . $day . "\">$day</a>";
		else
			echo $day;
		echo '</td>';

		if ( 6 == calendar_week_mod(date('w', mktime(0, 0 , 0, $thismonth, $day, $thisyear))-$week_begins) )
			$newrow = true;
	}

	$pad = 7 - calendar_week_mod(date('w', mktime(0, 0 , 0, $thismonth, $day, $thisyear))-$week_begins);
	if ( $pad != 0 && $pad != 7 )
		echo "\n\t\t".'<td class="pad" colspan="'.$pad.'">&nbsp;</td>';

	echo "\n\t</tr>\n\t</tbody>\n\t</table></div>";

	echo "\n\t<div class=\"calender_navi\"><table cellspacing=\"0\" cellpadding=\"0\"><tr>";

	if ( $previous ) {
		echo "\n\t\t".'<td abbr="' . $wp_locale->get_month($previous->month) . '" colspan="3" id="prev"><a href="' .  $home_url . '/' . $posttype .  '/date/' . $previous->year . '/' . $previous->month . '" title="' . sprintf(__('View posts for %1$s %2$s'), $wp_locale->get_month($previous->month),			date('Y', mktime(0, 0 , 0, $previous->month, 1, $previous->year))) . '">&laquo; ' . $wp_locale->get_month_abbrev($wp_locale->get_month($previous->month)) . '</a></td>';
	} else {
		echo "\n\t\t".'<td colspan="3" id="prev" class="pad">&nbsp;</td>';
	}

	echo "\n\t\t".'<td class="pad">&nbsp;</td>';

	if ( $next ) {
		echo "\n\t\t".'<td abbr="' . $wp_locale->get_month($next->month) . '" colspan="3" id="next"><a href="' .  $home_url . '/' . $posttype .  '/date/' . $next->year . '/' . $next->month . '" title="' . sprintf(__('View posts for %1$s %2$s'), $wp_locale->get_month($next->month),			date('Y', mktime(0, 0 , 0, $next->month, 1, $next->year))) . '">' . $wp_locale->get_month_abbrev($wp_locale->get_month($next->month)) . ' &raquo;</a></td>';
	} else {
		echo "\n\t\t".'<td colspan="3" id="next" class="pad">&nbsp;</td>';
	}
	echo "\n\t</tr></table></div>";

	$output = ob_get_contents();
	ob_end_clean();
	echo $output;
	$cache[ $key ] = $output;
	wp_cache_set( 'get_calendar_custom', $cache, 'calendar_custom' );
}
//カレンダー

//------------------------------------------------------------------------
//             　　　　　　　       記事画像呼出し
//------------------------------------------------------------------------
function catch_that_image() {
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $first_img = $matches [1] [0];

    if(empty($first_img)){ //Defines a default image
        $first_img = "/wp-content/themes/reform/images/common/default.png";
    }
return $first_img;
}
//------------------------------------------------------------------------
//                   階層が一番上のページスラッグ名を取得
//------------------------------------------------------------------------
function ps_get_root_page( $cur_post, $cnt = 0 ) {
    if ( $cnt > 100 ) { return false; }
    $cnt++;
    if ( $cur_post->post_parent == 0 ) {
        $root_page = $cur_post;
    } else {
        $root_page = ps_get_root_page( get_post( $cur_post->post_parent ), $cnt );
    }
    return $root_page;
}
//------------------------------------------------------------------------
//         contactform7プラグインに記事のカスタムフィールドの値を挿入
//------------------------------------------------------------------------

add_filter('wpcf7_special_mail_tags', 'my_special_mail_tags',10,2);
function my_special_mail_tags($output, $name)
{
    if ( ! isset( $_POST['_wpcf7_unit_tag'] ) || empty( $_POST['_wpcf7_unit_tag'] ) )
        return $output;
    if ( ! preg_match( '/^wpcf7-f(\d+)-p(\d+)-o(\d+)$/', $_POST['_wpcf7_unit_tag'], $matches ) )
        return $output;

    $post_id = (int) $matches[2];//開催日
    if ( ! $post = get_post( $post_id ) )
        return $output;
    $name = preg_replace( '/^wpcf7\./', '_', $name );
    if ( 'event_date_check' == $name )
        $output = get_post_meta($post->ID,'event_date',true);

    $post_id = (int) $matches[2];//開催時間
    if ( ! $post = get_post( $post_id ) )
        return $output;
    $name = preg_replace( '/^wpcf7\./', '_', $name );
    if ( 'event_time_check' == $name )
        $output = get_post_meta($post->ID,'event_time',true);

    $post_id = (int) $matches[2];//開催場所
    if ( ! $post = get_post( $post_id ) )
        return $output;
    $name = preg_replace( '/^wpcf7\./', '_', $name );
    if ( 'event_place_check' == $name )
        $output = get_post_meta($post->ID,'event_place',true);

    $post_id = (int) $matches[2];//開催場所郵便番号
    if ( ! $post = get_post( $post_id ) )
        return $output;
    $name = preg_replace( '/^wpcf7\./', '_', $name );
    if ( 'event_zip_check' == $name )
        $output = get_post_meta($post->ID,'event_zip',true);

    $post_id = (int) $matches[2];//開催場所住所
    if ( ! $post = get_post( $post_id ) )
        return $output;
    $name = preg_replace( '/^wpcf7\./', '_', $name );
    if ( 'event_add_check' == $name )
        $output = get_post_meta($post->ID,'event_add',true);

    return $output;

    if ( ! isset( $_POST['_wpcf7_unit_tag'] ) || empty( $_POST['_wpcf7_unit_tag'] ) )
        return $output;
    if ( ! preg_match( '/^wpcf7-f(\d+)-p(\d+)-o(\d+)$/', $_POST['_wpcf7_unit_tag'], $matches ) )
        return $output;

}


//イベント予約日付取得
function raiten_date () {
	ob_start();
	$eventid = get_the_ID();
	$meta_values = get_post_meta($eventid, 'event_date', true);
	$date = date_create(''.$meta_values.'');
	$date_format = date_format($date,'Y年m月d日');
	$week = array("日", "月", "火", "水", "木", "金", "土");
	$youbi = $week[(int)date_format($date,'w')];
	echo '<input type="hidden" name="advancedate" value="'.$date_format.'('.$youbi.')">';

	$output = ob_get_clean();
	return $output;

}
wpcf7_add_shortcode('raiten_date', 'raiten_date');


//イベント予約日付チェックボックス
function raiten_date_check1 () {
	ob_start();
	$eventid = get_the_ID();
	$meta_values = get_post_meta($eventid, 'event_date', true);
	$date = date_create(''.$meta_values.'');
	$date_format = date_format($date,'Y年m月d日');
	$week = array("日", "月", "火", "水", "木", "金", "土");
	$youbi = $week[(int)date_format($date,'w')];
	echo '<label><input type="checkbox" name="date_check[]" value="'.$date_format.'('.$youbi.')">'.$date_format.'('.$youbi.')</label>';
	$output = ob_get_clean();
	return $output;

}
wpcf7_add_shortcode('raiten_date_check1', 'raiten_date_check1');


//来店予約
function my_form_tag_filter($tag) {
    if (!is_array($tag))
    return $tag;

    //今日の日付を取得
    $today_y = date('Y');
    $today_m = date('n');
    $today_d = date('j');
     //今年をdefaultの数字に置き換え
     $default = $today_y - 2016;

    //取得した今日の日付をデフォルト値としてセット
    $name = $tag['name'];
    if ($name == 'custom_m1') {
        $tag['options'][0] = 'default:'.$today_m;
    }
    if ($name == 'custom_m2') {
        $tag['options'][0] = 'default:'.$today_m;
    }
    if ($name == 'custom_d1') {
        $tag['options'][0] = 'default:'.$today_d;
    }
    if ($name == 'custom_d2') {
        $tag['options'][0] = 'default:'.$today_d;
    }
     if ($name == 'custom_y1') {
        $tag['options'][0] = 'default:'.$default;
    }
     if ($name == 'custom_y2') {
        $tag['options'][0] = 'default:'.$default;
    }
   return $tag;
}
add_filter('wpcf7_form_tag', 'my_form_tag_filter', 11);


/***************************************************************
 管理画面にACF Proのオプションページを有効化
***************************************************************/
if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
	'page_title' 	=> '共通設定ページ',
	'menu_title'	=> '共通設定',
	'menu_slug' 	=> 'theme-general-settings',
	'capability'	=> 'edit_posts',
	'redirect'		=> false
	));

}
