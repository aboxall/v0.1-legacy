<?php

class IndexModel extends Model
{
	public function test()
	{
		$sql = 'select * from test';

		return $this->db->query($sql);
	}
}

// EOF
