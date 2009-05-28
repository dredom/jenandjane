<?php
class FbHome extends BaseController {
	/**
	 * Handle the transaction control.
	 * @see jewel/BaseController#handle()
	 */
	public function handle() {
		$tpl = $this->template;

		// Testing profile stuff...
		if (isset($_REQUEST['profiletext'])) {
	  		$facebook->api_client->profile_setFBML($_REQUEST['profiletext'], $user);
	  		$tpl->fbProfileUrl = $facebook->get_facebook_url() . '/profile.php';
	  		return $this->template;
		}

		$count = $this->statCounter('fb');
		$tpl->count = $count;

		include 'appinclude.php';
		$user_details = $facebook->api_client->users_getInfo($user, array('last_name','first_name'));
		$tpl->firstName = $user_details[0]['first_name'];
//		$tpl->firstName = "Jo Jo";
		$friends_details = $facebook->api_client->friends_get($user, array('last_name','first_name'));
		$tpl->friendsCount = count($friends_details);
//		$tpl->friendsCount = 122;

		return $this->template;
	}


	private function statCounter($id) {
	 	$sql = 'SELECT count
	    	FROM stats
	    	WHERE id = :id';
	 	try {
		 	$pdo = $this->getPdo();
			$stmt = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$stmt->bindParam(':id', $id, PDO::PARAM_STR);
			$stmt->execute();
			$stats = $stmt-> fetchObject('Stats');
			$stmt->closeCursor();
		 	if (!$stats){
		 		$sql = 'INSERT into stats values(:id, 1); ';
		 		$stmt = $pdo->prepare($sql);
				$stmt->bindParam(':id', $id, PDO::PARAM_STR);
		 		$success = $stmt->execute();
		 		if ($success) {
		 			$stats->count = 1;
		 		} else {
		 			Logger::error("Insert stats failed!");
		 			$stats->count = 0;
		 		}
		 	} else {
		 		$sql = 'UPDATE stats
		 			set count = count + 1
		 			where id = :id; ';
		 		$stmt = $pdo->prepare($sql);
				$stmt->bindParam(':id', $id, PDO::PARAM_STR);
		 		$success = $stmt->execute();
		 		if ($success) {
		 			$stats->count += 1;
		 		} else {
		 			Logger::error("Update stats failed!");
		 		}
		 	}
	 	} catch (PDOException $e) {
		 	Logger::error($e->getMessage());
		 	return 0;
	 	}
	 	return $stats->count;
	 }

}
?>