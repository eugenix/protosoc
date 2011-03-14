<?php
interface IAPIProvider
{
	public function auth($login, $pass);
	
	public function getOnlineFriends();
	
	public function getFriends();
	
	public function postStream($message);
	
	public function getFriendsFeed();
				 
}