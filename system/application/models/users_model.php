<?php
class Users_model extends Model {
    function Users_Model(){
        parent::Model();
    }

    function count_users(){
        // Подсчёт общего количества пользователей в базе
        return $this->db->count_all_results('users');
    }

    function get_user_by_login($user_login){
        // Получение данных по логину (email) полльзователя
        $query = $this->db->get_where('users', array('users_login' => $user_login), 1);
        if ($query->num_rows()>0){
            return $query->row();
        } else {
            return null;
        }
    }

    function get_user_by_id($user_id){
        // Получение данных по логину (email) полльзователя
        $query = $this->db->get_where('users', array('users_id' => $user_id), 1);
        if ($query->num_rows()>0){
            return $query->row();
        } else {
            return null;
        }
    }

    function create_admin_user($new_user_data){
        // Создание нового (первого) пользователя администратора
        // Создаётся только один раз, если более нет пользователей в базе

        if($this->db->count_all_results('users')<1){
            $this->db->insert('users', $new_user_data);
        }
    }

    function get_all_users(){
        // Получение списка всех пользователей
        $this->db->order_by('users_isadmin', 'DESC');
        $this->db->order_by('users_login');
        $query = $this->db->get('users');
        if($query->num_rows()>0){
            return $query->result();
        } else {
            return null;
        }
    }

    function add_user($new_user_data){
        // Добавление нового пользователя
        $this->db->insert('users', $new_user_data);
    }

    function delete_user($user_id){
        // Удаление пользователя
        $this->db->where('users_id', $user_id);
        $this->db->delete('users');
    }

    function update_user($user_id, $user_data){
        // Обновление данных пользователя
        $this->db->where('users_id', $user_id);
        $this->db->update('users', $user_data);
    }
}
?>
