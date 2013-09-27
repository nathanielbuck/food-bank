<?php

/**
 * User
 *
 * @package User
 */
class User extends ActiveRecord\Model {

    /**
     * add_user() create a record in the user table.
     *
     * @param array $options
     * @result int insert_id()
     */
    protected function add_user($options = array())
    {
        $required = array('email', 'password');
        if (!$this->_required($required, $options))
        {
            return FALSE;
        }

        $this->db->insert('user', $options);

        return $this->db->insert_id();
    }

    /**
     * add_user() create a record in the user table.
     *
     * @param array $options
     * @result int insert_id()
     */
    protected function update_user($options = array())
    {
        $required = array('id');
        if (!$this->_required($required, $options))
        {
            return FALSE;
        }

        if (isset($options['email']))
        {
            $this->db->set('email', $options['email']);
        }

        if (isset($options['password']))
        {
            $this->db->set('password', $options['password']);
        }

        $this->db->update('user');

        return $this->db->affected_rows();
    }

    /**
     * get_users()
     *
     */
    protected function get_user($options = array())
    {
        // Qualification
        if (isset($options['id']))
        {
            $this->db->where('id', $options['id']);
        }
        if (isset($options['email']))
        {
            $this->db->where('email', $options['email']);
        }
        if (isset($options['password']))
        {
            $this->db->where('password', $options['password']);
        }

        // Limit / Offset
        if (isset($options['limit']))
        {
            $this->db->limit($options['limit'], $options['offset']);
        }
        else if (isset($options['limit']))
        {
            $this->db->limit($options['limit']);
        }

        // Sort
        if (isset($options['sort_by']) && isset($options['sort_direction']))
        {
            $this->db->limit($options['sort_by'], $options['sort_direction']);
        }

        if (isset($options['id']) || isset($options['email']))
        {
            return $query->row(0);
        }

        return $qurey->result();
        
    }

    // Utility Methods
    function _required($required, $data)
    {
        foreach ($required as $field)
        {
            if (!isset($data[$field]))
            {
                return FALSE;
            }
        }

        return TRUE;
    }
}

?>
