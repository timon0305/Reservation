<?php
header("Content-Type:text/css");
$color = "#f0f"; // Change your Color Here
$color_2 = "#f0f";// Change your Color 2 Here
function checkhexcolor($color)
{
    return preg_match('/^#[a-f0-9]{6}$/i', $color);
}

if (isset($_GET['color']) AND $_GET['color'] != '') {
    $color = "#" . $_GET['color'];
}

if (!$color OR !checkhexcolor($color)) {
    $color = "#336699";
}
$color_2 = $color;
function hex2rgba($color, $opacity = false) {

    $default = 'rgb(0,0,0)';

    //Return default if no color provided
    if(empty($color))
        return $default;

    //Sanitize $color if "#" is provided
    if ($color[0] == '#' ) {
        $color = substr( $color, 1 );
    }

    //Check if color has 6 or 3 characters and get values
    if (strlen($color) == 6) {
        $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
    } elseif ( strlen( $color ) == 3 ) {
        $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
    } else {
        return $default;
    }

    //Convert hexadec to rgb
    $rgb =  array_map('hexdec', $hex);

    //Check if opacity is set(rgba or rgb)
    if($opacity){
        if(abs($opacity) > 1)
            $opacity = 1.0;
        $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
    } else {
        $output = 'rgb('.implode(",",$rgb).')';
    }

    //Return rgb(a) color string
    return $output;
}

?>


.spinner::before {
    border: 2px solid <?php echo $color;?>;
    border-top-color: #ffffff;
}

.color-base,
.navbar .navbar-nav > .nav-item:hover a, .navbar .navbar-nav > .nav-item.active a,
.single-counter h3,
.portfolio-filter li a:hover,
.portfolio-filter li.active a,
.f-link li a:hover,
.f-link li.active a,
.portfolio-description i,
.single-testimonial h5,
.single-blog a:hover,
.single-blog-content-meta a i,
.read-more,
.footer-menu ul li a:hover,
.copyright-text a:hover,
.custom-hero-breadcrumb ul li:after,
.custom-hero-breadcrumb ul li a:hover,
.location-list ul li a i,
.team-content p,
.room-ratings i,
.account-form a:hover,
.blog-meta a:hover,
.blog-tag a:hover,
.single-most-viewed-post:hover h4,
.room-details-area a.cl-black:hover,
.blog-details-area a.cl-black:hover,
.single-room-block h3 a:hover
{
        color:<?php echo $color?>!important;
}
.navbar .navbar-nav > .nav-item.submenu .dropdown-menu


.portfolio-filter li a:before,
.portfolio-filter li a:hover:before,
.portfolio-filter li.active a:before,
.cat-anchors a:hover,
.popular-tags a:hover,
.blog-share a:hover,
a#scrollUp,
a#scrollUp:hover,
.bg-base
{
        background-color:<?php echo $color?>!important;
}

.border-base{
border:1px solid <?php echo $color?>;
}

.hero-filter-search select:focus, .hero-filter-search input:focus,
.popular-tags a:hover,
.booking-form input:focus, .booking-form select:focus,
.contact-form input:focus, .contact-form textarea:focus,
.account-form input:focus, .account-form select:focus,
.blog-share a:hover,
.comment-form input:focus, .comment-form textarea:focus,
.accordion a:after,
.spinner:before,

{
        border-color:<?php echo $color?>;
}
.small-btn,
.hero-filter-search button,
.btn-fill{
    background-image: -moz-linear-gradient( 0deg, <?php echo $color?> 0%, <?php echo $color_2?> 100%);
    background-image: -webkit-linear-gradient( 0deg, <?php echo $color?> 0%, <?php echo $color_2?> 100%);
    background-image: -ms-linear-gradient( 0deg, <?php echo $color?> 0%, <?php echo $color_2?> 100%);
    color: #fff !important;
    transition: 0.4s;
}
.small-btn:hover,
.hero-filter-search button:hover,
.btn-fill:hover{
    background-image: -moz-linear-gradient( 0deg, <?php echo $color_2?> 0%, <?php echo $color?> 100%);
    background-image: -webkit-linear-gradient( 0deg,<?php echo $color_2?> 0%, <?php echo $color?> 100%);
    background-image: -ms-linear-gradient( 0deg, <?php echo $color_2?> 0%, <?php echo $color?> 100%);
}
@media (min-width: 992px) {
    .navbar .navbar-nav > .nav-item.submenu .dropdown-menu {

    border-top: 2px solid <?php echo $color?>;
    }
}
