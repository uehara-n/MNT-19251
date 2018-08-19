　<!doctype html>
<html>
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

<!-- Global site tag (gtag.js) - Google Ads: 799032579 -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-799032579"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-799032579');
</script>

<?php if(is_page('comp')): ?>
<!-- Event snippet for お問い合わせ conversion page -->
<script>
  gtag('event', 'conversion', {'send_to': 'AW-799032579/zp7GCLGaoYcBEIOKgf0C'});
</script>
<?php endif; ?>


<meta charset="UTF-8">
<meta name="viewport" content="width=device-width" />
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/common/icon.ico">
<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/images/common/icon.ico">
<link href="<?php echo get_template_directory_uri(); ?>/css/common/allpage.css" rel="stylesheet">
<link href="<?php echo get_template_directory_uri(); ?>/css/common/lightbox.css" rel="stylesheet">
<link href="<?php echo get_template_directory_uri(); ?>/css/common/microtip.css" rel="stylesheet">
<script>
    $(window).on('load scroll',function(){
        var value = $(this).scrollTop();

        if(value > 100){
            $('div.bottom_contact').addClass("is-fixed");
        }
    });

</script>
<?php if ( is_home() || is_front_page() ) : ?>
<!-- slickスライダー -->
<link href="<?php echo get_template_directory_uri(); ?>/js/slick/slick-theme.css" rel="stylesheet" type="text/css">
<link href="<?php echo get_template_directory_uri(); ?>/js/slick/slick.css" rel="stylesheet" type="text/css">
<script src="https://cdn.jsdelivr.net/npm/jquery@3/dist/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/slick/slick.min.js"></script>
<script type="text/javascript">
jQuery(function ($) {
    $('.slider').each(function () {
      $(this).slick({
          infinite: true,
          slidesToShow: 1,
          centerMode: true,
          variableWidth: true,
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
<script
			  src="https://code.jquery.com/jquery-2.2.4.min.js"
			  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
			  crossorigin="anonymous"></script>
<?php if(is_page(array('82','697') )||is_singular( 'event' ) ): ?>
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

<title>無題ドキュメント</title>


<?php wp_head(); ?>
</head>

<body>
<header id="head">
  <div class="inner">
    <h1 class="logo"><img src="<?php echo get_template_directory_uri(); ?>/images/head/logo.png" alt="<?php the_field('comname_kabu',  'Options'); ?>" width="319" height="100"></h1>
    <ul class="head_contact">
      <li><img src="<?php echo get_template_directory_uri(); ?>/images/head/tel.png" alt="<?php the_field('comtel',  'Options'); ?>" width="319" height="51"></li>
      <li><a href="<?php bloginfo('url'); ?>/contact"><img src="<?php echo get_template_directory_uri(); ?>/images/head/contact_off.png" alt="お問い合わせ" width="190" height="80"></a></li>
    </ul>
  </div>
</header>
<nav class="head_nav">
  <ul class="global_navi">
    <li><a href="<?php bloginfo('url'); ?>/"><img src="<?php echo get_template_directory_uri(); ?>/images/head/nav/home.png" alt="HOME" width="137" height="94"></a></li>
    <li><a href="<?php bloginfo('url'); ?>/company"><img src="<?php echo get_template_directory_uri(); ?>/images/head/nav/company.png" alt="会社案内" width="137" height="94"></a>
<!--
	  <ul>
	  	<li><a href="<?php bloginfo('url'); ?>/#">テキストテキスト</a></li>
	  	<li><a href="<?php bloginfo('url'); ?>/#">テキストテキスト</a></li>
	  	<li><a href="<?php bloginfo('url'); ?>/#">テキストテキスト</a></li>
	  </ul>
--></li>
    <li><a href="<?php bloginfo('url'); ?>/staff"><img src="<?php echo get_template_directory_uri(); ?>/images/head/nav/staff.png" alt="スタッフ紹介" width="137" height="94"></a></li>

    <li><a href="<?php bloginfo('url'); ?>/seko"><img src="<?php echo get_template_directory_uri(); ?>/images/head/nav/seko.png" alt="施工事例" width="137" height="94"></a>
	  <ul>
            <li><a href="<?php bloginfo('url'); ?>/seko_cat/gaiheki">外壁塗装</a></li>
            <li><a href="<?php bloginfo('url'); ?>/seko_cat/yane">屋根塗装</a></li>
            <li><a href="<?php bloginfo('url'); ?>/seko_cat/veranda">ベランダ・防水工事</a></li>
            <li><a href="<?php bloginfo('url'); ?>/seko_cat/apmn">アパート・マンション</a></li>
            <li><a href="<?php bloginfo('url'); ?>/seko_cat/reform">リフォーム工事</a></li>
	  </ul></li>
    <li><a href="<?php bloginfo('url'); ?>/voice"><img src="<?php echo get_template_directory_uri(); ?>/images/head/nav/voice.png" alt="お客様の声" width="137" height="94"></a></li>
    <li><a href="<?php bloginfo('url'); ?>/#" aria-label="準備中" data-microtip-position="top" role="tooltip"><img src="<?php echo get_template_directory_uri(); ?>/images/head/nav/service.png" alt="サービス" width="137" height="94"></a></li>
    <li><a href="<?php bloginfo('url'); ?>/blog"><img src="<?php echo get_template_directory_uri(); ?>/images/head/nav/blog.png" alt="ブログ" width="138" height="94"></a></li>
  </ul>
</nav>
