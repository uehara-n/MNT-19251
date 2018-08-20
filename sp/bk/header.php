<!doctype html>
<html lang="ja">
<head>
	<!--アナリティクスタグ-->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-113127042-1"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());

gtag('config', 'UA-113127042-1');
</script>
<!--アナリティクスタグ-->

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width" />
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/common/icon.ico">
<link href="<?php echo get_template_directory_uri(); ?>/css/common/allpage.css" rel="stylesheet">
<link href="<?php echo get_template_directory_uri(); ?>/css/common/lightbox.css" rel="stylesheet">
<?php if ( is_home() || is_front_page() ) : ?>
<!-- slickスライダー -->
<link href="<?php echo home_url(); ?>/wp-content/themes/reform/js/slick/slick-theme.css" rel="stylesheet" type="text/css">
<link href="<?php echo home_url(); ?>/wp-content/themes/reform/js/slick/slick.css" rel="stylesheet" type="text/css">
<script src="https://cdn.jsdelivr.net/npm/jquery@3/dist/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo home_url(); ?>/wp-content/themes/reform/js/slick/slick.min.js"></script>
<script type="text/javascript">
jQuery(function ($) {
    $('.slider').each(function () {
      $(this).slick({
          infinite: true,
          slidesToShow: 1,
          autoplay: true,
          autoplaySpeed: 2600,
          dots: true,
          arrows:true
        });
      });
    });
  </script>
<!-- /slickスライダー -->
<link href="<?php echo get_template_directory_uri(); ?>/css/top.css" rel="stylesheet">
<?php else:?>
<link href="<?php echo get_template_directory_uri(); ?>/css/common/page.css" rel="stylesheet">
<?php if(is_page()&&!is_404()): ?>
<?php
$root_slug = ps_get_root_page( $post );
$root_slug = $root_slug->post_name;
?>
<link href="<?php echo get_template_directory_uri(); ?>/css/<?php echo $root_slug; ?>.css" rel="stylesheet" type="text/css"/>
<!-- /固定ページcss -->
<?php else: ?>
<link href="<?php echo get_template_directory_uri(); ?>/css/<?php echo esc_html(get_post_type_object(get_post_type())->name); ?>.css" rel="stylesheet" type="text/css"/>
<!-- 各ページcss -->
<?php endif; ?>
<?php endif; ?>
<?php if( is_404( )):?><!-- 404の時-->
<link href="<?php echo get_template_directory_uri(); ?>/css/common/notfound.css" rel="stylesheet">
<?php endif; ?>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<script
			  src="https://code.jquery.com/jquery-2.2.4.min.js"
			  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
			  crossorigin="anonymous"></script>
<?php if(is_page(array('82') )||is_singular( 'event' ) ): ?>
<!-- 郵便番号 -->
<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
    <script type="text/javascript">
$(function(){
  $('#zip').keyup(function(event){
    AjaxZip3.zip2addr(this,'','ken','add');
  })
})
</script><!-- /郵便番号 -->

<?php endif; ?>

<title><?php the_field('comname_kabu',  'Options'); ?></title>


<?php wp_head(); ?>
</head>

<body>
<div class="ddmenu horizontal close">
  <ul class="container clearfix">
    <li><a href="<?php bloginfo('url'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/head/common_home_new.png" alt="トップページへ戻る"></a></li>
    <li><a href=""><img src="<?php echo get_template_directory_uri(); ?>/images/head/common_menu_new.png" alt="メニュー" width="88" height="75"></a>
      <ul>
        <li><a href="<?php bloginfo('url'); ?>/company">会社案内</a></li>
        <li><a href="<?php bloginfo('url'); ?>/staff">スタッフ紹介</a></li>
        <li><a href="<?php bloginfo('url'); ?>/event">イベント情報</a></li>
        <li><a href="<?php bloginfo('url'); ?>/news-letter">プロタイムズ通信</a></li>
        <li><a href="#">施工事例</a>
          <ul>
            <li><a href="<?php bloginfo('url'); ?>/seko">施工事例一覧</a></li>
            <li><a href="<?php bloginfo('url'); ?>/seko_cat/gaiheki">外壁塗装</a></li>
            <li><a href="<?php bloginfo('url'); ?>/seko_cat/yane">屋根塗装</a></li>
            <li><a href="<?php bloginfo('url'); ?>/seko_cat/veranda">ベランダ・防水工事</a></li>
            <li><a href="<?php bloginfo('url'); ?>/seko_cat/apmn">アパート・マンション</a></li>
            <li><a href="<?php bloginfo('url'); ?>/seko_cat/reform">リフォーム工事</a></li>
          </ul>
        </li>
        <li><a href="<?php bloginfo('url'); ?>/voice">お客様の声</a></li>
<!--
        <li><a href="<?php bloginfo('url'); ?>/#">サービス</a></li>-->
        <li><a href="<?php bloginfo('url'); ?>/blog">スタッフブログ</a></li>
				<li><a href="<?php home_url(); ?>/contact_flow">お問合せの流れ</a></li>
      </ul>
    </li>
    <li><a href="tel:<?php the_field('comtel',  'Options'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/head/common_tel_new.png" alt="お電話"></a></li>
    <li><a href="<?php bloginfo('url'); ?>/contact"><img src="<?php echo get_template_directory_uri(); ?>/images/head/common_toi_new.png" alt="お問い合わせ"></a></li>
<li><a href="<?php bloginfo('url'); ?>/raiten"><img src="<?php echo get_template_directory_uri(); ?>/images/head/common_raiten_new.png" alt="来店予約"></a></li>
  </ul>
</div>
<header id="head">
  <h1 class="logo base_inner"><img src="<?php echo get_template_directory_uri(); ?>/images/head/logo.png" width="340" height="100" alt="<?php the_field('comname_kabu',  'Options'); ?>"></h1>
</header>
