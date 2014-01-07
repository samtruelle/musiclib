<?php
	/*
	 * @author Antoine De Gieter
	 *
	 * Class Connection: modelises a user connection.
	 * Connections come from a user and have an IP address, a country and a date.
	 *
	 */
	class Connection {
		private $id;
		private $user;
		private $ip;
		private $date;
		private $country;
		private $os;
		private $browser;
		
		public function __construct( $id ) {
			$id || die( "Error: Wrong connection." );
			$this->db = $_SESSION['db'];
			$this->fetchData( $id );
		}

		public function fetchData( $id ) {
			$res = $this->db->query( "select * from connection where id = $id" );
			$connection = $res->fetch(PDO::FETCH_ASSOC);
			$this->id = $connection['id'];
			$this->user = new User( $connection['user'] );
			$this->ip = $connection['ip'];
			$this->date = new Timestamp( $connection['date'] );
			$this->country = $connection['country'];
			$this->os = $connection['os'];
			$this->browser = $connection['browser'];
		}

		/*
		 * ===
		 * MAGIC METHODS
		 * ===
		 */

		/**
		 * @Override
		 * toString method
		 */
		public function __toString() {
			return $this->ip;
		}

		/*
		 * ===
		 * GETTERS
		 * ===
		 */

		public function getId() {
			return $this->id;
		}

		public function getUser() {
			return $this->user;
		}

		public function getIp() {
			return $this->ip;
		}

		public function getdate() {
			return $this->date;
		}

		public function getCountry() {
			return $this->country;
		}

		public function getOs() {
			return $this->os;
		}

		public function getBrowser() {
			return $this->browser;
		}

		/* ===
		 * STATIC METHODS
		 * ===
		 */

public static function last( $number = 10 ) {
			$db = $_SESSION['db'];
			//$stmt = $db->prepare( "select id from connection order by date desc limit 0, ?;" );
			//$stmt->bindParam(1, $number, PDO::PARAM_INT);
			$stmt = $db->query( "select id from connection order by date desc limit 0, 10;" );
			$log = array();
			while ( $connection = $stmt->fetch(PDO::FETCH_NUM) )
				$log[] = new Connection( $connection[0] );
			$stmt->closeCursor();
			return $log;
		}
	}