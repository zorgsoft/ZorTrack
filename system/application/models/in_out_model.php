<?php
class In_out_model extends Model{
    function In_out_model(){
        parent::Model();
    }

    function get_in_out($user_id, $on_date){
        // Получение записи прихода/ухода для пользователя
        $this->db->where('in_out_user_id', $user_id);
        $this->db->where('in_out_date', date('Y-m-d', strtotime($on_date)));
        $query = $this->db->get('in_out', 1);
        if($query->num_rows()>0){
            return $query->row();
        } else {
            return null;
        }
    }

    function save_date($in_out_data){
        // Обновление или добавление даты прихода/ухода
        //$this->db->where('in_out_user_id', $in_out_data['in_out_user_id']);
        //$this->db->where('in_out_date', $in_out_data['in_out_date']);
        if($this->get_in_out($in_out_data['in_out_user_id'], $in_out_data['in_out_date'])!=null){
            $this->db->where('in_out_user_id', $in_out_data['in_out_user_id']);
            $this->db->where('in_out_date', $in_out_data['in_out_date']);
            $this->db->update('in_out', $in_out_data);
        } else {
            $this->db->insert('in_out', $in_out_data);
        }
    }

    function get_work_dates($user_id, $start_date, $end_date){
        // Получение списка закрытых задач в указанный период дат
        $this->db->where('in_out_user_id', $user_id);
        $this->db->where('in_out_date BETWEEN "'.$start_date.'" AND "'.$end_date.'"');
        $query = $this->db->get('in_out');
        if($query->num_rows()>0){
            return $query->result();
        } else {
            return null;
        }
    }

}
?>
