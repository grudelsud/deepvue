<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authorizer extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->load->helper('form');
		$this->load->view('authorizer_view');
	}

	function logout() 
	{
		$this->session->sess_destroy();
		redirect('/');
	}

	function facebook()
	{
		$this->load->library('facebook_connect');
			
		$data = array(
			'user'		=> $this->facebook_connect->user,
			'user_id'	=> $this->facebook_connect->user_id
		);

		// This is how to call a client API methods
		//
		// $this->facebook_connect->client->feed_registerTemplateBundle($one_line_story_templates, $short_story_templates, $full_story_template);
		// $this->facebook_connect->client->events_get($data['user_id']);

		$this->load->view('fbtest', $data);
	}

	function twitter()
	{
		// load keys from config file
		$consumer_key = $this->config->item('consumer_key');
		$consumer_key_secret = $this->config->item('consumer_key_secret');
		
		// when coming back from authentication we need to store the auth token in a get parameter to make everything work
		parse_str($_SERVER['QUERY_STRING'], $_GET);

		$exec = 1;
		log_message('debug', 'tw-'.$exec++.' - get '.var_export( $_GET, TRUE ));

		$tokens['access_token'] = NULL;
		$tokens['access_token_secret'] = NULL;

		// load the access tokens from session, if present
		$oauth_tokens = $this->session->userdata('twitter_oauth_tokens');

		if ( $oauth_tokens !== FALSE ) $tokens = $oauth_tokens;

		$this->load->library('twitter');

		// go and get authentication from twitter
		$auth = $this->twitter->oauth($consumer_key, $consumer_key_secret, $tokens['access_token'], $tokens['access_token_secret']);
		log_message('debug', 'tw-'.$exec++.' - auth '.var_export( $auth, TRUE )." tokens ".var_export( $tokens, TRUE ));
		
		if ( isset($auth['access_token']) && isset($auth['access_token_secret']) )
		{
			// save the access tokens
			$this->session->set_userdata('twitter_oauth_tokens', $auth);
			log_message('debug', 'tw-'.$exec++.' - if isset auth');
			
			if ( isset($_GET['oauth_token']) )
			{
				log_message('debug', 'tw-'.$exec++.' - redirect /authorizer/twitter');
				redirect('/authorizer/twitter');
				return;
			}
		}

		$credentials = $this->twitter->call('account/verify_credentials');
		log_message('debug', 'tw-'.$exec++.' - verify '.var_export( $credentials, TRUE ));
		$this->session->set_userdata('twitter_credentials', json_encode( $credentials ) );
		redirect('/');
		return;
		
		// This is where  you can call a method.
		// $this->twitter->call('statuses/update', array('status' => 'hey @elliothaughin I\'m testing your CI wrapper for twitter, nice work!'));
		
		// Here's the calls you can make now.
		// Sexy!

		/*
		 $this->twitter->call('statuses/friends_timeline');
		 $this->twitter->search('search', array('q' => 'elliot'));
		 $this->twitter->search('trends');
		 $this->twitter->search('trends/current');
		 $this->twitter->search('trends/daily');
		 $this->twitter->search('trends/weekly');
		 $this->twitter->call('statuses/public_timeline');
		 $this->twitter->call('statuses/friends_timeline');
		 $this->twitter->call('statuses/user_timeline');
		 $this->twitter->call('statuses/show', array('id' => 1234));
		 $this->twitter->call('direct_messages');
		 $this->twitter->call('statuses/update', array('status' => 'If this tweet appears, oAuth is working!'));
		 $this->twitter->call('statuses/destroy', array('id' => 1234));
		 $this->twitter->call('users/show', array('id' => 'elliothaughin'));
		 $this->twitter->call('statuses/friends', array('id' => 'elliothaughin'));
		 $this->twitter->call('statuses/followers', array('id' => 'elliothaughin'));
		 $this->twitter->call('direct_messages');
		 $this->twitter->call('direct_messages/sent');
		 $this->twitter->call('direct_messages/new', array('user' => 'jamierumbelow', 'text' => 'This is a library test. Ignore'));
		 $this->twitter->call('direct_messages/destroy', array('id' => 123));
		 $this->twitter->call('friendships/create', array('id' => 'elliothaughin'));
		 $this->twitter->call('friendships/destroy', array('id' => 123));
		 $this->twitter->call('friendships/exists', array('user_a' => 'elliothaughin', 'user_b' => 'jamierumbelow'));
		 $this->twitter->call('account/verify_credentials');
		 $this->twitter->call('account/rate_limit_status');
		 $this->twitter->call('account/rate_limit_status');
		 $this->twitter->call('account/update_delivery_device', array('device' => 'none'));
		 $this->twitter->call('account/update_profile_colors', array('profile_text_color' => '666666'));
		 $this->twitter->call('help/test');
		 */
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/home.php */