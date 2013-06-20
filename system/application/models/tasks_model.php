<?php
class Tasks_model extends Model{
    function Tasks_model(){
        parent::Model();
    }

    function get_all_tasks($user_name = null, $only_open = 0){
        // Получение списка задач
        $this->db->select('tasks.*, u_for.users_id as for_uid, u_for.users_login as for_login, u_man.users_id as man_uid, u_man.users_login as man_login');
        $this->db->from('tasks');
        $this->db->join('users AS u_for', 'tasks.tasks_for_uid = u_for.users_id', 'left');
        $this->db->join('users AS u_man', 'tasks.tasks_master_uid = u_man.users_id', 'left');
        if($user_name!=null) {
            $this->db->where('u_for.users_login', $user_name);
        }
        $this->db->where('tasks_closed', $only_open);
        $this->db->order_by('tasks_end_date', 'DESC');
        $this->db->order_by('u_for.users_login');
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->result();
        } else {
            return null;
        }
    }

    function get_closed_tasks_for_dates($user_id, $start_date, $end_date){
        // Получение списка закрытых задач в указанный период дат
        $this->db->where('tasks_for_uid', $user_id);
        $this->db->where('tasks_closed', 1);
        $this->db->where('tasks_closed_date BETWEEN "'.$start_date.' 00:00:00" AND "'.$end_date.' 00:00:00"');
        $query = $this->db->get('tasks');
        if($query->num_rows()>0){
            return $query->result();
        } else {
            return null;
        }
    }

    function task_add($task_data){
        // Добавление новой задачи
        $this->db->insert('tasks', $task_data);
    }

    function get_task($task_id){
        // Получение данных задачи
        $query = $this->db->get_where('tasks', array('tasks_id' => $task_id));
        if($query->num_rows()>0){
            return $query->row();
        } else {
            return null;
        }
    }

    function task_update($task_id, $task_data){
        // Обновить задачу
        $this->db->where('tasks_id', $task_id);
        $this->db->update('tasks', $task_data);
    }

    function delete_task($task_id){
        // Удаление задачи
        $this->db->where('tasks_id', $task_id);
        $this->db->delete('tasks');
    }

    function delete_tasks_for_user($user_id){
        // Удаление всех задач для пользователя
        $this->db->where('tasks_for_uid', $user_id);
        $this->db->or_where('tasks_master_uid', $user_id);
        $this->db->delete('tasks');
    }
}
?>
