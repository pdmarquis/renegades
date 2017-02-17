<style>



	#powerTip{
		background: #FFF;
		color:#333;
border: 1px solid rgba(0,0,0,.15);
		box-shadow: 0 6px 12px rgba(0,0,0,.175);
		z-index: 99999;
		padding: 20px;
	}
	#powerTip.n:before, #powerTip.s:before {
		border-right: 15px solid transparent;
		border-left: 15px solid transparent;
		margin-left: -15px
	}
	#powerTip.n:before {
		border-top: 20px solid #3ca9fc;
		border-top: 20px solid #3ca9fc;
		bottom: -20px
	}

	#powerTip.e:before {
		border-right: 20px solid #3ca9fc;
		border-right: 20px solid #3ca9fc;
		left: -20px
	}

	#powerTip.s:before {
		border-bottom: 20px solid #3ca9fc;
		border-bottom: 20px solid #3ca9fc;
		top: -20px
	}

	#powerTip.w:before {
		border-left: 20px solid #3ca9fc;
		border-left: 20px solid #3ca9fc;
		right: -20px
	}

	#powerTip.ne:before, #powerTip.se:before {
		border-right: 20px solid transparent;
		border-left: 0;
		left: 10px
	}

	#powerTip.nw:before, #powerTip.sw:before {
		border-left: 20px solid transparent;
		border-right: 0;
		right: 20px
	}

	#powerTip.ne:before, #powerTip.nw:before {
		border-top: 20px solid #3ca9fc;
		border-top: 20px solid #3ca9fc;
		bottom: -20px
	}

	#powerTip.se:before, #powerTip.sw:before {
		border-bottom: 20px solid #3ca9fc;
		border-bottom: 20px solid #3ca9fc;
		top: -20px
	}

	#powerTip.nw-alt:before, #powerTip.ne-alt:before, #powerTip.sw-alt:before, #powerTip.se-alt:before {
		border-top: 10px solid #3ca9fc;
		border-top: 10px solid #3ca9fc;
		bottom: -10px;
		border-left: 5px solid transparent;
		border-right: 5px solid transparent;
		left: 10px
	}

	#powerTip.ne-alt:before {
		left: auto;
		right: 10px
	}

	#powerTip.sw-alt:before, #powerTip.se-alt:before {
		border-top: 0;
		border-bottom: 10px solid #3ca9fc;
		border-bottom: 10px solid #3ca9fc;
		bottom: auto;
		top: -10px
	}


	#wp-header{
		right: 0;
		left: 160px;
		margin:-20px -20px 20px;
		background:#222 url('<?php echo THEME_URI ?>/lib/admin/images/2_t.png');
		padding: 0 20px;
		z-index: 99999;
	}
	.is-sticky #wp-header .pill{
		padding: 5px 20px;
	}
	.is-sticky .pill .btn{
		padding:3px 6px;
		font-size: .85em;
	}
	#wp-header .pill{width: 23.5%;text-align: center;float: left;margin-right: 2%;padding:20px;
		box-sizing: border-box}
	#wp-header .pill:last-child{margin-right: 0}
	#wp-header .content{display: none}

	.content{width:380px;font-size: 14px;line-height: 1.8em}
	.content h3{background: #3ca9fc;color:#FFF;display: block;margin: -21px -21px 20px;padding: 8px;


		-webkit-border-top-left-radius: 5px;
		-webkit-border-top-right-radius: 5px;
		-moz-border-radius-topleft: 5px;
		-moz-border-radius-topright: 5px;
		border-top-left-radius: 5px;
		border-top-right-radius: 5px;}
	.content ul{margin: 10px 0}
	.content li{display: block;float: none;margin-left: 10px}
	.content li:before{content: "\f058";color:#00be3a;font-family: FontAwesome;margin-right: 4px}
	.content .footer{text-align: center;}
	.content .footer .btn{min-width: 120px}
	.swift-donate-amount{padding:6px 0;margin-top: 6px}
</style>
<div id="wp-header" class="clearfix">
	<div class="pill">
		<a href="http://SwiftThemes.Com/plans-and-pricing" target="_blank" class="btn btn-primary">Upgrade to Premium</a>
		<div class="tooltip-html">
		<div class="content">
			<h3>Upgrade to premium</h3>
			<p>Upgrade to Swift premium and get more useful features like</p>
			<ul>
				<li>
					Short codes
				</li>
				<li>
					Window width slider for business sites
				</li>
				<li>
					News paper layout
				</li>
				<li>
					More layout options like Boxed, centered
				</li>
				<li>
					Customizable footer columns
				</li>
				<li>background image settings with built in image picker</li>
				<li>More fine tuning options for FontAwesome</li>
			</ul>
			<p class="footer"><em><a href="#">learn more</a> (or)</em> <a href="http://swiftthemes.com/plans-and-pricing/" target="_blank" class="aligncenter btn btn-success">Get Swift Premium</a></p>
		</div>
		</div>
	</div>
	<div class="pill">
		<a href="https://swiftthemes.com/premium-wordpress-support/" target="_blank" class="btn btn-success">WordPress Support</a>
		<div class="tooltip-html">
			<div class="content">
				<h3>Get expert help</h3>
				<p>
					Need help with your WordPress or hosting related problems?</br>
					Get expert help starting at as low as $5 per month.
					<br />
					<br />
				</p>
				<p class="footer"><a href="https://swiftthemes.com/premium-wordpress-support/" target="_blank" class="aligncenter btn btn-success">Learn more</a></p>

			</div>
		</div>
	</div>
	<div class="pill">
		<a href="http://swiftthemes.com/how-to-get-90-google-page-speed-with-swiftpremium/#attachment_2841" class="btn btn-danger">90+ PageSpeed Score</a>
		<div class="tooltip-html">
			<div class="content">
				<h3>Let us optimize your site for maximum SPEED</h3>
				<p>
				Do you know that SPEED is very important for SEO. Google started taking speed as one of the metric for ranking websites.<br />
				A faster site is also very important for a GOOD USER EXPERIENCE.
				</p>
				<blockquote style="border-left:solid 5px #ff392e;margin:20px;padding-left:10px;font-size:1.2em;font-style: italic">
					Online users expect a site to load in 3 seconds or less.</blockquote>

				You did the major part of making your website faster by choosing Swift, congratulations :)<br />
				Now optimize it further to get an extra edge over your competition.
				<p class="footer">                <br>

                    <a href="http://swiftthemes.com/how-to-get-90-google-page-speed-with-swiftpremium/">Do it yourself</a> (or) Hire us to do it for $87
                </p>

                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank" style="width: 160px;margin:20px auto 0">
                    <input type="hidden" name="cmd" value="_s-xclick">
                    <input type="hidden" name="hosted_button_id" value="9LNAG4GRWMESU">
                    <input type="image" src="https://www.paypalobjects.com/en_GB/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal – The safer, easier way to pay online.">
                    <img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
                </form>


            </div>
		</div>
	</div>

	<div class="pill">
		<a href="http://SwiftThemes.Com/plans-and-pricing"  target="_blank" class="btn btn-warning">Buy us a Coffee</a>
		<script>
			jQuery(document).ready(function($){
				$('#powerTip').on('click','.cups', function(){
					var donation = jQuery(this).data('amount')
					$('.swift-donate-amount').attr('value', donation)

				})
			})

		</script>
		<div class="tooltip-html">
			<div class="content clearfix" style="background: url('<?php echo THEME_URI?>/lib/admin/images/cup.png') no-repeat 90% 55px">

				<h3>Love Swift? Help us spend more time on it :)</h3>
				<form name="_xclick" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
					<div class="cups btn btn-success btn-mini" data-amount="5.00">1 Cup</div>
					<div class="cups btn btn-success btn-mini" data-amount="8.00">2 Cups</div>
					<div class="cups btn btn-success btn-mini" data-amount="13.00">3 Cups</div><br>
					$<input type="text" class="swift-donate-amount" name="amount" value="13.00" size="8">
					<input type="submit"  border="0" name="submit"  value="Order Coffee" class="btn btn-primary">

					<br>
					<div class="alignleft" style="font-size:12px;font-style: italic;color:#999"><small>Or enter a custom amount</small></div>
					<input type="hidden" name="cmd" value="_xclick">
					<input type="hidden" name="business" value="payments@swiftthemes.com">
					<input type="hidden" name="item_name" value="Donation for SwiftTheme">
					<input type="hidden" name="currency_code" value="USD">
					<!--<input type="hidden" name="amount" value="25.00">-->
				</form>
                <div class="clear"></div>

            <p class="footer"><br>Not just money, there are lot of other ways to show your love.<br>
            <a href="https://swiftthemes.com/donate/" target="_blank" class="btn btn-success">Tell me more</a>
            </p>
			</div>
		</div>
	</div>

</div>
<div class="clear"></div>
<div id="sb">
    <div class="widget">
        <div class="title">Quick Links</div>
        <ul>
            <li class="fa-question-circle"><a href="http://swiftthemes.com/forums/" title="Get Support">Support
                    Forum</a></li>
            <li class="fa-users"><a href="http://swiftthemes.com/swiftlers-area/member/index"
                                    title="Get the latest version">Members Area</a></li>
            <li class="fa-book"><a href="http://swiftthemes.com/swiftpremium-quick-start-guide/"
                                   title="Installation and Getting Started">Quick Start Guide</a></li>
            <li class="fa-filter fa-link"><a href="http://swiftthemes.com/hooks-and-filters-in-swift/"
                                             title="List of hooks and filters in Swift">Hooks & Filters</a></li>
            <li class="fa-envelope"><a href="http://swiftthemes.com/contact-me/" title="Contact Us">Contact Us</a></li>
            <li class="fa-tachometer"><a
                    href="http://swiftthemes.com/how-to-get-90-google-page-speed-with-swiftpremium/"
                    title="Optimzie Your Site">Get 90+ page speed score</a></li>
            <li class="fa-wrench"><a href="http://swiftthemes.com/services/" title="Our WordPress related services">Services</a>
            </li>
        </ul>
    </div>
    <div class="widget" style="font-size:16px;line-height:1.2em;font-weight:300">
        Follow us for Quick Support, Offers and WordPress and Swift news
    </div>
    <a class="twitter-timeline" href="https://twitter.com/SwiftThemes" data-widget-id="299395892325269505">Tweets by
        @SwiftThemes</a>
    <script>!function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
            if (!d.getElementById(id)) {
                js = d.createElement(s);
                js.id = id;
                js.src = p + "://platform.twitter.com/widgets.js";
                fjs.parentNode.insertBefore(js, fjs);
            }
        }(document, "script", "twitter-wjs");</script>


</div>