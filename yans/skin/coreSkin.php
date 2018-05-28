<?php
require_once(YANS_ROOT_PATH.'lib/yansSkin.php');

class coreSkin extends yansSkin {
	function header($title = 'Yans', $styles = []) {
		$outputHTML = '
			<!DOCTYPE HTML>
			<html>
				<head>
					<title>'.$title.'</title>';
					foreach ($styles as $style) {
						$outputHTML.='<link rel="stylesheet" href="'.$style.'">';
					}
					$outputHTML.='
				</head>
				<body>
		';
		return $outputHTML;
	}

	function branding() {
		$outputHTML = '
			<div id="branding">
				<div class="main_width">
					<div class="logo">
						<h1>Yans</h1>
					</div>
					<div id="user_nav">
						@username usernav
					</div>
				</div>
			</div>
		';
		return $outputHTML;
	}

	function headerBar() {
		$outputHTML = '
		<header id="header">
			<nav id="main_nav">
				<ul id="apps">
					<a href=""><li>appka01</li></a>
					<a href=""><li>appka02</li></a>
					<a href=""><li>appka03</li></a>
				</ul>
				<ul id="search">
					<li>searchbar</li>
				</ul>
			</nav>
		</header>';
		return $outputHTML;
	}

	function footer() {
		$outputHTML = '
			<footer id="footer">
				<div class="logo">
					<h1>Yans</h1>
					<span class="desc">Yet another news system :)</span>
				</div>
				<div class="sections">
					<h4>Sections</h4>
					<ul>
						<li>section 1</li>
						<li>section 2</li>
						<li>section 3</li>
						<li>section 4</li>
						<li>section 5</li>
						<li>section 6</li>
					</ul>
				</div>
				<div class="quicknav">
					<h4>Quicknav</h4>
					<ul>
						<li>quicknav 1</li>
						<li>quicknav 2</li>
						<li>quicknav 3</li>
						<li>quicknav 4</li>
						<li>quicknav 5</li>
						<li>quicknav 6</li>
					</ul>
				</div>
			</footer>
		</body></html>';
		return $outputHTML;
	}
}
