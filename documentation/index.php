<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("UI kit");
?>   
<style>
/* ----------------------------------
 * index
 * ---------------------------------- */
.index {
    text-align: center;
    background-color: rgba(255, 255, 255, .9);
    min-height: 746px;
}
.index h2 {
    margin-top: 10px;
    color: rgba(0, 0, 0, .8);
    font-size: 16px;
    line-height: 26px;
    font-weight: normal;
}
.index h3 {
    margin-top: 20px;
    font-size: 14px;
    font-style: italic;
}
.index .download-link {
    margin: 20px 0;
}
.index .download-link .btn {
    padding: 15px 35px;
    border: 0;
    font-size: 22px;
    opacity: 1;
}
.index .version-text {
    color: rgba(0, 0, 0, .6);
    font-size: 12px;
}
.index .learn-more {
    margin-top: 20px;
    font-weight: bold;
    color: rgba(79, 190, 186, 1);
}
.index .learn-more a,
.index .learn-more a:hover,
.index .learn-more a:active {
    color: #50c1e9 !important;
    text-decoration: none;
}
.index .learn-more .icon {
    font-weight: bold;
    font-size: 16px;
}
.index .adpacks {
	margin: 0 auto 100px;
	padding: 9px 9px 18px;
	border-radius: 3px;
	border: 1px solid #3bafda;
	width: 380px;
	min-height: 132px;
	text-align: left !important;
}
.index .adpacks .adpacks-img {
	float: left;
	width: 140px;
}

.index .adpacks .adpacks-text,
.index .adpacks .adpacks-poweredby {
	font-size: 13px;
	line-height: 16px;
}
.index .adpacks .adpacks-poweredby {
	display: block;
	margin-bottom:9px;
}
@media (max-width: 767px) {
    .index {
        min-height: 600px;
    }
    .index .download-link .btn {
        padding: 15px;
    }

	.index .adpacks {
		width: 100%;
		min-height: 132px;
	}
}
/* ----------------------------------
 * social
 * ---------------------------------- */
.social {
    position: relative;
    margin-top: -100px;
    margin-bottom: 0;
    padding: 40px 5px;
    height: 99px;
    text-align: center;
    background: rgba(255, 255, 255, .7) url(../img/divider.png) no-repeat 50% 100%;
}
.social li {
    height: 30px;
    display: inline-block;
    vertical-align: top;
}
.social a {
    color: #50c1e9 !important;
}
.social .github-watch {
    width: 105px;
}
.social .github-fork {
    width: 105px;
}
.social .twitter-share {
    width: 80px;
    margin-right: 10px;
}
.social .twitter-follow {
    width: 200px;
}
/* ----------------------------------
 * desc
 * ---------------------------------- */
.desc {
    text-align: center;
    background-color: rgba(255, 255, 255, 1);
}
.desc a {
    color: rgba(79, 190, 186, 1);
}
.desc a:hover,
.desc a:active {
    color: #50c1e9;
    text-decoration: none;
}
.desc .desc__introduces {
    border-top: 1px dashed #AAB2BD ;
}
.desc .desc__introduces:first-child {
    border-top: none;
}
.desc .desc__introduces h3,
.desc .desc__introduces p {
    margin: 0 auto;
}
.desc .desc__introduces h3 {
    padding: 70px 0 14px;
    max-width: 900px;
    font-size: 28px;
}
.desc .desc__introduces p {
    padding-bottom: 40px;
    max-width: 900px;
    font-size: 18px;
    color: #888;
}
.desc .desc__introduces .photo--responsive img {
    width: 100%;
}
.desc .desc__features {
    margin: 70px auto;
    text-align: left;
}
.desc .desc__features .row {
    margin-bottom: 70px;
}
.desc .desc__features .col-md-6 {
    padding-left: 247px;
    min-height: 200px;
    text-align: left;
}
.desc .desc__features .features__photo {
    position: absolute;
    top: -18px;
    left: 0;
}
.desc .desc__features h4 {
    font-size: 20px;
    margin-bottom: 10px;
}
.desc .desc__features p {
    font-size: 16px;
    color: #888;
    line-height: 26px;
}
@media (max-width: 767px) {
    .desc .desc__introduces h3 {
        padding-top: 20px;
        text-align: left;
    }
    .desc .desc__introduces p {
        text-align: left;
    }
    .desc .desc__features {
        margin-top: 20px;
    }
    .desc .desc__features .row {
        margin-bottom: 20px;
    }
    .desc .desc__features .row p {
        padding-bottom: 20px;
        text-align: left;
    }
    .desc .desc__features .features__photo {
        position: static;
    }
    .desc .desc__features .col-md-6 {
        padding: 0 15px;
        text-align: center;
    }
}
/* ----------------------------------
 * docs
 * ---------------------------------- */
.docs-header {
    padding-top: 50px;
    border-top: 1px solid #50c1e9;
    background: url(../img/wild_flowers.png) repeat 0 0;
}
.docs-header.header--noBackground {
    background: none;
}
@media (max-width: 768px) {
    .docs-header {
        padding-top: 0;
    }
}
/* ----------------------------------
 * navbar
 * ---------------------------------- */
.navbar-custom {
    position: fixed;
    top: 0;
    left: 0;
    border: none;
    border-radius: 0;
    background-color: rgba(255, 255, 255, .9);
    width: 100%;
    z-index: 2000;
}
.navbar-custom .nav li a {
    display: block;
    color: #50c1e9;
}
.navbar-custom .nav li a:focus,
.navbar-custom .nav li a:hover {
    color: #50c1e9;
}
.navbar-custom .nav li a:active,
.navbar-custom .nav li a.current {
    border-bottom: 3px solid #50c1e9;
}
.navbar-custom .navbar-toggle {
    position: relative;
    background-color: #50c1e9;
    border-color: #50c1e9;
}
.navbar-custom .navbar-toggle:hover,
.navbar-custom .navbar-toggle:focus {
    background-color: #50c1e9;
}
.navbar-custom .navbar-toggle .icon-bar {
    background-color: rgba(255, 255, 255, .9);
}
.navbar-custom .navbar-brand {
    padding: 5px 15px;
    opacity: .7;
    filter:alpha(opacity=70);
    transition: opacity .4s ease-in-out;
}
.navbar-custom .navbar-brand:hover,
.navbar-custom .navbar-brand:active {
    opacity: 1;
    filter:alpha(opacity=100);
}
.navbar-default .navbar-collapse {
    border-color: #e7e7e7;
}
@media (max-width: 992px) {
  .navbar-custom .navbar-brand {
    width: 63px;
    overflow: hidden;
  }
}
@media (max-width: 767px) {
  .navbar-custom {
    position: relative;
    top: 0;
  }
  .navbar-custom .navbar-nav > li > a:hover,
  .navbar-custom .navbar-nav > li > a:focus {
    color: #fff;
    background-color: #50c1e9;
  }
}
/* ----------------------------------
 * topic
 * ---------------------------------- */
.topic {
    position: relative;
    padding: 50px 0 110px;
}
.topic h3 {
    margin-top: 20px;
    color: #fff;
    font-size: 28px;
    font-weight: normal;
}
.topic h4 {
    margin-top: 15px;
    color: rgba(255, 255, 255, .8);
    font-weight: normal;
}
.topic .topic__infos {
    position: absolute;
    bottom: 0;
    padding-bottom: 15px;
    padding-top: 14px;
    background: rgba(255, 255, 255, 0.25);
    width: 100%;
}
.topic .container {
    position: relative;
    color: rgba(255, 255, 255, .8);
}
.topic .container a {
    color: #fff;
    filter:alpha(opacity=100);
    opacity: 1;
    text-decoration: underline;
    padding: 0;
    font-weight: normal;
}
.topic .container a.btn {
    padding: 10px 16px;
    text-decoration: none;
}
.topic .github {
    position: relative;
    top: 10px;
}
/* ----------------------------------
 * advertisement
 * ---------------------------------- */
.advertisement {
  padding: 5px;
  width: auto !important;
  overflow: hidden; /* clearfix */
  text-align: left;
  border: 1px solid #a4e4ef !important;
  border-radius: 4px;
}
@media (max-width: 767px) {
  .advertisement {
    position: static;
    margin: 30px 0;
  }
}
@media (min-width: 768px) {
  .advertisement {
    position: absolute;
    top: 15px;
    right: 15px; /* 15px instead of 0 since box-sizing */
    width: 380px !important;
  }
}
.carbon-wrap {
	display:block;
	height:100px;
	line-height:15px;
	overflow:hidden;
}
.carbon-img{
	border:none;
	display:inline;
	float:left;
	height:100px;
	margin:4px 9px 9px 0;
	width:130px
}
.carbon-text{
	display:inline;
	float:left;
	width:162px;
	color:#000;
	text-decoration:none !important;
	text-transform:none;
	font-size:11px !important
}
.carbon-poweredby {
	float: right;
	text-align:center;
	color:#999
	text-decoration:none !important;
	font-size:11px !important
}
/* ----------------------------------
 * documents
 * ---------------------------------- */
.documents {
    margin-top: 40px;
}
/* ----------------------------------
 * details
 * ---------------------------------- */
.details {
    position: relative;
    padding-right: 400px;
}
@media (max-width: 991px) {
    .details { width: 100%; }
}
@media (max-width: 767px) {
    .details { padding: 0 15px; }
}
/* ----------------------------------
 * docs-article
 * ---------------------------------- */
.docs-article {
    margin-bottom: 40px;
    padding-bottom: 40px;
    border-bottom: 1px solid #ddd;
}
.docs-article:last-child {
    border-bottom: none;
}
.docs-article h3 {
    margin: 0 0 10px;
    padding-bottom: 10px;
    font-family: "Georgia", "Palatino", "Times New Roman", "Times" !important;
    font-weight: normal;
    font-size: 25px;
    color: #50c1e9;
}
.docs-article p {
    margin-bottom: 10px;
    font-size: 14px;
    line-height: 22px;
}
.docs-article dd {
    margin-bottom: 10px;
}
.docs-article a {
    color: #50c1e9;
    text-decoration: underline;
}
.docs-article a:hover {
    color: #50c1e9;
}
.docs-article .item__infos {
    margin: 0 0 10px 0;
    font-size: 14px;
    list-style: disc;
}
.docs-article .item__infos li {
    margin-bottom: 10px;
}
.docs-article .btn-primary,
.docs-article .btn-primary:hover {
    color: #fff;
    text-decoration: none;
}
.docs-article pre {
    border: none;
    background-color: #f7f7f7;
}
/* ----------------------------------
 * example
 * ---------------------------------- */
.example {
    margin-bottom: 20px;
}
.example .example-title {
    margin-bottom: 20px;
    font-weight: 700;
    font-size: 18px;
    text-shadow: 2px 2px 2px rgba(255, 255, 255, 1);
}
.example .example-title span {
    font-weight: normal;
    font-size: 14px;
    color: #ED5565;
}
.example [class*="col-"] {
    margin-bottom: 10px;
}
.example-dropdown h2 + .dropdown-menu,
.example-popover .popover,
.example-modal .modal {
    position: static;
    display: block;
}
.example-dropdown h2 + .dropdown-menu {
    float: none;
    width: 200px;
}
.example-popover .popover {
    position: relative;
}
@media (max-width: 960px) {
    .tooltip-demo [class*="col-"] {
        text-align: center;
    }
    .tooltip-demo [class*="col-"] .btn-block {
        display: inline-block;
        margin: 0 auto;
        width: 160px;
    }
}
.example-popover [class*="col-"]:nth-of-type(1) .popover {
    margin-top: 0;
}
.example-popover [class*="col-"]:nth-of-type(3) .popover,
.example-popover [class*="col-"]:nth-of-type(4) .popover {
    margin-top: 40px;
}
.example-progress [class*="col-"]:last-child .progress {
    margin-bottom: 10px;
}
.example-pagination .pagination,
.example-pagination .pager {
    margin: 0 !important;
}

.example-modal .modal {
    overflow: hidden;
}
@media (min-width: 768px) {
    .example-modal .modal-dialog {
        width: 545px;
        margin: 5px;
    }
}
.example-typography {
    position: relative;
    padding-left: 25%;
    margin-bottom: 40px;
}
.example-typography .heading-note,
.example-typography .text-note {
    display: block;
    width: 260px;
    position: absolute;
    bottom: 2px;
    left: 0;
    font-size: 13px;
    line-height: 13px;
    color: #AAB2BD;
    font-weight: 400;
}
.example-typography .text-note {
    bottom: auto;
    top: 10px;
}
/* ----------------------------------
 * color-swatches
 * ---------------------------------- */
.color-swatches .swatches {
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    background-color: #FFF;
    width: 100%;
    box-shadow: 0 1px 2px rgba(0, 0, 0, .2);
}
.color-swatches .light,
.color-swatches .dark {
    width: 50%;
    height: 50px;
}
.color-swatches .light {
    -webkit-border-radius: 4px 0 0 0;
    -moz-border-radius: 4px 0 0 0;
    border-radius: 4px 0 0 0;
}
.color-swatches .dark {
    -webkit-border-radius: 0 4px 0 0;
    -moz-border-radius: 0 4px 0 0;
    border-radius: 0 4px 0 0;
}
.color-swatches .infos {
    padding: 5px 10px;
}
.color-swatches .infos h4,
.color-swatches .infos p {
    margin: 0;
}
.color-swatches .infos h4 {
    margin-bottom: 3px;
    font-weight: bold;
    font-size: 14px;
}
.color-swatches .infos p {
    font-size: 12px;
}
/* ----------------------------------
 * psd-download
 * ---------------------------------- */
.psd-download {
    padding: 40px 0;
    background: #e6e9ed url(../img/github.png) no-repeat 100% 0;
    min-height: 680px;
}
.psd-download h2 {
    text-align: center;
}
.psd-download .infos {
    font-size: 20px;
    line-height: 40px;
}
.psd-download .row {
    margin-top: 20px;
}
@media (max-width: 768px) {
    .psd-download [class*="col-md-"] {
        text-align: center;
    }
}
.psd-download h4 {
    margin: 0 0 15px 0;
}
.psd-download img {
    margin-bottom: 15px;
}
/* ----------------------------------
 * previews
 * ---------------------------------- */
.previews {
    text-align: center;
}
.previews p {
    margin-bottom: 20px;
    font-size: 20px;
    line-height: 40px;
}
.previews img {
    max-width: 100%;
}
/* ----------------------------------
 * color picker
 * ---------------------------------- */
.color-picker-nav a {
	text-decoration: none !important;
	color: #0b859c !important;
	margin: 0 10px;
}
.color-picker-nav a:hover {
	text-decoration: underline !important;
}
.color-picker-nav a.current {
	font-weight: bold;
}
.color-wrap {
	position: relative;
	clear: both;
	left: 0;
	width: 100%;
	z-index: 500;
}
.color-picker {
	width: 20%;
	padding-bottom: 18%;
	color: #FFF;
	position: relative;
	float: left;
	top: 0;
	bottom: 0;
}
.color-item {
	position: absolute;
	margin: 0;
	left: 0;
	right: 0;
	top: 0;
	bottom: 0;
	text-align: center;
	text-transform: uppercase;
	padding: 35%;
}
.color-item:hover {
	display: inline;
    z-index: 999;
    overflow: hidden;
	cursor: pointer;
	-webkit-transform: scale(1);
	-moz-transform: scale(1);
	-o-transform: scale(1);
	transform: scale(1);
	-webkit-box-shadow: 5px 5px 5px 5px rgba(0, 0, 0, 0.2);
	-moz-box-shadow: 5px 5px 5px 5px rgba(0, 0, 0, 0.2);
	box-shadow: 5px 5px 5px 5px rgba(0, 0, 0, 0.2);
}
/* Tablet Portrait size to standard 960 (devices and browsers) */
@media only screen and (min-width: 768px) and (max-width: 959px)
{
	.color-picker{
		width: 50%;
		color: #FFF;
	}
	.color-item{
		padding: 8%;
		font-size: 0.875em;
	}
	.color-name,.hex-number {
		position: relative;
		line-height: 22px;
		text-align: center;
	}
}

/* All Mobile Sizes (devices and browser) */
@media only screen and (max-width: 767px)
{
	.color-picker {
		width: 50%;
		color: #FFF;
	}
	.color-item{
		padding: 8%;
		font-size: 0.750em;
	}
	.color-name,.hex-number {
		position: relative;
		line-height: 22px;
		text-align: center;
	}
}

/* Mobile Landscape Size to Tablet Portrait (devices and browsers) */
@media only screen and (min-width: 480px) and (max-width: 767px)
{
	.color-item{
		padding: 5%;
		font-size: 0.750em;
	}
	.color-picker{
		width: 100%;
		color: #FFF;
	}
	.color-name,.hex-number {
		position: relative;
		line-height: 12px;
		text-align: center;
	}
}

/* ----------------------------------
 * btn-group & labels
 * ---------------------------------- */
.blank {
    display: none;
}
@media (max-width: 768px) {
    .blank {
        display: block;
        height: 15px;
    }
}
.site-footer {
    position: relative;
    z-index: 400;
    border-top: 1px dashed #AAB2BD;
    padding: 40px 0 20px;
    background-color: #f5f5f5;
}
.site-footer a,
.site-footer .connect {
    color: #50c1e9;
}
.site-footer a:hover,
.site-footer a:active {
    color: #50c1e9;
    text-decoration: none;
}
.site-footer .row .col-md-4 {
    margin-bottom: 20px;
}
.site-footer h3 {
    margin-bottom: 20px;
    font-weight: 600;
    font-size: 18px;
}
.site-footer ul {
    padding-left: 0;
}
.site-footer li {
    list-style: none;
    font-size: 14px;
}
.site-footer hr {
    margin: 20px 0;
    border: none;
    height: 1px;
    width: 100%;
}
.site-footer hr.dashed {
    border-top: 1px dashed #ccc;
}
.site-footer .icon {
    margin-right: 10px;
    font-size: 28px;
}
.site-footer form {
    padding: 0 !important;
}
.site-footer form label {
    font-size: 14px !important;
    font-weight: normal !important;
}
.site-footer input[type="email"] {
    margin-right: 10px;
    width: 75%;
}
.site-footer input[type="email"],
.site-footer input[type="email"]:focus,
.site-footer input[type="submit"],
.site-footer input[type="submit"]:active,
.site-footer input[type="submit"]:focus {
    border: none !important;
}
.site-footer .email,
.site-footer .clear {
    float: left;
}
.site-footer .copyright p:last-child {
    margin-top: 10px;
}
.site-footer .copyright b {
    font-size: 16px;
}
.site-footer .download .download__infos {
    font-size: 18px;
}
.site-footer .download .btn {
    color: #000;
}
.site-footer .download .btn-primary {
    color: #fff;
}



</style>



<!-- Color Swatches
      ================================================== -->
      <div class="example">
        <h2 class="example-title">Color Swatches <span>(<b>More Colors See</b>: <a href="color-picker.html">Flat UI Color Picker</a>)</span></h2>
        <div class="row">
          <div class="col-md-2">
            <div class="color-swatches">
              <div class="swatches">
                <div class="clearfix">
                  <div class="pull-left light" style="background-color:#5D9CEC"></div>
                  <div class="pull-right dark" style="background-color:#4A89DC"></div>
                </div>
                <div class="infos">
                  <h4>BLUE JEANS</h4>
                  <p>#5D9CEC, #4A89DC</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="color-swatches">
              <div class="swatches">
                <div class="clearfix">
                  <div class="pull-left light" style="background-color:#4FC1E9"></div>
                  <div class="pull-right dark" style="background-color:#3BAFDA"></div>
                </div>
                <div class="infos">
                  <h4>AQUA</h4>
                  <p>#4FC1E9, #3BAFDA</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="color-swatches">
              <div class="swatches">
                <div class="clearfix">
                  <div class="pull-left light" style="background-color:#48CFAD"></div>
                  <div class="pull-right dark" style="background-color:#37BC9B"></div>
                </div>
                <div class="infos">
                  <h4>MINT</h4>
                  <p>#48CFAD, #37BC9B</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="color-swatches">
              <div class="swatches">
                <div class="clearfix">
                  <div class="pull-left light" style="background-color:#A0D468"></div>
                  <div class="pull-right dark" style="background-color:#8CC152"></div>
                </div>
                <div class="infos">
                  <h4>GRASS</h4>
                  <p>#A0D468, #8CC152</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="color-swatches">
              <div class="swatches">
                <div class="clearfix">
                  <div class="pull-left light" style="background-color:#FFCE54"></div>
                  <div class="pull-right dark" style="background-color:#F6BB42"></div>
                </div>
                <div class="infos">
                  <h4>SUNFLOWER</h4>
                  <p>#FFCE54, #F6BB42</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="color-swatches">
              <div class="swatches">
                <div class="clearfix">
                  <div class="pull-left light" style="background-color:#FC6E51"></div>
                  <div class="pull-right dark" style="background-color:#E9573F"></div>
                </div>
                <div class="infos">
                  <h4>BITTERSWEET</h4>
                  <p>#FC6E51, #E9573F</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-2">
            <div class="color-swatches">
              <div class="swatches">
                <div class="clearfix">
                  <div class="pull-left light" style="background-color:#ED5565"></div>
                  <div class="pull-right dark" style="background-color:#DA4453"></div>
                </div>
                <div class="infos">
                  <h4>GRAPEFRUIT</h4>
                  <p>#ED5565, #DA4453</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="color-swatches">
              <div class="swatches">
                <div class="clearfix">
                  <div class="pull-left light" style="background-color:#AC92EC"></div>
                  <div class="pull-right dark" style="background-color:#967ADC"></div>
                </div>
                <div class="infos">
                  <h4>LAVENDER</h4>
                  <p>#AC92EC, #967ADC</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="color-swatches">
              <div class="swatches">
                <div class="clearfix">
                  <div class="pull-left light" style="background-color:#EC87C0"></div>
                  <div class="pull-right dark" style="background-color:#D770AD"></div>
                </div>
                <div class="infos">
                  <h4>PINK ROSE</h4>
                  <p>#EC87C0, #D770AD</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="color-swatches">
              <div class="swatches">
                <div class="clearfix">
                  <div class="pull-left light" style="background-color:#F5F7FA"></div>
                  <div class="pull-right dark" style="background-color:#E6E9ED"></div>
                </div>
                <div class="infos">
                  <h4>LIGHT GRAY</h4>
                  <p>#F5F7FA, #E6E9ED</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="color-swatches">
              <div class="swatches">
                <div class="clearfix">
                  <div class="pull-left light" style="background-color:#CCD1D9"></div>
                  <div class="pull-right dark" style="background-color:#AAB2BD"></div>
                </div>
                <div class="infos">
                  <h4>MEDIUM GRAY</h4>
                  <p>#CCD1D9, #AAB2BD</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="color-swatches">
              <div class="swatches">
                <div class="clearfix">
                  <div class="pull-left light" style="background-color:#656D78"></div>
                  <div class="pull-right dark" style="background-color:#434A54"></div>
                </div>
                <div class="infos">
                  <h4>DARK GRAY</h4>
                  <p>#656D78, #434A54</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Buttons
      ================================================== -->
      <div class="example">
        <h2 class="example-title">Buttons</h2>
        <div class="row">
          <div class="col-md-3">
            <button type="button" class="btn btn-block">Normal</button>
          </div>
          <div class="col-md-3">
            <button type="button" class="btn btn-default btn-block">Default</button>
          </div>
          <div class="col-md-3">
            <button type="button" class="btn btn-primary btn-block">Primary</button>
          </div>
          <div class="col-md-3">
            <button type="button" class="btn btn-success btn-block">Success</button>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <button type="button" class="btn btn-info btn-block">Info</button>
          </div>
          <div class="col-md-3">
            <button type="button" class="btn btn-warning btn-block">Warning</button>
          </div>
          <div class="col-md-3">
            <button type="button" class="btn btn-danger btn-block">Danger</button>
          </div>
          <div class="col-md-3">
            <button type="button" class="btn btn-link btn-block">Link</button>
          </div>
        </div>
      </div>
      <!-- Button Groups
      ================================================== -->
      <div class="example">
        <h2 class="example-title">Button Groups</h2>
        <div class="row">
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-4">
                <div class="btn-group">
                  <button type="button" class="btn"><i class="glyphicon glyphicon-align-left"></i></button>
                  <button type="button" class="btn"><i class="glyphicon glyphicon-align-center"></i></button>
                  <button type="button" class="btn"><i class="glyphicon glyphicon-align-right"></i></button>
                </div>
              </div>
              <div class="col-md-4">
                <div class="btn-group">
                  <button type="button" class="btn btn-default"><i class="glyphicon glyphicon-align-left"></i></button>
                  <button type="button" class="btn btn-default"><i class="glyphicon glyphicon-align-center"></i></button>
                  <button type="button" class="btn btn-default"><i class="glyphicon glyphicon-align-right"></i></button>
                </div>
              </div>
              <div class="col-md-4">
                <div class="btn-group">
                  <button type="button" class="btn btn-primary"><i class="glyphicon glyphicon-align-left"></i></button>
                  <button type="button" class="btn btn-primary"><i class="glyphicon glyphicon-align-center"></i></button>
                  <button type="button" class="btn btn-primary"><i class="glyphicon glyphicon-align-right"></i></button>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="btn-group">
                  <button type="button" class="btn btn-success"><i class="glyphicon glyphicon-align-left"></i></button>
                  <button type="button" class="btn btn-success"><i class="glyphicon glyphicon-align-center"></i></button>
                  <button type="button" class="btn btn-success"><i class="glyphicon glyphicon-align-right"></i></button>
                </div>
              </div>
              <div class="col-md-4">
                <div class="btn-group">
                  <button type="button" class="btn btn-info"><i class="glyphicon glyphicon-align-left"></i></button>
                  <button type="button" class="btn btn-info"><i class="glyphicon glyphicon-align-center"></i></button>
                  <button type="button" class="btn btn-info"><i class="glyphicon glyphicon-align-right"></i></button>
                </div>
              </div>
              <div class="col-md-4">
                <div class="btn-group">
                  <button type="button" class="btn btn-warning"><i class="glyphicon glyphicon-align-left"></i></button>
                  <button type="button" class="btn btn-warning"><i class="glyphicon glyphicon-align-center"></i></button>
                  <button type="button" class="btn btn-warning"><i class="glyphicon glyphicon-align-right"></i></button>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="btn-group">
                  <button type="button" class="btn btn-danger"><i class="glyphicon glyphicon-align-left"></i></button>
                  <button type="button" class="btn btn-danger"><i class="glyphicon glyphicon-align-center"></i></button>
                  <button type="button" class="btn btn-danger"><i class="glyphicon glyphicon-align-right"></i></button>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-2">
                <div class="btn-group-vertical">
                  <button type="button" class="btn btn"><i class="glyphicon glyphicon-home"></i></button>
                  <button type="button" class="btn btn"><i class="glyphicon glyphicon-user"></i></button>
                  <button type="button" class="btn btn"><i class="glyphicon glyphicon-comment"></i></button>
                  <button type="button" class="btn btn"><i class="glyphicon glyphicon-cog"></i></button>
                </div>
              </div>
              <div class="col-md-2">
                <div class="btn-group-vertical">
                  <button type="button" class="btn btn-default"><i class="glyphicon glyphicon-home"></i></button>
                  <button type="button" class="btn btn-default"><i class="glyphicon glyphicon-user"></i></button>
                  <button type="button" class="btn btn-default"><i class="glyphicon glyphicon-comment"></i></button>
                  <button type="button" class="btn btn-default"><i class="glyphicon glyphicon-cog"></i></button>
                </div>
              </div>
              <div class="col-md-2">
                <div class="btn-group-vertical">
                  <button type="button" class="btn btn-primary"><i class="glyphicon glyphicon-home"></i></button>
                  <button type="button" class="btn btn-primary"><i class="glyphicon glyphicon-user"></i></button>
                  <button type="button" class="btn btn-primary"><i class="glyphicon glyphicon-comment"></i></button>
                  <button type="button" class="btn btn-primary"><i class="glyphicon glyphicon-cog"></i></button>
                </div>
              </div>
              <div class="col-md-2">
                <div class="btn-group-vertical">
                  <button type="button" class="btn btn-success"><i class="glyphicon glyphicon-home"></i></button>
                  <button type="button" class="btn btn-success"><i class="glyphicon glyphicon-user"></i></button>
                  <button type="button" class="btn btn-success"><i class="glyphicon glyphicon-comment"></i></button>
                  <button type="button" class="btn btn-success"><i class="glyphicon glyphicon-cog"></i></button>
                </div>
              </div>
              <div class="col-md-2">
                <div class="btn-group-vertical">
                  <button type="button" class="btn btn-info"><i class="glyphicon glyphicon-home"></i></button>
                  <button type="button" class="btn btn-info"><i class="glyphicon glyphicon-user"></i></button>
                  <button type="button" class="btn btn-info"><i class="glyphicon glyphicon-comment"></i></button>
                  <button type="button" class="btn btn-info"><i class="glyphicon glyphicon-cog"></i></button>
                </div>
              </div>
              <div class="col-md-2">
                <div class="btn-group-vertical">
                  <button type="button" class="btn btn-danger"><i class="glyphicon glyphicon-home"></i></button>
                  <button type="button" class="btn btn-danger"><i class="glyphicon glyphicon-user"></i></button>
                  <button type="button" class="btn btn-danger"><i class="glyphicon glyphicon-comment"></i></button>
                  <button type="button" class="btn btn-danger"><i class="glyphicon glyphicon-cog"></i></button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Button Dropdowns
      ================================================== -->
      <div class="example">
        <h2 class="example-title">Button Dropdowns</h2>
        <div class="row">
          <div class="col-md-12">
            <div class="btn-group">
              <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">Normal <span class="caret"></span></button>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
              </ul>
            </div>&nbsp;

            <div class="blank"></div>
            <div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Default <span class="caret"></span></button>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
              </ul>
            </div>&nbsp;

            <div class="blank"></div>
            <div class="btn-group">
              <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Primary <span class="caret"></span></button>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
              </ul>
            </div>&nbsp;

            <div class="blank"></div>
            <div class="btn-group">
              <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">Success <span class="caret"></span></button>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
              </ul>
            </div>&nbsp;

            <div class="blank"></div>
            <div class="btn-group">
              <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">Info <span class="caret"></span></button>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
              </ul>
            </div>&nbsp;

            <div class="blank"></div>
            <div class="btn-group">
              <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">Warning <span class="caret"></span></button>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
              </ul>
            </div>&nbsp;

            <div class="blank"></div>
            <div class="btn-group">
              <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">Danger <span class="caret"></span></button>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="btn-group">
              <button type="button" class="btn">Normal</button>
              <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
              </button>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
              </ul>
            </div>&nbsp;

            <div class="blank"></div>
            <div class="btn-group">
              <button type="button" class="btn btn-default">Default</button>
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
              </button>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
              </ul>
            </div>&nbsp;

            <div class="blank"></div>
            <div class="btn-group">
              <button type="button" class="btn btn-primary">Primary</button>
              <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
              </button>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
              </ul>
            </div>&nbsp;

            <div class="blank"></div>
            <div class="btn-group">
              <button type="button" class="btn btn-success">Success</button>
              <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
              </button>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
              </ul>
            </div>&nbsp;
            <div class="blank"></div>
            <div class="btn-group">
              <button type="button" class="btn btn-info">Info</button>
              <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
              </button>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
              </ul>
            </div>&nbsp;

            <div class="blank"></div>
            <div class="btn-group">
              <button type="button" class="btn btn-warning">Warning</button>
              <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
              </button>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
              </ul>
            </div>&nbsp;

            <div class="blank"></div>
            <div class="btn-group">
              <button type="button" class="btn btn-danger">Danger</button>
              <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
              </button>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <!-- Labels, Badges, Dropdowns, Tooltip and Popover
      ================================================== -->
      <div class="example">
        <div class="row">
          <div class="col-md-5">
            <div class="row">
              <div class="col-md-12">
                <!-- Labels
                ================================================== -->
                <h2 class="example-title">Labels</h2>
                <span class="label">Normal</span>&nbsp;
            	<div class="blank"></div>
                <span class="label label-default">Default</span>&nbsp;
                <div class="blank"></div>
                <span class="label label-primary">Primary</span>&nbsp;
                <div class="blank"></div>
                <span class="label label-success">Success</span>&nbsp;
                <div class="blank"></div>
                <span class="label label-info">Info</span>&nbsp;
                <div class="blank"></div>
                <span class="label label-warning">Warning</span>&nbsp;
                <div class="blank"></div>
                <span class="label label-danger">Danger</span>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <!-- Badges
                ================================================== -->
                <h2 class="example-title">Badges</h2>
                <span class="badge">Normal</span>&nbsp;
                <div class="blank"></div>
                <span class="badge badge-default">Default</span>&nbsp;
                <div class="blank"></div>
                <span class="badge badge-primary">Primary</span>&nbsp;
                <div class="blank"></div>
                <span class="badge badge-success">Success</span>&nbsp;
                <div class="blank"></div>
                <span class="badge badge-info">Info</span>&nbsp;
                <div class="blank"></div>
                <span class="badge badge-warning">Warning</span>&nbsp;
                <div class="blank"></div>
                <span class="badge badge-danger">Danger</span>&nbsp;
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 example-dropdown">
                <!-- Dropdowns
                ================================================== -->
                <h2 class="example-title">Dropdowns</h2>
                <ul class="dropdown-menu" role="menu">
                  <li class="dropdown-header">Setting</li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
                  <li role="presentation" class="disabled"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                  <li class="dropdown-submenu">
                      <a href="#">Something else here</a>
                      <ul class="dropdown-menu">
                          <li><a href="#">Action1</a></li>
                          <li><a href="#">Action2</a></li>
                          <li><a href="#">Another action</a></li>
                          <li><a href="#">Something else here</a></li>
                          <li class="divider"></li>
                          <li><a href="#">Separated link</a></li>
                      </ul>
                  </li>
                  <li role="presentation" class="divider"></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
                </ul>
              </div>
              <div class="col-md-6">
                <!-- Tooltips
                ================================================== -->
                <h2 class="example-title">Tooltips</h2>
                <div class="row tooltip-demo">
                  <div class="col-md-12"><button type="button" class="btn btn-info btn-block" data-toggle="tooltip" data-placement="left" title="Tooltip on left">Tooltip on left</button></div>
                  <div class="col-md-12"><button type="button" class="btn btn-info btn-block" data-toggle="tooltip" data-placement="top" title="Tooltip on top">Tooltip on top</button></div>
                  <div class="col-md-12"><button type="button" class="btn btn-info btn-block" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom">Tooltip on bottom</button></div>
                  <div class="col-md-12"><button type="button" class="btn btn-info btn-block" data-toggle="tooltip" data-placement="right" title="Tooltip on right">Tooltip on right</button></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-7">
            <!-- Popovers
            ================================================== -->
            <h2 class="example-title">Popovers</h2>
            <div class="row example-popover">
              <div class="col-md-6">
                <div class="popover top">
                  <div class="arrow"></div>
                  <h3 class="popover-title">Popover top</h3>
                  <div class="popover-content">
                    <p>Sed posuere consectetur est at lobortis. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="popover right">
                  <div class="arrow"></div>
                  <h3 class="popover-title">Popover right</h3>
                  <div class="popover-content">
                    <p>Sed posuere consectetur est at lobortis. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="popover bottom">
                  <div class="arrow"></div>
                  <h3 class="popover-title">Popover bottom</h3>
                  <div class="popover-content">
                    <p>Sed posuere consectetur est at lobortis. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="popover left">
                  <div class="arrow"></div>
                  <h3 class="popover-title">Popover left</h3>
                  <div class="popover-content">
                    <p>Sed posuere consectetur est at lobortis. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Forms
      ================================================== -->
      <div class="example">
        <div class="row">
          <div class="col-md-12">
            <h2 class="example-title">Forms</h2>
            <div class="row">
              <div class="col-md-6">
                <input type="text" class="form-control" placeholder="Text input">
              </div>
              <div class="col-md-6">
                <input type="text" class="form-control" disabled placeholder="Text input">
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <textarea class="form-control" rows="3"></textarea>
              </div>
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-12">
                    <div class="input-group">
                      <span class="input-group-addon">$</span>
                      <input type="text" class="form-control">
                      <span class="input-group-addon">.00</span>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="input-group">
                      <div class="input-group-btn">
                        <button type="button" class="btn btn-danger" tabindex="-1">Action</button>
                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" tabindex="-1">
                          <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                          <li><a href="#">Action</a></li>
                          <li><a href="#">Another action</a></li>
                          <li><a href="#">Something else here</a></li>
                          <li class="divider"></li>
                          <li><a href="#">Separated link</a></li>
                        </ul>
                      </div>
                      <input type="text" class="form-control">
                      <div class="input-group-btn">
                        <button type="button" class="btn btn-primary" tabindex="-1">Action</button>
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" tabindex="-1">
                          <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                          <li><a href="#">Action</a></li>
                          <li><a href="#">Another action</a></li>
                          <li><a href="#">Something else here</a></li>
                          <li class="divider"></li>
                          <li><a href="#">Separated link</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-search search-only">
                  <i class="search-icon glyphicon glyphicon-search"></i>
                  <input type="text" class="form-control search-query">
                </div>
              </div>
              <div class="col-md-6">
                <div class="input-group form-search">
                  <input type="text" class="form-control search-query">
                  <span class="input-group-btn">
                    <button type="submit" class="btn btn-primary" data-type="last">Search</button>
                  </span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group has-success has-feedback">
                  <label class="control-label" for="inputSuccess2">Input with success</label>
                  <input type="text" class="form-control" id="inputSuccess2">
                  <span class="glyphicon glyphicon-ok form-control-feedback"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group has-warning has-feedback">
                  <label class="control-label" for="inputWarning2">Input with warning</label>
                  <input type="text" class="form-control" id="inputWarning2">
                  <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group has-error has-feedback">
                  <label class="control-label" for="inputError2">Input with error</label>
                  <input type="text" class="form-control" id="inputError2">
                  <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
	  <!-- Stepper
      ================================================== -->
	  <div class="example">
        <h2 class="example-title">Stepper <span>(<b>How to use</b>: <a href="https://github.com/benplum/Stepper" target="_blank" >https://github.com/benplum/Stepper</a>)</span></h2>
        <div class="row">
          <div class="col-md-6">
			<input type="number" class="form-control" />
          </div>
          <div class="col-md-6">
			<input type="number" class="form-control" disabled/>
          </div>
        </div>
      </div>
	  <!-- Selecter
      ================================================== -->
	  <div class="example">
        <h2 class="example-title">Selecter <span>(<b>How to use</b>:  <a href="https://github.com/benplum/Selecter" target="_blank">https://github.com/benplum/Selecter</a>)</span></h2>
        <div class="row">
          <div class="col-md-3">
			<select name="selecter_basic" class="selecter_1">
				<optgroup label="Group One">
					<option value="1">One</option>
					<option value="2">Two</option>
					<option value="3">Three</option>
				</optgroup>
				<optgroup label="Group One">
					<option value="4">Four</option>
					<option value="5">Five</option>
					<option value="6">Six</option>
					<option value="7">Seven</option>
				</optgroup>
				<optgroup label="Group Three">
					<option value="8">Eight</option>
					<option value="9">Nine</option>
					<option value="10">Ten</option>
				</optgroup>
			</select>
		  </div>
          <div class="col-md-3">
			<select name="selecter_basic" class="selecter_2" data-selecter-options='{"label":"Jump Sites","external":"true"}'>
				<option value="http://google.com">Google Search</option>
				<option value="http://boingboing.com">BoingBoing</option>
				<option value="http://cnn.com">CNN News</option>
			</select>
		  </div>
		  <div class="col-md-3">
			<select name="selecter_basic" class="selecter_3"  data-selecter-options='{"cover":"true"}'>
				<option value="1">One</option>
				<option value="2">Two</option>
				<option value="3">Three</option>
				<option value="4">Four</option>
				<option value="5">Five</option>
			</select>
		  </div>
          <div class="col-md-3">
			<select name="selecter_basic" class="selecter_4" disabled="disabled">
				<option value="1">One</option>
				<option value="2">Two</option>
				<option value="3">Three</option>
				<option value="4">Four</option>
				<option value="5">Five</option>
			</select>
          </div>
		</div>
        <div class="row">
          <div class="col-md-6">
			<select name="selecter_multiple" class="selecter_5" multiple="multiple">
				<option value="1" >One</option>
				<option value="2" disabled>Two</option>
				<option value="3" selected>Three</option>
				<option value="4">Four</option>
				<option value="5">Five</option>
				<option value="6">Six</option>
				<option value="7">Seven</option>
				<option value="8">Eight</option>
				<option value="9">Nine</option>
				<option value="10">Ten</option>
			</select>
		  </div>
          <div class="col-md-6">
			<select name="selecter_multiple" class="selecter_6" multiple="multiple" disabled="disabled">
				<option value="1" >One</option>
				<option value="2" disabled>Two</option>
				<option value="3" selected>Three</option>
				<option value="4">Four</option>
				<option value="5">Five</option>
				<option value="6">Six</option>
				<option value="7">Seven</option>
				<option value="8">Eight</option>
				<option value="9">Nine</option>
				<option value="10">Ten</option>
			</select>
		  </div>
        </div>
      </div>
      <!-- Checkboxes and Radios
      ================================================== -->
      <div class="example">
        <h2 class="example-title">Checkboxes and Radios <span>(<b>How to use</b>: <a href="https://github.com/fronteed/iCheck/" target="_blank">https://github.com/fronteed/iCheck/</a>)</span></h2>
        <div class="row">
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-6">
                <div class="checkbox">
                  <input type="checkbox" id="flat-checkbox-1">
                  <label for="flat-checkbox-1">default</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="checkbox">
                  <input type="checkbox" id="flat-checkbox-2" checked>
                  <label for="flat-checkbox-2">checked</label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="checkbox">
                  <input type="checkbox" id="flat-checkbox-3" disabled>
                  <label for="flat-checkbox-3">disabled</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="checkbox">
                  <input type="checkbox" id="flat-checkbox-4" checked disabled>
                  <label for="flat-checkbox-4">checked & disabled</label>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-6">
                <div class="radio">
                  <input type="radio" id="flat-radio-1">
                  <label for="flat-radio-1">default</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="radio">
                  <input type="radio" id="flat-radio-2" checked>
                  <label for="flat-radio-2">checked</label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="radio">
                  <input type="radio" id="flat-radio-3" disabled>
                  <label for="flat-radio-3">disabled</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="radio">
                  <input type="radio" id="flat-radio-4" checked disabled>
                  <label for="flat-radio-4">checked & disabled</label>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
	  <!--Toggle
      ================================================== -->
      <div class="example">
		<h2 class="example-title">Toggle <span>(Used for <code>checkbox</code> or <code>radio</code>)</span></h2>
        <div class="row">
		  <div class="col-md-4">
			<label class="toggle">
			  <input type="checkbox" >
			  <span class="handle"></span>
			</label>
		  </div>
		  <div class="col-md-4">
			<label class="toggle">
			  <input type="checkbox" checked>
			  <span class="handle"></span>
			</label>
		  </div>
		  <div class="col-md-4">
			<label class="toggle">
			  <input type="checkbox" disabled>
			  <span class="handle"></span>
			</label>
		  </div>
		</div>
      </div>
	  <!--TimeLine
      ================================================== -->
      <div class="example">
		<h2 class="example-title">TimeLine</h2>
        <div class="row">
		  <div class="col-md-12">
			  <div class="timeline">
				  <dl>
					  <dt>Apr 2014</dt>
					  <dd class="pos-right clearfix">
						  <div class="circ"></div>
						  <div class="time">Apr 14</div>
						  <div class="events">
							  <div class="pull-left">
								  <img class="events-object img-rounded" src="img/photo-1.jpg">
							  </div>
							  <div class="events-body">
								  <h4 class="events-heading">Bootstrap</h4>
								  <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica.</p>
							  </div>
						  </div>
					  </dd>
					  <dd class="pos-left clearfix">
						  <div class="circ"></div>
						  <div class="time">Apr 10</div>
						  <div class="events">
							  <div class="pull-left">
								  <img class="events-object img-rounded" src="img/photo-2.jpg">
							  </div>
							  <div class="events-body">
								  <h4 class="events-heading">Bootflat</h4>
								  <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica.</p>
							  </div>
						  </div>
					  </dd>
					  <dt>Mar 2014</dt>
					  <dd class="pos-right clearfix">
						  <div class="circ"></div>
						  <div class="time">Mar 15</div>
						  <div class="events">
							  <div class="pull-left">
								  <img class="events-object img-rounded" src="img/photo-3.jpg">
							  </div>
							  <div class="events-body">
								  <h4 class="events-heading">Flat UI</h4>
								  <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica.</p>
							  </div>
						  </div>
					  </dd>
					  <dd class="pos-left clearfix">
						  <div class="circ"></div>
						  <div class="time">Mar 8</div>
						  <div class="events">
							  <div class="pull-left">
								  <img class="events-object img-rounded" src="img/photo-4.jpg">
							  </div>
							  <div class="events-body">
								  <h4 class="events-heading">UI design</h4>
								  <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica.</p>
							  </div>
						  </div>
					  </dd>

				  </dl>
			  </div>
		  </div>
		</div>
      </div>
	  <!-- Calendar
      ================================================== -->
	  <div class="example">
		<h2 class="example-title">Calendar and Pricing</h2>
		<div class="row">
			<div class="col-md-4">
				<div class="calendar">
					<div class="years clearfix">
						<div class="unit prev"><em></em></div>
						<div class="monyear">MAY 2014</div>
						<div class="unit next"><em></em></div>
					</div>
					<div class="days">
						<div class="clearfix">
							<div class="unit">SU</div>
							<div class="unit">MO</div>
							<div class="unit">TU</div>
							<div class="unit">WE</div>
							<div class="unit">TH</div>
							<div class="unit">FR</div>
							<div class="unit">SA</div>
						</div>
						<div class="clearfix">
							<div class="unit older"><b>27</b></div>
							<div class="unit older"><b>28</b></div>
							<div class="unit older"><b>29</b></div>
							<div class="unit older"><b>30</b></div>
							<div class="unit"><b>1</b></div>
							<div class="unit"><b>2</b></div>
							<div class="unit"><b>3</b></div>
							<div class="unit"><b>4</b></div>
							<div class="unit"><b>5</b></div>
							<div class="unit"><b>6</b></div>
							<div class="unit"><b>7</b></div>
							<div class="unit"><b>8</b></div>
							<div class="unit"><b>9</b></div>
							<div class="unit"><b>10</b></div>
							<div class="unit"><b>11</b></div>
							<div class="unit"><b>12</b></div>
							<div class="unit"><b>13</b></div>
							<div class="unit active"><b>14</b></div>
							<div class="unit"><b>15</b></div>
							<div class="unit"><b>16</b></div>
							<div class="unit"><b>17</b></div>
							<div class="unit"><b>18</b></div>
							<div class="unit"><b>19</b></div>
							<div class="unit"><b>20</b></div>
							<div class="unit"><b>21</b></div>
							<div class="unit"><b>22</b></div>
							<div class="unit"><b>23</b></div>
							<div class="unit"><b>24</b></div>
							<div class="unit"><b>25</b></div>
							<div class="unit"><b>26</b></div>
							<div class="unit"><b>27</b></div>
							<div class="unit"><b>28</b></div>
							<div class="unit"><b>29</b></div>
							<div class="unit"><b>30</b></div>
							<div class="unit"><b>31</b></div>
							<div class="unit older"><b>1</b></div>
							<div class="unit older"><b>2</b></div>
							<div class="unit older"><b>3</b></div>
							<div class="unit older"><b>4</b></div>
							<div class="unit older"><b>5</b></div>
							<div class="unit older"><b>6</b></div>
							<div class="unit older"><b>7</b></div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="pricing">
					<ul>
						<li class="unit price-primary">
							<div class="price-title">
								<h3>$299</h3>
								<p>per month</p>
							</div>
							<div class="price-body">
								<h4>Basic</h4>
								<p>Lots of clients &amp; users</p>
								<ul>
									<li>250 SKU's</li>
									<li>1 GB Storage</li>
									<li>3,5% transaction fee</li>
								</ul>
							</div>
							<div class="price-foot">
								<button type="button" class="btn btn-primary">Try a Week</button>
							</div>
						</li>
						<li class="unit price-success active">
							<div class="price-title">
								<h3>$499</h3>
								<p>per month</p>
							</div>
							<div class="price-body">
								<h4>Premium</h4>
								<p>Lots of clients &amp; users</p>
								<ul>
									<li>2500 SKU's</li>
									<li>5 GB Storage</li>
									<li>1,5% transaction fee</li>
								</ul>
							</div>
							<div class="price-foot">
								<button type="button" class="btn btn-success">Buy Now</button>
							</div>
						</li>
						<li class="unit price-warning">
							<div class="price-title">
								<h3>$599</h3>
								<p>per month</p>
							</div>
							<div class="price-body">
								<h4>Unlimited</h4>
								<p>Lots of clients &amp; users</p>
								<ul>
									<li>Unlimited SKU's</li>
									<li>20 GB Storage</li>
									<li>1% transaction fee</li>
								</ul>
							</div>
							<div class="price-foot">
								<button type="button" class="btn btn-warning">Subscribe</button>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	  </div>
      <!-- Alerts
      ================================================== -->
      <div class="example">
        <h2 class="example-title">Alerts</h2>
        <div class="row">
          <div class="col-md-6">
            <div class="alert alert-warning alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <strong>Warning!</strong> Best check yo self, you're not looking too good.
            </div>
            <div class="alert alert-info alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <strong>Well done!</strong> You successfully read this important alert message.
            </div>
          </div>
          <div class="col-md-6">
            <div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <strong>Heads up!</strong> This alert needs your attention, but it's not super important.
            </div>
            <div class="alert alert-danger">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <strong>Oh snap!</strong> Change a few things up and try submitting again.
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="alert alert-warning alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4>Warning!</h4>
              <p>Change this and that and try again. <a class="alert-link">Duis mollis</a>, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum.</p>
              <p><a class="btn btn-warning" href="#">Take this action</a> <a class="btn btn-link" href="#">Or do this</a></p>
            </div>
            <div class="alert alert-info">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4>Well done!</h4>
              <p>Change this and that and try again. <a class="alert-link">Duis mollis</a>, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum.</p>
              <p><a class="btn btn-primary" href="#">Take this action</a> <a class="btn btn-link" href="#">Or do this</a></p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4>Heads up!</h4>
              <p>Change this and that and try again. <a class="alert-link">Duis mollis</a>, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum.</p>
              <p><a class="btn btn-success" href="#">Take this action</a> <a class="btn btn-link" href="#">Or do this</a></p>
            </div>
            <div class="alert alert-danger alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4>Oh snap!</h4>
              <p>Change this and that and try again. <a class="alert-link">Duis mollis</a>, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum.</p>
              <p><a class="btn btn-danger" href="#">Take this action</a> <a class="btn btn-link" href="#">Or do this</a></p>
            </div>
          </div>
        </div>
      </div>
      <!-- Tabs
      ================================================== -->
      <div class="example">
        <h2 class="example-title">Tabs</h2>
        <div class="row">
          <div class="col-md-6">
            <div class="panel">
              <ul id="myTab1" class="nav nav-tabs nav-justified">
                <li class="active"><a href="#home1" data-toggle="tab">Home</a></li>
                <li><a href="#profile1" data-toggle="tab">Profile</a></li>
                <li class="dropdown">
                  <a href="#" id="myTabDrop1-1" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1">
                    <li><a href="#dropdown1-1" tabindex="-1" data-toggle="tab">@fat</a></li>
                    <li><a href="#dropdown1-2" tabindex="-1" data-toggle="tab">@mdo</a></li>
                  </ul>
                </li>
              </ul>
              <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade active in" id="home1">
                  <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica.</p>
                </div>
                <div class="tab-pane fade" id="profile1">
                  <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee.  </p>
                </div>
                <div class="tab-pane fade" id="dropdown1-1">
                  <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone...</p>
                </div>
                <div class="tab-pane fade" id="dropdown1-2">
                  <p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche ... </p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="panel">
              <div class="tabbable tabs-below">
                <div id="myTabContent" class="tab-content">
                  <div class="tab-pane fade active in" id="home2">
                    <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. </p>
                  </div>
                  <div class="tab-pane fade" id="profile2">
                    <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee.  </p>
                  </div>
                  <div class="tab-pane fade" id="dropdown2-1">
                    <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone...</p>
                  </div>
                  <div class="tab-pane fade" id="dropdown2-2">
                    <p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche ... </p>
                  </div>
                </div>
                <ul id="myTab2" class="nav nav-tabs nav-justified">
                  <li class="active"><a href="#home2" data-toggle="tab">Home</a></li>
                  <li><a href="#profile2" data-toggle="tab">Profile</a></li>
                  <li class="dropdown dropup">
                    <a href="#" id="myTabDrop2-1" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1">
                      <li><a href="#dropdown2-1" tabindex="-1" data-toggle="tab">@fat</a></li>
                      <li><a href="#dropdown2-2" tabindex="-1" data-toggle="tab">@mdo</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="panel">
              <div class="tabbable tabs-left clearfix">
                <ul id="myTab1" class="nav nav-tabs">
                  <li class="active"><a href="#home3" data-toggle="tab">Home</a></li>
                  <li><a href="#profile3" data-toggle="tab">Profile</a></li>
                  <li><a href="#myTabDrop3" data-toggle="tab">Dropdown</a></li>
                </ul>
                <div id="myTabContent" class="tab-content">
                  <div class="tab-pane fade active in" id="home3">
                    <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica.</p>
                  </div>
                  <div class="tab-pane fade" id="profile3">
                    <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee.  </p>
                  </div>
                  <div class="tab-pane fade" id="myTabDrop3">
                    <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone...</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="panel">
              <div class="tabbable tabs-right clearfix">
                <ul id="myTab1" class="nav nav-tabs">
                  <li class="active"><a href="#home4" data-toggle="tab">Home</a></li>
                  <li><a href="#profile4" data-toggle="tab">Profile</a></li>
                  <li><a href="#myTabDrop4" data-toggle="tab">Dropdown</a></li>
                </ul>
                <div id="myTabContent" class="tab-content">
                  <div class="tab-pane fade active in" id="home4">
                    <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica.</p>
                  </div>
                  <div class="tab-pane fade" id="profile4">
                    <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee.  </p>
                  </div>
                  <div class="tab-pane fade" id="myTabDrop4">
                    <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone...</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Navbars
      ================================================== -->
      <div class="example">
        <h2 class="example-title">Navbars</h2>
        <div class="row">
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-12">
                <nav class="navbar navbar-default" role="navigation">
                  <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                      <a class="navbar-brand" href="#">Bootflat</a>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                      <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Link</a></li>
                        <!-- <li class="disabled"><a href="#">Link</a></li> -->
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                          <ul class="dropdown-menu" role="menu">
                            <li class="dropdown-header">Setting</li>
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li class="active"><a href="#">Separated link</a></li>
                            <li class="divider"></li>
                            <li class="disabled"><a href="#">One more separated link</a></li>
                          </ul>
                        </li>
                      </ul>
                      <form class="navbar-form navbar-right" role="search">
                        <div class="form-search search-only">
                          <i class="search-icon glyphicon glyphicon-search"></i>
                          <input type="text" class="form-control search-query">
                        </div>
                      </form>
                    </div><!-- /.navbar-collapse -->
                  </div><!-- /.container-fluid -->
                </nav>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <nav class="navbar navbar-default" role="navigation">
                  <div class="container-fluid">
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                      <a class="navbar-brand" href="#">Bootflat</a>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                      <p class="navbar-text">Signed in as Mark Otto</p>
                    </div>
                  </div>
                </nav>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <nav class="navbar navbar-default" role="navigation">
                  <div class="container-fluid">
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-3">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                      <a class="navbar-brand" href="#">Bootflat</a>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-3">
                      <p class="navbar-text navbar-right"><a class="navbar-link" href="">Signed in as Mark Otto</a></p>
                    </div>
                  </div>
                </nav>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <nav class="navbar navbar-default" role="navigation">
                  <div class="container-fluid">
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-4">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                      <a class="navbar-brand" href="#">Bootflat</a>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-4">
                      <button type="button" class="btn btn-warning navbar-btn">Sign in</button>
                    </div>
                  </div>
                </nav>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-12">
                <nav class="navbar navbar-inverse" role="navigation">
                  <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-5">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                      <a class="navbar-brand" href="#">Bootflat</a>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-5">
                      <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Link</a></li>
                        <!-- <li class="disabled"><a href="#">Link</a></li> -->
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                          <ul class="dropdown-menu" role="menu">
                            <li class="dropdown-header">Setting</li>
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li class="active"><a href="#">Separated link</a></li>
                            <li class="divider"></li>
                            <li class="disabled"><a href="#">One more separated link</a></li>
                          </ul>
                        </li>
                      </ul>
                      <form class="navbar-form navbar-right" role="search">
                        <div class="form-search search-only">
                          <i class="search-icon glyphicon glyphicon-search"></i>
                          <input type="text" class="form-control search-query">
                        </div>
                      </form>
                    </div><!-- /.navbar-collapse -->
                  </div><!-- /.container-fluid -->
                </nav>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <nav class="navbar navbar-inverse" role="navigation">
                  <div class="container-fluid">
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-6">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                      <a class="navbar-brand" href="#">Bootflat</a>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-6">
                      <p class="navbar-text">Signed in as Mark Otto</p>
                    </div>
                  </div>
                </nav>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <nav class="navbar navbar-inverse" role="navigation">
                  <div class="container-fluid">
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-7">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                      <a class="navbar-brand" href="#">Bootflat</a>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-7">
                      <p class="navbar-text navbar-right"><a class="navbar-link" href="">Signed in as Mark Otto</a></p>
                    </div>
                  </div>
                </nav>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <nav class="navbar navbar-inverse" role="navigation">
                  <div class="container-fluid">
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-8">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                      <a class="navbar-brand" href="#">Bootflat</a>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-8">
                      <button type="button" class="btn btn-danger navbar-btn">Sign in</button>
                    </div>
                  </div>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Pills, Breadcrumbs, Progresses, Paginations and Pagers
      ================================================== -->
      <div class="example">
        <div class="row">
          <div class="col-md-6">
            <h2 class="example-title">Pills</h2>
            <div class="row">
              <div class="col-md-12">
                <ul class="nav nav-pills nav-justified">
                  <li class="active"><a href="#">Home <span class="badge">42</span></a></li>
                  <li><a href="#">Profile <span class="badge badge-danger">42</span></a></li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                      <li><a href="#">@fat</a></li>
                      <li><a href="#">@mdo</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
              <div class="col-md-12">
                <ul id="myTab2" class="nav nav-pills nav-stacked">
                  <li class="active"><a href="#">Home <span class="badge pull-right">42</span></a></li>
                  <li><a href="#">Profile</a></li>
                  <li class="dropdown"><a href="#">Messages <span class="badge badge-danger pull-right">20</span></a></li>
                </ul>
              </div>
            </div>
            <h2 class="example-title">Breadcrumbs</h2>
            <div class="row">
              <div class="col-md-12">
                <ol class="breadcrumb">
                  <li><a href="#">Home</a></li>
                  <li><a href="#">Library</a></li>
                  <li class="active">Data</li>
                </ol>
              </div>
              <div class="col-md-12">
                <ol class="breadcrumb breadcrumb-arrow">
                  <li><a href="#">Home</a></li>
                  <li><a href="#">Library</a></li>
                  <li class="active"><span>Data</span></li>
                </ol>
              </div>
              <div class="col-md-12">
                <ol class="breadcrumb breadcrumb-arrow">
                  <li><a href="#"><i class="glyphicon glyphicon-home"></i> Home</a></li>
                  <li><a href="#"><i class="glyphicon glyphicon-list-alt"></i> Library</a></li>
                  <li class="active"><span><i class="glyphicon glyphicon-calendar"></i> Data</span></li>
                </ol>
              </div>
            </div>
            <h2 class="example-title">Paginations</h2>
            <div class="row example-pagination">
              <div class="col-md-12">
                <ul class="pagination">
                  <li class="active"><a href="#">PREV</a></li>
                  <li><a href="#">1</a></li>
                  <li class="active"><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#">4</a></li>
                  <li class="disabled"><a href="#">5</a></li>
                  <li class="active"><a href="#">NEXT</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <h2 class="example-title">Progresses</h2>
            <div class="row example-progress">
              <div class="col-md-12">
                <div class="progress">
                  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">60%</div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="progress">
                  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                    <span class="sr-only">40% Complete (success)</span>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="progress">
                  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                    <span class="sr-only">20% Complete</span>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="progress">
                  <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                    <span class="sr-only">60% Complete (warning)</span>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="progress">
                  <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                    <span class="sr-only">80% Complete</span>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="progress progress-striped active">
                  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                    <span class="sr-only">40% Complete (success)</span>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="progress progress-striped active">
                  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                    <span class="sr-only">20% Complete</span>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="progress progress-striped active">
                  <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                    <span class="sr-only">60% Complete (warning)</span>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="progress progress-striped active">
                  <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                    <span class="sr-only">80% Complete (danger)</span>
                  </div>
                </div>
              </div>
            </div>
            <h2 class="example-title">Pagers</h2>
            <div class="row example-pagination">
              <div class="col-md-12">
                <ul class="pager">
                  <li class="previous"><a href="#">Previous</a></li>
                  <li class="next disabled"><a href="#">Next</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Accordions
      ================================================== -->
      <div class="example">
        <h2 class="example-title">Accordions</h2>
        <div class="row">
          <div class="col-md-6">
            <div class="panel-group" id="accordion1">
              <div class="panel">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion1" href="#collapseOne">
                      Collapsible Group Item #1
                    </a>
                  </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in">
                  <div class="panel-body">
                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                  </div>
                </div>
              </div>
              <div class="panel">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion1" href="#collapseTwo">
                      Collapsible Group Item #2
                    </a>
                  </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse">
                  <div class="panel-body">
                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                  </div>
                </div>
              </div>
              <div class="panel">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion1" href="#collapseThree">
                      Collapsible Group Item #3
                    </a>
                  </h4>
                </div>
                <div id="collapseThree" class="panel-collapse collapse">
                  <div class="panel-body">
                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="panel-group panel-group-lists" id="accordion2">
              <div class="panel">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion2" href="#collapseFour">
                      Collapsible Group Item #1
                    </a>
                  </h4>
                </div>
                <div id="collapseFour" class="panel-collapse collapse in">
                  <div class="panel-body">
                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                  </div>
                </div>
              </div>
              <div class="panel">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion2" href="#collapseFive">
                      Collapsible Group Item #2
                    </a>
                  </h4>
                </div>
                <div id="collapseFive" class="panel-collapse collapse">
                  <div class="panel-body">
                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                  </div>
                </div>
              </div>
              <div class="panel">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion2" href="#collapseSix">
                      Collapsible Group Item #3
                    </a>
                  </h4>
                </div>
                <div id="collapseSix" class="panel-collapse collapse">
                  <div class="panel-body">
                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Lists
      ================================================== -->
      <div class="example">
        <h2 class="example-title">Lists</h2>
        <div class="row">
          <div class="col-md-6">
            <ul class="list-group">
              <li class="list-group-item"><span class="badge">14</span>Cras justo odio</li>
              <li class="list-group-item"><span class="badge badge-default">91</span>Dapibus ac facilisis in</li>
              <li class="list-group-item"><span class="badge badge-primary">38</span>Morbi leo risus</li>
              <li class="list-group-item"><span class="badge badge-success">56</span>Porta ac consectetur ac</li>
              <li class="list-group-item"><span class="badge badge-warning">20</span>Vestibulum at eros</li>
              <li class="list-group-item"><span class="badge badge-danger">99+</span>Dapibus ac facilisis in</li>
            </ul>
          </div>
          <div class="col-md-6">
            <div class="list-group">
              <a href="#" class="list-group-item list-group-item-primary">facilisis in</a>
              <a href="#" class="list-group-item list-group-item-success">Dapibus ac facilisis in</a>
              <a href="#" class="list-group-item list-group-item-info">Cras sit amet nibh libero</a>
              <a href="#" class="list-group-item list-group-item-warning">Porta ac consectetur ac</a>
              <a href="#" class="list-group-item list-group-item-danger">Vestibulum at eros</a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="list-group">
              <a href="#" class="list-group-item active">Cras justo odio</a>
              <a href="#" class="list-group-item">Dapibus ac facilisis in</a>
              <a href="#" class="list-group-item">Morbi leo risus</a>
              <a href="#" class="list-group-item">Porta ac consectetur ac</a>
              <a href="#" class="list-group-item">Vestibulum at eros</a>
              <a href="#" class="list-group-item"><span class="badge badge-primary">38</span>Morbi leo risus</a>
            </div>
          </div>
          <div class="col-md-6">
            <div class="list-group">
              <a href="#" class="list-group-item active">
                <h4 class="list-group-item-heading">List group item heading</h4>
                <p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
              </a>
              <a href="#" class="list-group-item">
                <h4 class="list-group-item-heading">List group item heading</h4>
                <p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
              </a>
              <a href="#" class="list-group-item">
                <h4 class="list-group-item-heading">List group item heading</h4>
                <p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
              </a>
            </div>
          </div>
        </div>
      </div>
      <!-- Jumbotron
      ================================================== -->
      <div class="example">
        <h2 class="example-title">Jumbotron</h2>
        <div class="row">
          <div class="col-md-6">
            <div class="jumbotron">
              <div class="jumbotron-photo"><img src="img/Jumbotron.jpg" /></div>
              <div class="jumbotron-contents">
                <h1>Implementing the HTML and CSS into your user interface project</h1>
                <h2>HTML Structure</h2>
                <p>This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
                <h2>CSS Structure</h2>
                <p>This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="jumbotron">
              <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                  <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                  <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                  <div class="item active"><img src="img/slider1.jpg"></div>
                  <div class="item"><img src="img/slider2.jpg"></div>
                  <div class="item"><img src="img/slider3.jpg"></div>
                </div>
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                  <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                  <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
              </div>
              <div class="jumbotron-contents">
                <h1>Implementing the HTML and CSS into your user interface project</h1>
                <h2>HTML Structure</h2>
                <p>This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
                <h2>CSS Structure</h2>
                <p>This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Thumbnails
      ================================================== -->
      <div class="example">
        <h2 class="example-title">Thumbnails</h2>
        <div class="row">
            <div class="col-sm-6 col-md-3">
              <div class="thumbnail">
                <img class="img-rounded" src="img/thumbnail-1.jpg" >
                <div class="caption text-center">
                  <h3>Thumbnail label</h3>
                  <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id ...</p>
                  <p><a href="#" class="btn btn-warning" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="thumbnail">
                <img class="img-rounded" src="img/thumbnail-2.jpg">
                <div class="caption text-center">
                  <h3>Thumbnail label</h3>
                  <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id ...</p>
                  <p><a href="#" class="btn btn-warning" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="thumbnail">
                <img class="img-rounded" src="img/thumbnail-3.jpg">
                <div class="caption text-center">
                  <h3>Thumbnail label</h3>
                  <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id ...</p>
                  <p><a href="#" class="btn btn-warning" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="thumbnail">
                <img class="img-rounded" src="img/thumbnail-4.jpg">
                <div class="caption text-center">
                  <h3>Thumbnail label</h3>
                  <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id ...</p>
                  <p><a href="#" class="btn btn-warning" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                </div>
              </div>
            </div>
          </div>
      </div>
      <!-- Modals and Wells
      ================================================== -->
      <div class="example">
        <div class="row example-modal">
          <div class="col-md-6">
            <h2 class="example-title">Modals</h2>
            <div class="modal">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Contact</h4>
                  </div>
                  <div class="modal-body">
                    <p>Feel free to contact us for any issues you might have with our products.</p>
                    <div class="row">
                      <div class="col-xs-6">
                        <label>Name</label>
                        <input type="text" class="form-control" placeholder="Name">
                      </div>
                      <div class="col-xs-6">
                        <label>Email</label>
                        <input type="text" class="form-control" placeholder="Email">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-12">
                        <label>Message</label>
                        <textarea class="form-control" rows="3">Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac</textarea>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success">Send</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <h2 class="example-title">Wells</h2>
            <div class="well">Look, I'm in a well!</div>
          </div>
        </div>
      </div>
      <!-- Panels
      ================================================== -->
      <div class="example">
        <h2 class="example-title">Panels</h2>
        <div class="row">
          <div class="col-md-6">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Panel title</h3>
              </div>
              <div class="panel-body">
                Panel content
              </div>
            </div>
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title">Panel title</h3>
              </div>
              <div class="panel-body">
                Panel content
              </div>
            </div>
            <div class="panel panel-success">
              <div class="panel-heading">
                <h3 class="panel-title">Panel title</h3>
              </div>
              <div class="panel-body">
                Panel content
              </div>
            </div>
            <div class="panel panel-warning">
              <div class="panel-heading">
                <h3 class="panel-title">Panel title</h3>
              </div>
              <div class="panel-body">
                Panel content
              </div>
            </div>
            <div class="panel panel-info">
              <div class="panel-heading">
                <h3 class="panel-title">Panel title</h3>
              </div>
              <div class="panel-body">
                Panel content
              </div>
            </div>
            <div class="panel panel-danger">
              <div class="panel-heading">
                <h3 class="panel-title">Panel title</h3>
              </div>
              <div class="panel-body">
                Panel content
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="panel panel-default">
              <div class="panel-heading">Panel heading</div>
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Username</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>Larry</td>
                    <td>the Bird</td>
                    <td>@twitter</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">Panel heading</div>
              <div class="panel-body">
                <p>Some default panel content here. Nulla vitae elit libero, a pharetra augue. Aenean lacinia bibendum nulla sed consectetur. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
              </div>
              <ul class="list-group">
                <li class="list-group-item">Cras justo odio</li>
                <li class="list-group-item">Dapibus ac facilisis in</li>
                <li class="list-group-item">Morbi leo risus</li>
                <li class="list-group-item">Porta ac consectetur ac</li>
                <li class="list-group-item">Vestibulum at eros</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <!-- Media Lists
      ================================================== -->
      <div class="example">
        <div class="row">
          <div class="col-md-12">
            <h2 class="example-title">Media list</h2>
            <ul class="media-list">
              <li class="media">
                <a class="pull-left" href="#"><img class="media-object img-rounded" src="img/photo-1.jpg"></a>
                <div class="media-body">
                  <h4 class="media-heading">Media heading</h4>
                  <p>12 Apr, 2013 at 12:00</p>
                  <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.</p>
                  <!-- Nested media object -->
                  <div class="media">
                    <a class="pull-left" href="#"><img class="media-object img-rounded" src="img/photo-2.jpg"></a>
                    <div class="media-body">
                      <h4 class="media-heading">Nested media heading</h4>
                      <p>12 Apr, 2013 at 12:10</p>
                      <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.</p>
                      <!-- Nested media object -->
                      <div class="media">
                        <a class="pull-left" href="#"><img class="media-object img-rounded" src="img/photo-3.jpg"></a>
                        <div class="media-body">
                          <h4 class="media-heading">Nested media heading</h4>
                          <p>12 Apr, 2013 at 12:20</p>
                          <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Nested media object -->
                  <div class="media">
                    <a class="pull-left" href="#"><img class="media-object img-rounded" src="img/photo-2.jpg"></a>
                    <div class="media-body">
                      <h4 class="media-heading">Nested media heading</h4>
                      <p>12 Apr, 2013 at 12:30</p>
                      <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.</p>
                    </div>
                  </div>
                </div>
              </li>
              <li class="media">
                <a class="pull-right" href="#"><img class="media-object img-rounded" src="img/photo-4.jpg"></a>
                <div class="media-body">
                  <h4 class="media-heading">Media heading</h4>
                  <p>12 Apr, 2013 at 12:50</p>
                  <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.</p>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- Footer
      ================================================== -->
      <div class="example">
        <h2 class="example-title">Footers</h2>
        <div class="row">
          <div class="col-md-12">
            <div class="footer">
              <div class="container">
                <div class="clearfix">
                  <div class="footer-logo"><a href="#"><img src="img/footer-logo.png" />Bootflat</a></div>
                  <dl class="footer-nav">
                    <dt class="nav-title">PORTFOLIO</dt>
                    <dd class="nav-item"><a href="#">Web Design</a></dd>
                    <dd class="nav-item"><a href="#">Branding &amp; Identity</a></dd>
                    <dd class="nav-item"><a href="#">Mobile Design</a></dd>
                    <dd class="nav-item"><a href="#">Print</a></dd>
                    <dd class="nav-item"><a href="#">User Interface</a></dd>
                  </dl>
                  <dl class="footer-nav">
                    <dt class="nav-title">ABOUT</dt>
                    <dd class="nav-item"><a href="#">The Company</a></dd>
                    <dd class="nav-item"><a href="#">History</a></dd>
                    <dd class="nav-item"><a href="#">Vision</a></dd>
                  </dl>
                  <dl class="footer-nav">
                    <dt class="nav-title">GALLERY</dt>
                    <dd class="nav-item"><a href="#">Flickr</a></dd>
                    <dd class="nav-item"><a href="#">Picasa</a></dd>
                    <dd class="nav-item"><a href="#">iStockPhoto</a></dd>
                    <dd class="nav-item"><a href="#">PhotoDune</a></dd>
                  </dl>
                  <dl class="footer-nav">
                    <dt class="nav-title">CONTACT</dt>
                    <dd class="nav-item"><a href="#">Basic Info</a></dd>
                    <dd class="nav-item"><a href="#">Map</a></dd>
                    <dd class="nav-item"><a href="#">Conctact Form</a></dd>
                  </dl>
                </div>
                <div class="footer-copyright text-center">Copyright &copy; 2014 Flathemes.All rights reserved.</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Typography
      ================================================== -->
      <div class="example">
        <h2 class="example-title">Typography</h2>
        <div class="row">
          <div class="col-md-12">
              <div class="example-typography">
                <h1><span class="heading-note">Header 1</span>Showers across the W</h1>
              </div>
              <div class="example-typography">
                <h1><span class="heading-note">Header 1</span>Showers across the W</h1>
              </div>
              <div class="example-typography">
                <h2><span class="heading-note">Header 2</span>Give this quartet a few</h2>
              </div>
              <div class="example-typography">
                <h3><span class="heading-note">Header 3</span>The Vatican transitions to a</h3>
              </div>
              <div class="example-typography">
                <h4><span class="heading-note">Header 4</span>Great American Bites: Telluride's Oak, The</h4>
              </div>
              <div class="example-typography">
                <h5><span class="heading-note">Header 5</span>Author Diane Alberts loves her some good</h5>
              </div>
              <div class="example-typography">
                <h6><span class="heading-note">Header 6</span>With the success of young-adult book-to-movie</h6>
              </div>
              <div class="example-typography">
                <span class="text-note">Paragraph</span>
                <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. <strong>Donec ullamcorper</strong> nulla non metus auctor fringilla. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</p>
              </div>
              <div class="example-typography">
                <span class="text-note">Image</span>
                <img src="img/slider1.jpg" alt="exaple-image" class="img-rounded img-responsive">
                <p class="img-comment"><strong>Note:</strong> gravida at eget metus. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</p>
              </div>
              <div class="example-typography">
                <span class="text-note">Lead Text</span>
                <p class="lead">Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
              </div>
              <div class="example-typography">
                <span class="text-note">Quote</span>
                <blockquote>
                  <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec ullamcorper nulla non metus auctor fringilla. Duis mollis, est non commodo luctus.</p>
                  <small>Steve Jobs, CEO Apple</small>
                </blockquote>
              </div>
              <div class="example-typography">
                <span class="text-note">Small Font</span>
                <p><small>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec ullamcorper nulla non metus auctor fringilla. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</small></p>
              </div>
          </div>
        </div>
      </div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>