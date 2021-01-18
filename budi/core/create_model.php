<?php 

$string = "<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class " . $m . " extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        \$this->db->_protect_identifiers=false;
    }

    function get_by_id(\$id)
    {
        \$this->db->where('$pk', \$id);
        return \$this->db->get('$table_name')->row();
    }
    
    function total_rows(\$key = NULL, \$param=NULL) {
        \$q = \$this->db->select('*')
                  ->from('$table_name');";

$string .= "\n\tif (isset(\$param['kolom']) && \$param['kolom']!=\"\") {
            \$q = \$q->where(\"(\".\$param['kolom'].\" LIKE '%\".\$key.\"%')\",NULL,FALSE);
          }";

$string .= "\n\treturn \$this->db->count_all_results();
    }

    function get_limit_data(\$limit, \$start = 0, \$key = NULL, \$param=NULL, \$order = \"DESC\") {
        \$q = \$this->db->select('*')
                  ->from('$table_name')
                  ->limit(\$limit, \$start)
                  ->order_by(\$param['kolom'] ,\$order);";

$string .= "\n\tif (isset(\$param['kolom']) && \$param['kolom']!=\"\") {
            \$q = \$q->where(\"(\".\$param['kolom'].\" LIKE '%\".\$key.\"%')\",NULL,FALSE);
          }"; 
$string .= "\n\treturn \$this->db->get()->result();
    }


    function insert(\$data)
    {
        \$this->db->insert('$table_name', \$data);
    }

    function update(\$id, \$data)
    {
        \$this->db->where('$pk', \$id);
        \$this->db->update('$table_name', \$data);
    }

    function delete(\$id)
    {
        \$this->db->where('$pk', \$id);
        \$this->db->delete('$table_name');
    }

    function nourut()
    {
        \$pre = getconfig(\"pre\");
        \$pre = (\$pre!=\"\"?\$pre:\"yk\");
        \$no = \$this->db->query(\"select MAX(RIGHT($pk,3)) as $pk from $table_name limit 1\");
        \$autoId = (int) \$no->row()->$pk;
        \$autoId++;
        \$NewID = \$pre.\"\".sprintf(\"%03s\",\$autoId);
        return \$NewID;
    }

}
";

$hasil_model = createFile($string, $target."models/" . $m_file);

?>