<?php
	class Article implements JsonSerializable {
		private $url = "";
		private $headline = "";
		private $photo = "";
		private $story = "";
		private $success = true;

		public function set_url($url) {
			$this->url = $url;
		}

		public function get_url() {
			return $this->url;
		}

		public function set_story($story) {
			$this->story = $story;
		}

		public function get_story() {
			return $this->story;
		}

		public function set_headline($headline) {
			$this->headline = $headline;
		}

		public function get_headline() {
			return $this->headline;
		}

		public function set_photo($photo) {
			$this->photo = $photo;
		}

		public function get_photo() {
			return $this->photo;
		}

		public function set_success($success) {
			$this->success = $success;
		}

		public function get_success() {
			return $this->success;
		}

		public function jsonSerialize() {
        	return [
            	'article' => [
                	'url' => $this->url,
                	'headline' => $this->headline,
                	'story' => $this->story,
                	'photo' => $this->photo,
                	'success' => $this->success
            	]
        	];
    }
	}
?>