<?php /* application/views/secure/login/register/index.php */

echo '<main id="main" class="main login" role="main">',
	'<div class="main-1">',
		# Get the main content.
		$display_content,
	'</div>',
	'<div class="main-2">',
		'<p>If you are have trouble registering or logging in, please send us an <a href="', APPLICATION_URL, 'webSupport/" title="Email web support">email</a>.</p>',
		# Display other content (forms).
		$display,
		$display_quote,
	'</div>',
	'<div class="main-3"></div>',
'</main>',

'<section id="box1" class="box1">',
	'<div id="box1a" class="box1-a">',
	'</div>',
	'<div id="box1b" class="box1-b">',
	'</div>',
	'<div id="box1c" class="box1-c">',
	'</div>',
'</section>',

'<section id="box2" class="box2">',
'</section>';