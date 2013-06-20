<?php
class Login extends Controller{
    function Login(){
        parent::Controller();
    }

    function index() {
        // Логин пользователем
        $this->load->model('Users_model');

        $this->form_validation->set_rules('login', 'Логин/E-Mail', 'trim|required|valid_email|xss_clean');
        $this->form_validation->set_rules('password', 'Пароль', 'trim|required|min_length[4]|max_length[126]|xss_clean');

        // Проверяем есть ли вобще пользователи в базе, если есть то выводим окно логина
        if ($this->Users_model->count_users() > 0) {
            $data['message'] = 'Управление задачами:';
            $data['error_message'] = '';
            // Если что-то ввели не в том формате или при первом отображении формы
            if ($this->form_validation->run() == FALSE) {
                $this->parser->parse('login', $data);
            } else {
                // Иначе проверяем введёный логин и пароль
                $user_data = $this->Users_model->get_user_by_login($this->input->post('login'));
                $user_input_password = $this->input->post('password');
                $user_input_password = dohash($user_input_password, 'md5');
                if ($user_data == null) {
                    $data['error_message'] = 'Логин или пароль неверны Юзверь ненайден.';
                    $this->parser->parse('login', $data);
                } else {
                    if ($user_input_password != $user_data->users_password) {
                        $data['error_message'] = 'Логин или пароль неверны.';
                        $this->parser->parse('login', $data);
                    } else {
                        $this->session->set_userdata($user_data);
                        $this->session->set_userdata('is_loged', 1);
                        redirect(base_url());
                    }
                }
            }
        } else {
            // Если пользователей в базе нет, то создаём нового
            $data['message'] = 'Создание нового главного пользователя:';
            $data['error_message'] = '';
            if ($this->form_validation->run() == FALSE) {
                $this->parser->parse('login', $data);
            } else {
                $new_admin['users_login'] = $this->input->post('login');
                $new_admin['users_password'] = dohash($this->input->post('password'), 'md5');
                $new_admin['users_name'] = 'Admin';
                $new_admin['users_isadmin'] = 1;
                $this->Users_model->create_admin_user($new_admin);
                redirect(base_url());
            }
        }
    }
}
?>
