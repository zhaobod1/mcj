<?php

/*
	[UCenter] (C)2001-2009 Comsenz Inc.
	This is NOT a freeware, use is subject to license terms

	$Id: user.php 848 2008-12-08 05:43:39Z zhaoxiongfei $
*/

!defined('IN_UC') && exit('Access Denied');

class usermodel {

	var $db;
	var $base;

	function __construct(&$base) {
		$this->usermodel($base);
	}

	function usermodel(&$base) {
		$this->base = $base;
		$this->db = $base->db;
	}

	function get_user_by_uid($uid) {
		$arr = $this->db->fetch_first("SELECT * FROM ".UC_DBTABLEPRE."members WHERE uid='$uid'");
		return $arr;
	}

	function get_user_by_username($username) {
		$arr = $this->db->fetch_first("SELECT * FROM ".UC_DBTABLEPRE."members WHERE username='$username'");
		hlog2("get_user_by_username:");
		hlog2($arr);
		return $arr;
	}

	function check_username($username) {
		$guestexp = '\xA1\xA1|\xAC\xA3|^Guest|^\xD3\xCE\xBF\xCD|\xB9\x43\xAB\xC8';
		$len = strlen($username);
		if($len > 15 || $len < 3 || preg_match("/\s+|^c:\\con\\con|[%,\*\"\s\<\>\&]|$guestexp/is", $username)) {
			return FALSE;
		} else {
			return TRUE;
		}
	}

	function check_mergeuser($username) {
		$data = $this->db->result_first("SELECT count(*) FROM ".UC_DBTABLEPRE."mergemembers WHERE appid='".$this->base->app['appid']."' AND username='$username'");
		return $data;
	}

	function check_usernamecensor($username) {
		$_CACHE['badwords'] = $this->base->cache('badwords');
		$censorusername = $this->base->get_setting('censorusername');
		$censorusername = $censorusername['censorusername'];
		$censorexp = '/^('.str_replace(array('\\*', "\r\n", ' '), array('.*', '|', ''), preg_quote(($censorusername = trim($censorusername)), '/')).')$/i';
		$usernamereplaced = isset($_CACHE['badwords']['findpattern']) && !empty($_CACHE['badwords']['findpattern']) ? @preg_replace($_CACHE['badwords']['findpattern'], $_CACHE['badwords']['replace'], $username) : $username;
		if(($usernamereplaced != $username) || ($censorusername && preg_match($censorexp, $username))) {
			return FALSE;
		} else {
			return TRUE;
		}
	}

	function check_usernameexists($username) {
		$data = $this->db->result_first("SELECT username FROM ".UC_DBTABLEPRE."members WHERE username='$username'");
		return $data;
	}

	function check_emailformat($email) {
		return strlen($email) > 6 && preg_match("/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/", $email);
	}

	function check_emailaccess($email) {
		$setting = $this->base->get_setting(array('accessemail', 'censoremail'));
		$accessemail = $setting['accessemail'];
		$censoremail = $setting['censoremail'];
		$accessexp = '/('.str_replace("\r\n", '|', preg_quote(trim($accessemail), '/')).')$/i';
		$censorexp = '/('.str_replace("\r\n", '|', preg_quote(trim($censoremail), '/')).')$/i';
		if($accessemail || $censoremail) {
			if(($accessemail && !preg_match($accessexp, $email)) || ($censoremail && preg_match($censorexp, $email))) {
				return FALSE;
			} else {
				return TRUE;
			}
		} else {
			return TRUE;
		}
	}

	function check_emailexists($email, $username = '') {
		$sqladd = $username !== '' ? "AND username<>'$username'" : '';
		$email = $this->db->result_first("SELECT email FROM  ".UC_DBTABLEPRE."members WHERE email='$email' $sqladd");
		return $email;
	}

	/**
	 * 检测手机格式是否正确
	 * @param $phone
	 * @return bool
	 */
	function check_phoneformat($phone) {
		return strlen($phone) == 11 && !preg_match("^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+[0-9]{8})$", $phone);
	}

	/**
	 * 检测手机号码是否存在
	 * @param $phone
	 * @param string $username
	 * @return string 电话号码
	 */
	function check_phoneexists($phone, $username = '') {
		$sqladd = $username !== '' ? "AND username<>'$username'" : '';
		$phone=$this->db->result_first("SELECT phone FROM  ".UC_DBTABLEPRE."members WHERE phone='$phone' $sqladd");
		return $phone;
	}

	function check_login($username, $password, &$user) {
		$user = $this->get_user_by_username($username);
		if(empty($user['username'])) {
			return -1;
		} elseif($user['password'] != md5(md5($password).$user['salt'])) {
			return -2;
		}
		return $user['uid'];
	}

	function add_user($username, $password, $email, $uid = 0, $questionid = '', $answer = '') {
		$salt = substr(uniqid(rand()), -6);
		$password = md5(md5($password).$salt);
		$sqladd = $uid ? "uid='".intval($uid)."'," : '';
		$sqladd .= $questionid > 0 ? " secques='".$this->quescrypt($questionid, $answer)."'," : " secques='',";
		$this->db->query("INSERT INTO ".UC_DBTABLEPRE."members SET $sqladd username='$username', password='$password', email='$email', regip='".$this->base->onlineip."', regdate='".$this->base->time."', salt='$salt'");
		$uid = $this->db->insert_id();
		$this->db->query("INSERT INTO ".UC_DBTABLEPRE."memberfields SET uid='$uid'");
		return $uid;
	}

	function edit_user($username, $oldpw, $newpw, $email, $ignoreoldpw = 0, $questionid = '', $answer = '',$extra='') {
		$data = $this->db->fetch_first("SELECT username, uid, password, salt FROM ".UC_DBTABLEPRE."members WHERE username='$username'");

		if($ignoreoldpw) {
			$isprotected = $this->db->result_first("SELECT COUNT(*) FROM ".UC_DBTABLEPRE."protectedmembers WHERE uid = '$data[uid]'");
			if($isprotected) {
				return -8;
			}
		}

		if(!$ignoreoldpw && $data['password'] != md5(md5($oldpw).$data['salt'])) {
			return -1;
		}

		$sqladd = $newpw ? "password='".md5(md5($newpw).$data['salt'])."'" : '';
		$sqladd .= $email ? ($sqladd ? ',' : '')." email='$email'" : '';
		if ($extra) {
			foreach ($extra as $key=>$value) {
				if ($key=='password') {
					continue;
				}
				elseif($key=='mobile_phone') {
					$sqladd.=', phone="'.$value . '"';
				}
				else {
					$sqladd.=', '. $key . '="'.$value . '"';
				}

			}

			$sqladd=substr($sqladd,1);
		}
		if($questionid !== '') {
			if($questionid > 0) {
				$sqladd .= ($sqladd ? ',' : '')." secques='".$this->quescrypt($questionid, $answer)."'";
			} else {
				$sqladd .= ($sqladd ? ',' : '')." secques=''";
			}
		}
		if($sqladd || $emailadd) {
			$this->db->query("UPDATE ".UC_DBTABLEPRE."members SET $sqladd WHERE username='$username'");
			return $this->db->affected_rows();
		} else {
			return -7;
		}


	}

	function delete_user($uidsarr) {
		$uidsarr = (array)$uidsarr;
		$uids = $this->base->implode($uidsarr);
		//note 保护用户
		$arr = $this->db->fetch_all("SELECT uid FROM ".UC_DBTABLEPRE."protectedmembers WHERE uid IN ($uids)");
		$puids = array();
		foreach((array)$arr as $member) {
			$puids[] = $member['uid'];
		}
		$uids = $this->base->implode(array_diff($uidsarr, $puids));
		if($uids) {
			$this->db->query("DELETE FROM ".UC_DBTABLEPRE."members WHERE uid IN($uids)");
			$this->db->query("DELETE FROM ".UC_DBTABLEPRE."memberfields WHERE uid IN($uids)");
			//note 加到通知队列
			$this->base->load('note');
			$_ENV['note']->add('deleteuser', "ids=$uids");
			/* 火一五信息科技 huo15.com 解决同步不能同时通知的问题 日期：2017/5/8 */
			fixSync();
			/* 火一五信息科技 huo15.com 解决同步不能同时通知的问题 日期：2017/5/8 end */
			return $this->db->affected_rows();
		} else {
			return 0;
		}
	}

	function get_total_num($sqladd = '') {
		$data = $this->db->result_first("SELECT COUNT(*) FROM ".UC_DBTABLEPRE."members $sqladd");
		return $data;
	}

	function get_list($page, $ppp, $totalnum, $sqladd) {
		$start = $this->base->page_get_start($page, $ppp, $totalnum);
		$data = $this->db->fetch_all("SELECT * FROM ".UC_DBTABLEPRE."members $sqladd LIMIT $start, $ppp");
		return $data;
	}

	function name2id($usernamesarr) {
		$usernamesarr = uc_addslashes($usernamesarr, 1, TRUE);
		$usernames = $this->base->implode($usernamesarr);
		$query = $this->db->query("SELECT uid FROM ".UC_DBTABLEPRE."members WHERE username IN($usernames)");
		$arr = array();
		while($user = $this->db->fetch_array($query)) {
			$arr[] = $user['uid'];
		}
		return $arr;
	}

	function quescrypt($questionid, $answer) {
		return $questionid > 0 && $answer != '' ? substr(md5($answer.md5($questionid)), 16, 8) : '';
	}

}

?>