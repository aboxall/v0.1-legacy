<?php

class UserModel extends Model
{
	public function login($username, $password)
	{
		$username = $this->db->escape($username);
		$password = $this->db->hash($password);

		$login_sql = "
			select * from user_auth
			where username = '".$username."'
			and password = '".$password."'
		";

		$user_data = $this->db->query($login_sql);

		if (!$user_data)
		{
			throw new Exception('INVALID_USERNAME_PASSWORD');
		}

		return $user_data;
	}

	public function addRemember($rem_hash, $user_id, $expires)
	{
		$sql = "
			insert into user_remember (
				rem_hash,
				rem_expire,
				user_id,
				user_ip
			)
			values (
				'".$rem_hash."',
				'".$expires."',
				'".$user_id."',
				'".USER_IP."'
			)
		";

		return $this->db->exec($sql);
	}
}

// EOF
