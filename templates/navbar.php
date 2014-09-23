<?php /* templates/navbar.php */
echo '<nav id="navbar" class="nav1">',
	'<ol>',
		'<li class="list-nav-1', (($doc->removeIndex(FULL_URL)===DOMAIN_NAME.'/') ? '' : ' hover'), Document::addHereClass(APPLICATION_URL, TRUE, FALSE), '">',
			'<a href="', APPLICATION_URL, '" title="Home">home</a>',
		'</li>',
		'<li class="list-nav-1',((strstr(FULL_URL, 'store') !== FALSE) ? '' : ' hover'),'">',
			'<a href="',APPLICATION_URL,'store/"',Document::addHereClass(APPLICATION_URL.'store/'),' title="Store">Store</a>',
			'<ul>',
				'<li>',
					'<a href="',APPLICATION_URL,'store/books/" id="link7a"',Document::addHereClass(APPLICATION_URL.'store/books/', TRUE),' title="Books">Books</a>',
				'</li>',
			'</ul>',
		'</li>',
		'<li class="list-nav-1',((strstr(FULL_URL, '/media/') !== FALSE) ? '' : ' hover'),'">',
			'<a href="',APPLICATION_URL,'media/videos/"',Document::addHereClass(APPLICATION_URL.'media/videos/'),' title="Media">Media</a>',
			'<ul>',
				'<li>',
					'<a href="',APPLICATION_URL,'media/audio/"',Document::addHereClass(APPLICATION_URL.'media/audio/'),' title="Audio">Audio</a>',
				'</li>',
				'<li>',
					'<a href="',APPLICATION_URL,'media/videos/"',Document::addHereClass(APPLICATION_URL.'media/videos/'),' title="Videos">Videos</a>',
				'</li>',
			'</ul>',
		'</li>',
		'<li class="list-nav-1', Document::addHereClass(APPLICATION_URL.'contact/', FALSE, FALSE), '">',
			'<a href="', APPLICATION_URL, 'contact/" title="Contact Steve">contact</a>',
		'</li>',
	'</ol>',
'</nav>';