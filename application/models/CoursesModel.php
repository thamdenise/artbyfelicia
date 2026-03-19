<?php

class CoursesModel extends CI_Model
{
    public function __construct()
    {
        $this->tableName = "courses";
    }

    public function getNextSortOrder()
    {
        $this->db->select_max('sort_order');
        $row = $this->db->get($this->tableName)->row_array();
        $currentMax = isset($row['sort_order']) ? (int) $row['sort_order'] : 0;
        return $currentMax + 1;
    }

    public function updateSortOrder($orderedIds)
    {
        $this->db->trans_start();
        $position = 1;
        foreach ($orderedIds as $id) {
            $id = (int) $id;
            if ($id <= 0) {
                continue;
            }
            $this->db->where('id', $id)->update($this->tableName, ['sort_order' => $position]);
            $position++;
        }
        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    public function getCourseById($id)
    {
        $this->load->helper('url');
        $query = $this->db->query("SELECT * FROM courses WHERE id = $id");
        $blogLists = $query->result();
        return $blogLists;
    }

    public function editImageById($id,$image)
    {
        $this->load->helper('url');
        $query = $this->db->query("UPDATE courses SET image = '$image' WHERE id = $id");
        return $query;
    }

    public function editCourseById($id, $name, $description, $duration, $text_message)
    {
        $this->load->helper('url');
        $name = $this->db->escape($name);
        $description = $this->db->escape($description);
        $duration = $this->db->escape($duration);
        $text_message = $this->db->escape($text_message);
        
        $query = $this->db->query("UPDATE course SET name = $name, description = $description, duration = $duration, text_message = $text_message WHERE id = $id");
        return $query;
    }

    public function deleteCourseById($id)
    {
        $this->load->helper('url');
        $query = $this->db->query("DELETE FROM courses WHERE id = $id");
        return $query;
    }
}
