<?php
/**
 * This file is part of RedFruits.
 * 
 * RedFruits is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * RedFruits is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with RedFruits.  If not, see <http://www.gnu.org/licenses/>.
 */
 
/**
 * RedFruits :: ADWPPost
 *
 * 2009-2010 (c) arohadigital
 */
require_once(dirname(dirname(__FILE__)).'/db/ADDAO.class.php');

class ADWPPost extends ADDAO
{
	protected $ID; //' => [ <post id> ] //Are you updating an existing post?
	protected $menuOrder; //' => [ <order> ] //If new post is a page, sets the order should it appear in the tabs.
	protected $commentStatus; //' => [ 'closed' | 'open' ] // 'closed' means no comments.
	protected $pingStatus; //' => [ 'closed' | 'open' ] // 'closed' means pingbacks or trackbacks turned off
	protected $pinged; //' => [ ? ] //?
	protected $postAuthor; //' => [ <user ID> ] //The user ID number of the author.
	protected $postCategory; //' => [ array(<category id>, <...>) ] //Add some categories.
	protected $postContent; //' => [ <the text of the post> ] //The full text of the post.
	protected $postDate; //' => [ Y-m-d H:i:s ] //The time post was made.
	protected $postDateGmt; //' => [ Y-m-d H:i:s ] //The time post was made, in GMT.
	protected $postExcerpt; //' => [ <an excerpt> ] //For all your post excerpt needs.
	protected $postName; //' => [ <the name> ] // The name (slug) for your post
	protected $postParent; //' => [ <post ID> ] //Sets the parent of the new post.
	protected $postPassword; //' => [ ? ] //password for post?
	protected $postStatus; //' => [ 'draft' | 'publish' | 'pending' ] //Set the status of the new post. 
	protected $postTitle; //' => [ <the title> ] //The title of your post.
	protected $postType; //' => [ 'post' | 'page' ] //Sometimes you want to post a page.
	protected $tagsInput; //' => [ '<tag>, <tag>, <...>' ] //For tags.
	protected $toPing; //' => [ ? ] //?

	function __construct($title = '', $content = '', $type = 'post')
	{
		parent::__construct();
		$this->postTitle = $title;
		$this->postContent = $content;
		$this->postType = $type;
	}

	/**
	 * Gets all the posts
	 *
	function getAllThePost()
	//obtenerTodosLosPost()
	{
		$sql = 'select ID, post_title from '.$this->prefix.'posts where post_type=\'products\'';
		return $this->get_results($sql);
	}

	/**
	 * Returns al the post with no asociated product
	 * adding the post with the id
	 *
	function getAllthePostWithNoProduct($post_id)
	//obtenerTodosLosPostSinProducto($post_id)
	{
		$sql = 'select ID, post_title from '.$this->prefix.'posts where post_type=\'products\' and
			ID not in (select post_id from '.$this->prefix.'adc_products where 
			post_id <> :post_id) and post_status != \'auto-draft\'';
		$params = array(
			'post_id' => $post_id,
		);
		return $this->get_results($sql, $params);
	}*/

	function create()
	{
		$post = array(
		  //'ID' => [ <post id> ] //Are you updating an existing post?
		  //'menu_order' => [ <order> ] //If new post is a page, sets the order should it appear in the tabs.
		  'comment_status' => $this->commentStatus, //[ 'closed' | 'open' ] // 'closed' means no comments.
		  //'ping_status' => [ 'closed' | 'open' ] // 'closed' means pingbacks or trackbacks turned off
		  //'pinged' => [ ? ] //?
		  //'post_author' => [ <user ID> ] //The user ID number of the author.
		  //'post_category' => [ array(<category id>, <...>) ] //Add some categories.
		  'post_content' => $this->postContent, //[ <the text of the post> ] //The full text of the post.
		  //'post_date' => [ Y-m-d H:i:s ] //The time post was made.
		  //'post_date_gmt' => [ Y-m-d H:i:s ] //The time post was made, in GMT.
		  //'post_excerpt' => [ <an excerpt> ] //For all your post excerpt needs.
		  //'post_name' => [ <the namWordpressPoste> ] // The name (slug) for your post
		  //'post_parent' => [ <post ID> ] //Sets the parent of the new post.
		  //'post_password' => [ ? ] //password for post?
		  'post_status' => $this->postStatus, //[ 'draft' | 'publish' | 'pending' ] //Set the status of the new post. 
		  'post_title' => $this->postTitle, //The title of your post.
		  'post_type' => $this->postType, //[ 'post' | 'page' ] //Sometimes you want to post a page.
		  //'tags_input' => [ '<tag>, <tag>, <...>' ] //For tags.
		  //'to_ping' => [ ? ] //?
		);
		$this->ID = wp_insert_post($post);
		return $this->ID;
	}

	/**
	 * Returns The post's firts image's url
	 * This image will be the first image in the post's gallery or the firts image attached to the post
	 *
	 * @param integer $postId post identigier
	 * @param string $size thumbnail (by default), medium, large oder full or array(width, height)
	 * @rturn the url
	 */
	public static function getFirstImageFromPost($postId, $size = 'thumbnail')
	{
		$attachments = get_children( array(
			'post_parent'    => $postId,
			'post_type'      => 'attachment',
			'numberposts'    => 1, // show all -1
			'post_status'    => 'inherit',
			'post_mime_type' => 'image',
			'order'          => 'ASC',
			'orderby'        => 'menu_order ASC'
			));
		foreach ($attachments as $attachment_id => $attachment)
			return wp_get_attachment_image($attachment_id, $size);
			//return wp_get_attachment_link($attachment_id);
	}

	public static function getThumbnailFromPost($postId)
	{
		return ADWPPost::getFirstImageFromPost($postId, 'thumbnail');
	}

	public function getPermalink($postId)
	{
		return get_permalink($postId);
	}
	
	public function getExcerpt($postId)
	{
		$post = get_post($postId);
		return $post->post_excerpt;
	}

	//[ 'closed' | 'open' ] // 'closed' means no comments.	
	public function setCommentStatus($commentStatus)
	{
		$this->commentStatus = $commentStatus;
	}

	public function getCommentStatus()
	{
		return $this->commentStatus;
	}

	public function getTitle()
	{
		return $this->postTitle;
	}

	public function setTitle($title)
	{
		$this->postTitle = $title;
	}

	public function getContent()
	{
		return $this->postContent;
	}

	public function setContent($content)
	{
		$this->post_content = $content;
	}
	
	public function getPostType()
	{
		return $this->postType;
	}

	public function setPostType($type)
	{
		$this->postType = $type;
	}

	public function getPostStatus()
	{
		return $this->postStatus;
	}

	public function setPostStatus($status)
	{
		$this->postStatus = $status;
	}		

	public function getGuid($id = '')
	{
		if (strlen($id) == 0) $id = $this->ID;
		$sql = 'select guid from '.$this->prefix.'posts where ID = :ID';
		$params = array (
			'ID' => $id,
		);
		return $this->get_var($sql, $params);
	}
}
?>
