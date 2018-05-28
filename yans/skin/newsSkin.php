<?php
require_once(YANS_ROOT_PATH.'lib/yansSkin.php');

class newsSkin extends yansSkin {
	function smallNewsCard($newsArray) {
		$outputHTML = '<div class="news_cards">';
		foreach($newsArray as $news) {
			$outputHTML.=<<<HTML
				<figure class="news_card_small">
				  <div class="background" style="background-image: url('{$news['background']}')">
						<div class="author_info">
							<img class="photo_mid" src="{$news['author']['avatar']}">
							<div class="author_username">
								<h3><a href="#">@{$news['author']['username']}</a></h3>
								<span>Nazwa grupy</span>
							</div>
						</div>
				  </div>
				  <figcaption><h2>{$news['title']}</h2>
						<span class="date">{$news['date']}</span>
				    <p>{$news['description']}</p>
						<a href="?app=news&id={$news['id']}" class="button button_transparent">Czytaj więcej</a>
				  </figcaption>
				</figure>
HTML;
		}
		$outputHTML .= '</div>';
		return $outputHTML;
	}

	function newsNotFound() {
		return 'nie ma newsa, tut mir leid';
	}

	function newsCard($news, $author, $comments) {
		$date = gmdate("H:i, d F Y", $news['date']);
		$outputHTML = <<<HTML
		<div class="yansBox">
			<div class="yansNews">
				<header style="background-image: url({$news['background']})">
				<div class="yansNewsInfo">
					<div class="author">
						<img src="{$author['avatar']}">
						<div class="author_info">
							<div class="author_username">
								<h3>@{$author['username']} &lt;{$author['email']}&gt;</h3>
								<span>{$author['firstname']} {$author['surname']} &ndash; {$date} &ndash;</span>
							</div>
						</div>
					</div>
				</div>
				<h3 class="title">{$news['title']}</h3>
				</header>
				<article>
					<div class="yansBox">
						<!--<div class="yansBox">
							<a href="?app=news&do=edit&id={$news['id']}"><span class="button button_main">Edytuj</span>
							</a><a href="?app=news&do=delete&id={$news['id']}"><span class="button button_main">Usuń</span>
							</a>
						</div>-->
						{$news['content']}
					</div>
				</article>
			</div>
		</div>
HTML;
		return $outputHTML;
	}

	function newsCreateOrEdit() {

	}
}
