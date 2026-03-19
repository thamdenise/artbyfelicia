<?php

class GalleryModel extends CI_Model
{
    protected $tableName;

    public function __construct()
    {
        parent::__construct();
        $this->tableName = "gallery";
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
}
