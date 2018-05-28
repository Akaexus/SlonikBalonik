<?php
require_once(YANS_ROOT_PATH.'lib/yansSkin.php');

class frontPageSkin extends yansSkin {
	function brandingExtended() {
		$outputHTML = '					<section id="branding_extended">
								<div class="logo">
									<h1>Yans</h1>
									<span class="desc">Yet another news system :)</span>
								</div>
							</section>';
		return $outputHTML;
	}
	function frontPage() {
		$outputHTML = '
		<section class="main_width fragments_section">
			<div class="fragments">
				<div class="content">
					<div class="f1"></div><div class="f2"></div><div class="f3"></div><div class="f4"></div><div class="f5"></div><div class="f6"></div><div class="f7"></div><div class="f8"></div><div class="f9"></div><div class="f10"></div>
				</div>
			</div>
			<h2>Zawsze najświeższe informacje!</h2>
		</section>';
		return $outputHTML;
	}
	function statistics() {//TODO: zrobic staty
		$outputHTML = '
			<section class="statistics_section">
				<div class="statistics">
					<div class="stat">
						<div class="number">'.rand(100, 9999).'</div>
						<div class="desc">Dni działania serwisu</div>
					</div>
					<div class="stat">
						<div class="number">'.rand(100, 9999).'</div>
						<div class="desc">Nowych użytkowników</div>
					</div>
					<div class="stat">
						<div class="number">'.rand(100, 9999).'</div>
						<div class="desc">Komentarzy</div>
					</div>
					<div class="stat">
						<div class="number">'.rand(100, 99999).'</div>
						<div class="desc">Odwiedzi</div>
					</div>
				</div>
			</section>
		';
		return $outputHTML;
	}
	function newsLink() {
		$outputHTML = '
			<section class="newsLink">
				goto newspage <a href="index.php?app=news">go go go power rangers</a>
				<br>
				<br>
				<br>
				//TODO: zrobic tu ladnie
				<br>
				<br>
				<br>
				<br>
				<br>
			</section>
		';
		return $outputHTML;
	}
}
