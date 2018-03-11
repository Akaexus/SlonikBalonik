<?php
require_once(YANS_ROOT_PATH.'lib/yansSkin.php');

class coreSkin extends yansSkin {
	function header() {
		$outputHTML = '
			<!DOCTYPE HTML>
			<html>
				<head>
					<title>elo</title>
					<link rel="stylesheet" href="public/mdrnze/style.css">
				</head>
				<body>
					<header id="header">
						<nav id="main_nav">
							<ul id="apps">
								<a href=""><li>appka01</li></a>
								<a href=""><li>appka02</li></a>
								<a href=""><li>appka03</li></a>
							</ul>
							<ul id="user_nav">
							<li><img src="public/mdrnze/imgs/default_avatar.jpg" alt="" class="photo photo_thumb"></li>
								<li id="user_dropdown">
									<span>@username</span>
									<div class="user_dropdown_indicator"></div>
								</li>
							</ur>
						</nav>
					</header>
					<section id="branding">
						<div class="logo">
							<h1>Yans</h1>
							<span class="desc">Yet another news system :)</span>
						</div>
					</section>
					<section class="main_width fragments_section">
						<div class="fragments">
							<div class="content">
								<div class="f1"></div><div class="f2"></div><div class="f3"></div><div class="f4"></div><div class="f5"></div><div class="f6"></div><div class="f7"></div><div class="f8"></div><div class="f9"></div><div class="f10"></div>
							</div>
						</div>
						<h2>Zawsze najświeższe informacje!</h2>
					</section>
		';
		return $outputHTML;
	}
	function footer() {
		$outputHTML = '</body></head>';
		return $outputHTML;
	}
}
