<?php

class BlogPostModel extends CI_Model
{

    public function __construct()
    {
        $this->tableName = "blogpost";
    }

    public function getBlogPostLists()
    {
        $this->load->helper('url');

        $query = $this->db->query("SELECT * FROM blogpost order by id desc");
        $blogLists = $query->result();
        return $blogLists;
    }

    public function getBlogPostById($id)
    {
        $this->load->helper('url');
        $query = $this->db->query("SELECT * FROM blogpost WHERE id = $id");
        $blogLists = $query->result();
        return $blogLists;
    }

    public function getTotalBlog()
    {
        return $this->db->count_all("blogpost");
    }

    public function deleteBlogPostById($id)
    {
        $this->load->helper('url');
        $query = $this->db->query("DELETE FROM blogpost WHERE id = $id");
        return $query;
    }

    public function editImageById($id,$image)
    {
        $this->load->helper('url');
        $query = $this->db->query("UPDATE blogpost SET image = '$image' WHERE id = $id");
        return $query;
    }

    public function editBlogPostById($id, $image_alt, $meta_title, $meta_desc, $title, $author, $content)
    {
        $this->load->helper('url');
        $image_alt = $this->db->escape($image_alt);
        $meta_title = $this->db->escape($meta_title);
        $meta_desc = $this->db->escape($meta_desc);
        $title = $this->db->escape($title);
        $author = $this->db->escape($author);
        $content = $this->db->escape($content);
        
        $query = $this->db->query("UPDATE blogpost SET image_alt = $image_alt, meta_title = $meta_title, meta_desc = $meta_desc, title = $title, author = $author, content = $content WHERE id = $id");
        return $query;
    }
    

    // public function getBlogPostByTitle($title)
    // {
    //     $this->load->helper('url');
    //     $query = $this->db->query("SELECT * FROM blogpost WHERE SOUNDEX(title) = SOUNDEX('" . $this->db->escape_like_str($title) . "') LIMIT 1");
    //     $blogLists = $query->result();
    //     return $blogLists;
    // }

    // public function getBlogPostBySearchTerm($terms) 
    // {
    //     $this->load->helper('url');
    //     $query = $this->db->query("SELECT * FROM blogpost WHERE title like  '%" . $terms . "%'");
    //     $blogLists = $query->result();
    //     return $blogLists;
    // }
}