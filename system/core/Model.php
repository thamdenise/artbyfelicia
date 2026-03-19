<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2019, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2019, British Columbia Institute of Technology (https://bcit.ca/)
 * @license	https://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Model Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/libraries/config.html
 */
class CI_Model
{
    /**
     * Class constructor
     *
     * @link	https://github.com/bcit-ci/CodeIgniter/issues/5332
     * @return	void
     */
    protected $tableName;
    public function __construct()
    {
      //cs comment, this one not working, timestap time not correct, check later
      //date_default_timezone_set('Asia/Singapore');
    }

    /**
     * __get magic
     *
     * Allows models to access CI's loaded classes using the same
     * syntax as controllers.
     *
     * @param	string	$key
     */
    public function __get($key)
    {
        // Debugging note:
        //	If you're here because you're getting an error message
        //	saying 'Undefined Property: system/core/Model.php', it's
        //	most likely a typo in your model code.
        return get_instance()->$key;
    }

    private function columns()
    {
        return $this->db->list_fields($this->tableName);
    }

    public function list($prms = [], $is_arr = true, $single = false, $order_by = "ASC", $order_id = "id", $joins = [])
    {
        $slc = $prms['select'] ?? [];
        

        // If 'not_all' is set, display 'is_deleted' = 0 condition
        if (isset($prms['not_all']) && $prms['not_all'] == 1) {
            $prms['is_deleted'] = 0;
        }

        $all_cols = $this->columns();
        $whr = [];

        // Apply WHERE conditions based on parameters
        foreach ($prms as $key => $value) {
            if (in_array($key, $all_cols)) {
                if (is_array($value)) {
                    $this->db->where_in($key, $value);
                } else {
                    if (strpos($value, "%") === false) {
                        $whr[$key] = $value;
                    }
                }
            }
        }

        // Apply WHERE clause
        if (!empty($whr)) {
            $this->db->where($whr);
        }

        // Apply SELECT clause
        if (!empty($slc)) {
            foreach ($slc as $slc_val) {
                $this->db->select($slc_val);
            }
        }

        // Apply JOINs
        if (!empty($joins)) {
            foreach ($joins as $join) {
                $this->db->join($join['table'], $join['condition'], isset($join['type']) ? $join['type'] : 'inner');
            }
        }

        // Apply ORDER BY
        $this->db->order_by($order_id, $order_by);

        // Fetch the results
        $abs_key = ($single) ? (($is_arr) ? "row_array" : "row") : (($is_arr) ? "result_array" : "result");

        return $this->db->get($this->tableName)->{$abs_key}();
    }

    // public function list($prms = [], $is_arr = true, $single = false,$order_by = "ASC",$order_id = "id")
    // {
    //     $slc = $prms['select']??[];
    //     $prms['is_deleted'] = $prms['is_deleted']??0;
    //     if (isset($prms['all'])&&$prms['all'] == 1) {
    //         unset($prms['is_deleted']);
    //     }
    //     $all_cols = $this->columns();
    //     $whr = [];

    //     foreach ($prms as $key=>$value) {
    //         if (in_array($key, $all_cols)) {
    //             if (is_array($value)) {
    //                 $this->db->where_in($key, $value);
    //             }
    //             else {
    //                 if(strpos($value,"%")===false){
    //                     $whr[$key] = $value;
    //                 }
    //             }
    //         }
    //     }


    //     if (!empty($whr)) {
    //         $this->db->where($whr);
    //     }
    //     if (!empty($slc)) {
    //         foreach ($slc as $slc_val) {
    //             $this->db->select($slc_val);
    //         }
    //     }

    //     //temp order desc
    //     $this->db->order_by($order_id, $order_by);


    //     $abs_key = ($single) ? (($is_arr) ? "row_array" : "row") : (($is_arr) ? "result_array" : "result");

    //     return $this->db->get($this->tableName)->{$abs_key}();
    // }

    public function getByID($id=null)
    {
        if(is_numeric($id)){
            $data = $this->db->get_where($this->tableName,array('id' => $id))->row_array();
            foreach($data as $key=>$row){
                $this->{$key} = $row;
            }
        }
        return $this;
    }
    public function getByKey($key)
    {
        return $this->db->from($this->tableName)->where("key",$key)->get()->row();
    }
    public function edit($prms, $default_key = "id", $set = [])
    {

        $all_cols = $this->columns();
        if (in_array("updated_at", $all_cols)) {
            $prms['updated_at'] = time();
        }
        $prms = array_intersect_key($prms, array_flip($all_cols));
        if(is_array($default_key)){
            foreach($default_key as $k){
                if(is_array($prms[$k])){
        			       $this->db->where_in($k, $prms[$k]);
            		}else{
            			   $this->db->where([$k=>$prms[$k]]);
            		}
                unset($prms[$k]);
            }
        }else{
            if(is_array($prms[$default_key])){
      			  $this->db->where_in($default_key, $prms[$default_key]);
        		}else{
        			$this->db->where([$default_key=>$prms[$default_key]]);
        		}
            unset($prms[$default_key]);
        }
        foreach($set as $s=>$v){
            $this->db->set($s, "{$s}+{$v}", FALSE);
        }
        $this->db->update($this->tableName, $prms);
        //cs comment, this will return int of affected updated row
        return $this->db->affected_rows();
        //cs comment, currently return int, if need return TRUE or FALSE use code below
        //return ($this->db->affected_rows() > 0) ? TRUE : FALSE;

    }

    public function store($prms)
    {
        $all_cols = $this->columns();
        if (in_array("created_at", $all_cols)) {
            $prms['created_at'] = time();
        }
        if (in_array("updated_at", $all_cols)) {
            $prms['updated_at'] = time();
        }
        if (in_array("uuid", $all_cols)) {
            $uuid = Ramsey\Uuid\Uuid::uuid4()->toString();
            $prms['uuid'] = $uuid;
        }
        $prms = array_intersect_key($prms, array_flip($all_cols));
        $this->db->insert($this->tableName, $prms);
        return $this->db->insert_id()??"";
    }

    public function bulkStore($prms)
    {
        $arr = [];
        foreach ($prms as $key=>$row) {
            $id = $this->store($row);
            $arr[$id] = $row;
        }
        return $arr;
    }

    public function remove($prms, $default_key = "id", $set = [])
    {

        $all_cols = $this->columns();

        $prms = array_intersect_key($prms, array_flip($all_cols));
        if(is_array($default_key)){
            foreach($default_key as $k){
                if(is_array($prms[$k])){
        			       $this->db->where_in($k, $prms[$k]);
            		}else{
            			   $this->db->where([$k=>$prms[$k]]);
            		}
                unset($prms[$k]);
            }
        }else{
            if(is_array($prms[$default_key])){
      			  $this->db->where_in($default_key, $prms[$default_key]);
        		}else{
        			$this->db->where([$default_key=>$prms[$default_key]]);
        		}
            unset($prms[$default_key]);
        }

        $this->db->delete($this->tableName, $prms);
        //cs comment, this will return int of affected updated row
        return $this->db->affected_rows();
        //cs comment, currently return int, if need return TRUE or FALSE use code below
        //return ($this->db->affected_rows() > 0) ? TRUE : FALSE;

    }

    public function removeAllTestData($default_key = "id") {
        $this->db->empty_table($this->tableName);      
        return $this->db->affected_rows();
      }



}
