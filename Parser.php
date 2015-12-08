	<?php
	class Parser {

		private $article;
		private $xpath;

		function __construct($url) {
			$this->article = new Article();
			$this->article->set_url($url);
		}

		function fetch_article() {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $this->article->get_url());
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			$data = curl_exec($ch);
			if(curl_errno($ch)){
				$this->article->set_success(false);
			} else {
				$doc = DOMDocument::loadHTML($data);
				$this->xpath = new DOMXPath($doc);
				$this->parse_headline($data);
				$this->parse_photo($data);
				$this->parse_story($data);	
			}
			curl_close($ch);
			return $this->article;
		}

		private function parse_headline($data) {
			$node = $this->xpath->query('//h1[@class="pg-headline"]/text()')->item(0);
			if (!is_null($node)) {
				$this->article->set_headline($node->textContent);
			} else {
				$this->article->set_success(false);
			}
		}

		private function parse_photo($data) {
			$node = $this->xpath->query('//article/meta[@itemprop="image"]')->item(0);
			if (!is_null($node)) {
				$this->article->set_photo($node->getAttribute('content'));
			}
		}

		private function parse_story($data) {
			$nodes = $this->xpath->query('//p[@class="zn-body__paragraph"]');
			foreach ($nodes as $node) {
				if (!is_null($node)) {
					$content = strip_tags($node->textContent);
					$this->article->set_story($this->article->get_story() . $content);
				} else {
					$this->article->set_success(false);
				}	
			}	
		}
	}
	?>
