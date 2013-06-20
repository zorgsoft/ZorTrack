<?php

class Main extends Controller {

    function Main() {
        parent::Controller();
        if ($this->check_login() != TRUE) {
            redirect(base_url().'login');
            EXIT;
        }
        $this->load->model('In_out_model');
        $this->in_out_data = $this->In_out_model->get_in_out($this->session->userdata('users_id'), date('Y-m-d'));
    }

    function check_login() {
        // Проверка прав для входа в админпанель
        if ($this->session->userdata('is_loged') == '1') {
            return true;
        } else {
            return false;
        }
    }

    function index() {
        $data['l_user_login'] = $this->session->userdata('users_login');
        $data['l_user_name'] = $this->session->userdata('users_name');

        $data['title'] = '<img src="' . base_url() . 'images/icons/32x32/home.png"  border="0"> Управление задачами';
        $this->load->model('Tasks_model');
        if ($this->session->userdata('users_isadmin') == 1) {
            $for_user = null;
        } else {
            $for_user = $this->session->userdata('users_login');
        }
        $data['active_tasks'] = $this->Tasks_model->get_all_tasks($for_user);
        $data['closed_tasks'] = $this->Tasks_model->get_all_tasks($for_user, 1);
        $data['header_tpl'] = $this->parser->parse('header', $data, TRUE);
        $data['bottom_tpl'] = $this->parser->parse('bottom', $data, TRUE);
        $data['left_tpl'] = $this->parser->parse('left', $data, TRUE);
        $this->parser->parse('main', $data);
    }

    function task_add() {
        // Добавление новой задачи
        $data['l_user_login'] = $this->session->userdata('users_login');
        $data['l_user_name'] = $this->session->userdata('users_name');
        $data['title'] = '<img src="' . base_url() . 'images/icons/32x32/full-time.png"  border="0"> Добавление новой задачи';

        $this->load->model('Users_model');
        if ($this->session->userdata('users_isadmin') == 1) {
            $data['users_list'] = $this->Users_model->get_all_users();
        } else {
            $data['users_list'] = null;
        }

        $data['header_tpl'] = $this->parser->parse('header', $data, TRUE);
        $data['bottom_tpl'] = $this->parser->parse('bottom', $data, TRUE);
        $data['left_tpl'] = $this->parser->parse('left', $data, TRUE);

        $this->form_validation->set_rules('task_name', 'Название задачи', 'trim|required|min_length[1]|max_length[256]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $this->parser->parse('task_add', $data);
        } else {
            $this->load->model('Tasks_model');
            $new_task_data['tasks_master_uid'] = $this->session->userdata('users_id');
            $new_task_data['tasks_for_uid'] = $this->input->post('task_for');
            $new_task_data['tasks_title'] = $this->input->post('task_name');
            $new_task_data['tasks_description'] = $this->input->post('task_description');
            $new_task_data['tasks_start_date'] = date('Y-m-d', strtotime($this->input->post('date_start'))) . ' ' . $this->input->post('start_time');
            $new_task_data['tasks_end_date'] = date('Y-m-d', strtotime($this->input->post('date_end'))) . ' ' . $this->input->post('end_time');
            $this->Tasks_model->task_add($new_task_data);
            redirect(base_url());
        }
    }

    function task_edit($task_id) {
        // Редактирование задачи
        $data['l_user_login'] = $this->session->userdata('users_login');
        $data['l_user_name'] = $this->session->userdata('users_name');
        $data['title'] = '<img src="' . base_url() . 'images/icons/32x32/pencil.png"  border="0"> Редактирование задачи';

        $this->load->model('Users_model');
        if ($this->session->userdata('users_isadmin') == 1) {
            $data['users_list'] = $this->Users_model->get_all_users();
        } else {
            $data['users_list'] = null;
        }

        $data['header_tpl'] = $this->parser->parse('header', $data, TRUE);
        $data['bottom_tpl'] = $this->parser->parse('bottom', $data, TRUE);
        $data['left_tpl'] = $this->parser->parse('left', $data, TRUE);

        $this->load->model('Tasks_model');
        $task_data = $this->Tasks_model->get_task($task_id);
        if ($task_data == null) {
            $data['title'] = '<img src="' . base_url() . 'images/icons/32x32/busy.png"  border="0"> Ошибка!   ';
            $data['error_message'] = 'Такая задача не найденна.';
            $this->parser->parse('errors', $data);
        } else {
            if ($this->session->userdata('users_isadmin') == 1 or $task_data->tasks_master_uid == $this->session->userdata('users_id')) {
                $this->form_validation->set_rules('task_name', 'Название задачи', 'trim|required|min_length[1]|max_length[256]|xss_clean');
                $this->form_validation->set_rules('date_start', 'Дата начала', 'trim|required|min_length[1]|max_length[11]|xss_clean');
                $this->form_validation->set_rules('date_end', 'Планируемая дата окончания', 'trim|required|min_length[1]|max_length[11]|xss_clean');
                $this->form_validation->set_rules('start_time', 'Время начала', 'trim|required|min_length[1]|max_length[6]|xss_clean');
                $this->form_validation->set_rules('end_time', 'Время окончания', 'trim|required|min_length[1]|max_length[6]|xss_clean');

                $data['tasks_id'] = $task_data->tasks_id;
                $data['tasks_for_uid'] = $task_data->tasks_for_uid;
                $data['tasks_title'] = $task_data->tasks_title;
                $data['tasks_description'] = $task_data->tasks_description;
                $data['tasks_start_date'] = $task_data->tasks_start_date;
                $data['tasks_end_date'] = $task_data->tasks_end_date;

                if ($this->form_validation->run() == FALSE) {
                    $this->parser->parse('task_edit', $data);
                } else {
                    //$new_task_data['tasks_master_uid'] = $this->session->userdata('users_id');
                    $new_task_data['tasks_for_uid'] = $this->input->post('task_for');
                    $new_task_data['tasks_title'] = $this->input->post('task_name');
                    $new_task_data['tasks_description'] = $this->input->post('task_description');
                    $new_task_data['tasks_start_date'] = date('Y-m-d', strtotime($this->input->post('date_start'))) . ' ' . $this->input->post('start_time');
                    $new_task_data['tasks_end_date'] = date('Y-m-d', strtotime($this->input->post('date_end'))) . ' ' . $this->input->post('end_time');
                    $this->Tasks_model->task_update($task_id, $new_task_data);
                    redirect(base_url());
                }
            } else {
                $data['title'] = '<img src="' . base_url() . 'images/icons/32x32/busy.png"  border="0"> Ошибка!   ';
                $data['error_message'] = 'Эта задача созданна не вами или не для вас.';
                $this->parser->parse('errors', $data);
            }
        }
    }

    function task($task_id) {
        // Просмот задачи
        $data['l_user_login'] = $this->session->userdata('users_login');
        $data['l_user_name'] = $this->session->userdata('users_name');
        $data['title'] = '<img src="' . base_url() . 'images/icons/32x32/date.png"  border="0"> Просмотр задачи';

        $this->load->model('Users_model');
        if ($this->session->userdata('users_isadmin') == 1) {
            $data['users_list'] = $this->Users_model->get_all_users();
        } else {
            $data['users_list'] = null;
        }

        $data['header_tpl'] = $this->parser->parse('header', $data, TRUE);
        $data['bottom_tpl'] = $this->parser->parse('bottom', $data, TRUE);
        $data['left_tpl'] = $this->parser->parse('left', $data, TRUE);

        $this->load->model('Tasks_model');
        $task_data = $this->Tasks_model->get_task($task_id);
        if ($task_data == null) {
            $data['title'] = '<img src="' . base_url() . 'images/icons/32x32/busy.png"  border="0"> Ошибка!   ';
            $data['error_message'] = 'Такая задача не найденна.';
            $this->parser->parse('errors', $data);
        } else {
            if ($this->session->userdata('users_isadmin') == 1 or $task_data->tasks_master_uid == $this->session->userdata('users_id') or $task_data->tasks_for_uid == $this->session->userdata('users_id')) {

                $data['tasks_id'] = $task_data->tasks_id;
                $data['tasks_for_uid'] = $task_data->tasks_for_uid;
                $data['tasks_title'] = $task_data->tasks_title;
                $data['tasks_description'] = $task_data->tasks_description;
                $data['tasks_start_date'] = $task_data->tasks_start_date;
                $data['tasks_end_date'] = $task_data->tasks_end_date;
                $data['tasks_user_start_date'] = $task_data->tasks_user_start_date;
                $data['tasks_closed_date'] = $task_data->tasks_closed_date;
                $data['tasks_closed'] = $task_data->tasks_closed;
                $data['tasks_user_comment'] = $task_data->tasks_user_comment;

                $this->parser->parse('task_view', $data);
            } else {
                $data['title'] = '<img src="' . base_url() . 'images/icons/32x32/busy.png"  border="0"> Ошибка!   ';
                $data['error_message'] = 'Эта задача созданна не вами и не для вас.';
                $this->parser->parse('errors', $data);
            }
        }
    }

    function task_del($task_id) {
        // Удаление задачи
        $this->load->model('Tasks_model');
        $task_data = $this->Tasks_model->get_task($task_id);
        if ($this->session->userdata('users_isadmin') == 1 or $task_data->tasks_master_uid == $this->session->userdata('users_id')) {
            $this->Tasks_model->delete_task($task_id);
            redirect(base_url());
        } else {
            $data['l_user_login'] = $this->session->userdata('users_login');
            $data['l_user_name'] = $this->session->userdata('users_name');
            $data['header_tpl'] = $this->parser->parse('header', $data, TRUE);
            $data['bottom_tpl'] = $this->parser->parse('bottom', $data, TRUE);
            $data['left_tpl'] = $this->parser->parse('left', $data, TRUE);
            $data['title'] = '<img src="' . base_url() . 'images/icons/32x32/busy.png"  border="0"> Ошибка!   ';
            $data['error_message'] = 'Эта задача созданна не вами, удалить её может только тот, кто создал.';
            $this->parser->parse('errors', $data);
        }
    }

    function task_close($task_id) {
        // Закрытие задачи
        $data['l_user_login'] = $this->session->userdata('users_login');
        $data['l_user_name'] = $this->session->userdata('users_name');
        $data['header_tpl'] = $this->parser->parse('header', $data, TRUE);
        $data['bottom_tpl'] = $this->parser->parse('bottom', $data, TRUE);
        $data['left_tpl'] = $this->parser->parse('left', $data, TRUE);
        $data['title'] = '<img src="' . base_url() . 'images/icons/32x32/check.png"  border="0"> Закрытие задачи.';

        $this->load->model('Tasks_model');
        $task_data = $this->Tasks_model->get_task($task_id);
        if ($this->session->userdata('users_isadmin') == 1 or $task_data->tasks_for_uid == $this->session->userdata('users_id')) {

            $this->load->model('Users_model');
            if ($this->session->userdata('users_isadmin') == 1) {
                $data['users_list'] = $this->Users_model->get_all_users();
            } else {
                $data['users_list'] = null;
            }

            $data['tasks_id'] = $task_data->tasks_id;
            $data['tasks_for_uid'] = $task_data->tasks_for_uid;
            $data['tasks_title'] = $task_data->tasks_title;
            $data['tasks_description'] = $task_data->tasks_description;
            $data['tasks_start_date'] = $task_data->tasks_start_date;
            $data['tasks_end_date'] = $task_data->tasks_end_date;
            $data['tasks_user_start_date'] = $task_data->tasks_user_start_date;
            $data['tasks_closed_date'] = $task_data->tasks_closed_date;
            $data['tasks_closed'] = $task_data->tasks_closed;
            $data['tasks_user_comment'] = $task_data->tasks_user_comment;

            $this->form_validation->set_rules('user_date_start', 'Дата начала работы', 'trim|required|min_length[1]|max_length[11]|xss_clean');
            $this->form_validation->set_rules('user_date_end', 'Дата окончания работы', 'trim|required|min_length[1]|max_length[11]|xss_clean');
            $this->form_validation->set_rules('start_time', 'Время начала', 'trim|required|min_length[1]|max_length[6]|xss_clean');
            $this->form_validation->set_rules('end_time', 'Время окончания', 'trim|required|min_length[1]|max_length[6]|xss_clean');
            $this->form_validation->set_rules('tasks_user_comment', 'Комментарий', 'trim|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                $this->parser->parse('task_close', $data);
            } else {
                $new_task_data['tasks_user_start_date'] = date('Y-m-d', strtotime($this->input->post('user_date_start'))) . ' ' . $this->input->post('start_time');
                $new_task_data['tasks_closed_date'] = date('Y-m-d', strtotime($this->input->post('user_date_end'))) . ' ' . $this->input->post('end_time');
                $new_task_data['tasks_user_comment'] = $this->input->post('tasks_user_comment');
                $new_task_data['tasks_closed'] = 1;
                $this->Tasks_model->task_update($task_id, $new_task_data);
                redirect(base_url());
            }
        } else {
            $data['title'] = '<img src="' . base_url() . 'images/icons/32x32/busy.png"  border="0"> Ошибка!   ';
            $data['error_message'] = 'Эта задача созданна не вами, закрыть её может только тот, кто создал или для кого она была созданна.';
            $this->parser->parse('errors', $data);
        }
    }

    function task_open($task_id) {
        // Удаление задачи
        $this->load->model('Tasks_model');
        $task_data = $this->Tasks_model->get_task($task_id);
        if ($this->session->userdata('users_isadmin') == 1 or $task_data->tasks_for_uid == $this->session->userdata('users_id')) {
            $new_task_data['tasks_closed'] = 0;
            $this->Tasks_model->task_update($task_id, $new_task_data);
            redirect(base_url());
        } else {
            $data['l_user_login'] = $this->session->userdata('users_login');
            $data['l_user_name'] = $this->session->userdata('users_name');
            $data['header_tpl'] = $this->parser->parse('header', $data, TRUE);
            $data['bottom_tpl'] = $this->parser->parse('bottom', $data, TRUE);
            $data['left_tpl'] = $this->parser->parse('left', $data, TRUE);
            $data['title'] = '<img src="' . base_url() . 'images/icons/32x32/busy.png"  border="0"> Ошибка!   ';
            $data['error_message'] = 'Эта задача созданна не вами или не для вас, открыть её может только тот, кто создал или для кого она созданна.';
            $this->parser->parse('errors', $data);
        }
    }

    function user($user_login) {
        // Вывод данных пользователя
        $data['l_user_login'] = $this->session->userdata('users_login');
        $data['l_user_name'] = $this->session->userdata('users_name');

        $this->load->model('Tasks_model');

        $this->load->model('Users_model');
        $user_data = $this->Users_model->get_user_by_login($user_login);
        if ($this->session->userdata('users_isadmin') == 1 or $user_data->users_id == $this->session->userdata('users_id') and $user_data != null) {
            $data['title'] = '<img src="' . base_url() . 'images/icons/32x32/home.png"  border="0"> Просмотр пользователя ' . $user_data->users_login;
            $data['active_tasks'] = $this->Tasks_model->get_all_tasks($user_login);
            $data['closed_tasks'] = $this->Tasks_model->get_all_tasks($user_login, 1);

            $total_time = 0;
            $full_days = 0;
            $full_hours = 0;
            $full_minutes = 0;
            if ($data['closed_tasks'] != null) {
                foreach ($data['closed_tasks'] as $closed_days) {
                    $total_time += strtotime($closed_days->tasks_closed_date) - strtotime($closed_days->tasks_user_start_date);
                }
                $full_days = floor($total_time / (60 * 60 * 24));
                $full_hours = floor(($total_time - ($full_days * 60 * 60 * 24)) / (60 * 60));
                $full_minutes = floor(($total_time - ($full_days * 60 * 60 * 24) - ($full_hours * 60 * 60)) / 60);
            }
            $data['user_closed_days'] = $full_days;
            $data['user_closed_hours'] = $full_hours;
            $data['user_closed_minutes'] = $full_minutes;
            $data['header_tpl'] = $this->parser->parse('header', $data, TRUE);
            $data['bottom_tpl'] = $this->parser->parse('bottom', $data, TRUE);
            $data['left_tpl'] = $this->parser->parse('left', $data, TRUE);

            $data['user_id'] = $user_data->users_id;
            $data['user_login'] = $user_data->users_login;
            $data['user_fio'] = $user_data->users_name;
            $data['user_phone'] = $user_data->users_phone;
            $data['user_comments'] = $user_data->users_comments;
            $this->parser->parse('user', $data);
        } else {
            $data['l_user_login'] = $this->session->userdata('users_login');
            $data['l_user_name'] = $this->session->userdata('users_name');
            $data['header_tpl'] = $this->parser->parse('header', $data, TRUE);
            $data['bottom_tpl'] = $this->parser->parse('bottom', $data, TRUE);
            $data['left_tpl'] = $this->parser->parse('left', $data, TRUE);
            $data['title'] = '<img src="' . base_url() . 'images/icons/32x32/busy.png"  border="0"> Ошибка!   ';
            $data['error_message'] = 'Просмотр данных другого пользователей позволен только администраторам.';
            $this->parser->parse('errors', $data);
        }
    }

    function user_list() {
        // Список пользователей
        $data['l_user_login'] = $this->session->userdata('users_login');
        $data['l_user_name'] = $this->session->userdata('users_name');

        $data['title'] = '<img src="' . base_url() . 'images/icons/32x32/customers.png"  border="0"> Список пользователей';
        $this->load->model('Users_model');
        $data['users_list'] = $this->Users_model->get_all_users();

        $data['header_tpl'] = $this->parser->parse('header', $data, TRUE);
        $data['bottom_tpl'] = $this->parser->parse('bottom', $data, TRUE);
        $data['left_tpl'] = $this->parser->parse('left', $data, TRUE);
        $this->parser->parse('users_list', $data);
    }

    function user_add() {
        // Добвление нового пользователя
        $data['l_user_login'] = $this->session->userdata('users_login');
        $data['l_user_name'] = $this->session->userdata('users_name');

        $data['title'] = '<img src="' . base_url() . 'images/icons/32x32/special-offer.png"  border="0"> Добавление нового пользователя';
        if ($this->session->userdata('users_isadmin') == 1) {
            $this->form_validation->set_rules('login', 'Логин пользователя', 'trim|required|valid_email|xss_clean|callback_check_user_login');
            $this->form_validation->set_rules('full_name', 'Фамилия И.О.', 'trim|xss_clean');
            $this->form_validation->set_rules('user_password', 'Пароль', 'trim|required|min_length[4]|max_length[126]|xss_clean');
            $this->form_validation->set_rules('phone', 'Телефон', 'trim|xss_clean');
            $this->form_validation->set_rules('user_comment', 'trim|xss_clean', '');

            $data['header_tpl'] = $this->parser->parse('header', $data, TRUE);
            $data['bottom_tpl'] = $this->parser->parse('bottom', $data, TRUE);
            $data['left_tpl'] = $this->parser->parse('left', $data, TRUE);

            if ($this->form_validation->run() == FALSE) {
                $this->parser->parse('user_add', $data);
            } else {
                $this->load->model('Users_model');
                $new_user_data['users_login'] = $this->input->post('login');
                $new_user_data['users_password'] = dohash($this->input->post('user_password'), 'md5');
                $new_user_data['users_name'] = $this->input->post('full_name');
                $new_user_data['users_phone'] = $this->input->post('phone');
                $new_user_data['users_comments'] = $this->input->post('user_comment');
                $new_user_data['users_isadmin'] = str_replace('on', '1', $this->input->post('is_admin'));
                $this->Users_model->add_user($new_user_data);
                redirect(base_url() . 'user_list');
            }
        } else {
            $data['header_tpl'] = $this->parser->parse('header', $data, TRUE);
            $data['bottom_tpl'] = $this->parser->parse('bottom', $data, TRUE);
            $data['left_tpl'] = $this->parser->parse('left', $data, TRUE);
            $data['title'] = '<img src="' . base_url() . 'images/icons/32x32/busy.png"  border="0"> Ошибка!   ';
            $data['error_message'] = 'Добавление новых пользователей позволенно только Администраторам';
            $this->parser->parse('errors', $data);
        }
    }

    function check_user_login($user_login) {
        // Проверка логина на существование
        $this->load->model('Users_model');
        $user_data = $this->Users_model->get_user_by_login(trim($user_login));
        if ($user_data != null) {
            $this->form_validation->set_message('check_user_login', 'Пользователь ' . $user_login . ' уже существует, введите другой логин.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function user_del($user_id) {
        // Удаление задачи
        if ($this->session->userdata('users_isadmin') == 1 AND $this->session->userdata('users_id') != $user_id) {
            $this->load->model('Users_model');
            $this->Users_model->delete_user($user_id);
            $this->load->model('Tasks_model');
            $this->Tasks_model->delete_tasks_for_user($user_id);
            redirect(base_url() . 'user_list');
        } else {
            $data['l_user_login'] = $this->session->userdata('users_login');
            $data['l_user_name'] = $this->session->userdata('users_name');
            $data['header_tpl'] = $this->parser->parse('header', $data, TRUE);
            $data['bottom_tpl'] = $this->parser->parse('bottom', $data, TRUE);
            $data['left_tpl'] = $this->parser->parse('left', $data, TRUE);
            $data['title'] = '<img src="' . base_url() . 'images/icons/32x32/busy.png"  border="0"> Ошибка!   ';
            $data['error_message'] = 'Вы не администратор или удаляете самого себя.';
            $this->parser->parse('errors', $data);
        }
    }

    function user_edit($user_id) {
        // Редактирование пользователя
        $data['l_user_login'] = $this->session->userdata('users_login');
        $data['l_user_name'] = $this->session->userdata('users_name');

        $this->load->model('Users_model');
        $user_data = $this->Users_model->get_user_by_id($user_id);

        $data['title'] = '<img src="' . base_url() . 'images/icons/32x32/my-account.png"  border="0"> Редактирование пользователя';
        if ($this->session->userdata('users_isadmin') == 1 or $this->session->userdata('users_id') == $user_id AND $user_data != null) {
            //$this->form_validation->set_rules('login', 'Логин пользователя', 'trim|required|valid_email|xss_clean|callback_check_user_login');
            $this->form_validation->set_rules('full_name', 'Фамилия И.О.', 'trim|xss_clean');
            $this->form_validation->set_rules('user_password', 'Пароль', 'trim|min_length[4]|max_length[126]|xss_clean');
            $this->form_validation->set_rules('phone', 'Телефон', 'trim|xss_clean');
            $this->form_validation->set_rules('user_comment', 'trim|xss_clean', '');

            $data['header_tpl'] = $this->parser->parse('header', $data, TRUE);
            $data['bottom_tpl'] = $this->parser->parse('bottom', $data, TRUE);
            $data['left_tpl'] = $this->parser->parse('left', $data, TRUE);

            $data['edit_users_id'] = $user_data->users_id;
            $data['edit_users_login'] = $user_data->users_login;
            $data['edit_users_name'] = $user_data->users_name;
            $data['edit_users_phone'] = $user_data->users_phone;
            $data['edit_users_comments'] = $user_data->users_comments;
            $data['edit_users_isadmin'] = str_replace('1', 'checked', $user_data->users_isadmin);

            if ($this->form_validation->run() == FALSE) {
                $this->parser->parse('user_edit', $data);
            } else {
                //$new_user_data['users_login'] = $this->input->post('login');
                if (trim($this->input->post('user_password')) != '')
                    $new_user_data['users_password'] = dohash($this->input->post('user_password'), 'md5');
                $new_user_data['users_name'] = $this->input->post('full_name');
                $new_user_data['users_phone'] = $this->input->post('phone');
                $new_user_data['users_comments'] = $this->input->post('user_comment');
                if ($this->session->userdata('users_isadmin') == 1)
                    $new_user_data['users_isadmin'] = str_replace('on', '1', $this->input->post('is_admin'));
                $this->Users_model->update_user($user_id, $new_user_data);
                redirect(base_url() . 'user_list');
            }
        } else {
            $data['header_tpl'] = $this->parser->parse('header', $data, TRUE);
            $data['bottom_tpl'] = $this->parser->parse('bottom', $data, TRUE);
            $data['left_tpl'] = $this->parser->parse('left', $data, TRUE);
            $data['title'] = '<img src="' . base_url() . 'images/icons/32x32/busy.png"  border="0"> Ошибка!   ';
            $data['error_message'] = 'Редактирование других пользователей позволенно только Администраторам';
            $this->parser->parse('errors', $data);
        }
    }

    function stat() {
        // Статистика
        $data['l_user_login'] = $this->session->userdata('users_login');
        $data['l_user_name'] = $this->session->userdata('users_name');

        $data['title'] = '<img src="' . base_url() . 'images/icons/32x32/statistics.png"  border="0"> Статистика';
        $this->load->model('Tasks_model');
        $this->load->model('Users_model');
        $data['sel_uid'] = $this->input->post('task_for');
        if ($this->session->userdata('users_isadmin') == 1) {
            $data['users_list'] = $this->Users_model->get_all_users();
        } else {
            $data['users_list'] = null;
        }
        //$data['active_tasks'] = $this->Tasks_model->get_all_tasks($for_user);
        //$data['closed_tasks'] = $this->Tasks_model->get_all_tasks($for_user, 1);
        $data['header_tpl'] = $this->parser->parse('header', $data, TRUE);
        $data['bottom_tpl'] = $this->parser->parse('bottom', $data, TRUE);
        $data['left_tpl'] = $this->parser->parse('left', $data, TRUE);

        $this->form_validation->set_rules('date_start', 'Начало', 'trim|required|min_length[8]|max_length[11]|xss_clean');
        $this->form_validation->set_rules('date_end', 'Окончание', 'trim|required|min_length[8]|max_length[11]|xss_clean');

        $total_time = 0;
        $total_w_time = 0;
        $total_l_time = 0;
        $full_days = 0;
        $full_hours = 0;
        $full_minutes = 0;
        $full_w_days = 0;
        $full_w_hours = 0;
        $full_w_minutes = 0;
//        $full_l_days = 0;
//        $full_l_hours = 0;
//        $full_l_minutes = 0;
        $data['user_closed_days'] = $full_days;
        $data['user_closed_hours'] = $full_hours;
        $data['user_closed_minutes'] = $full_minutes;
        $data['closed_tasks'] = null;
        $data['work_days'] = null;
        $data['user_total_days'] = 0;
        $data['user_total_hours'] = 0;
        $data['user_total_minutes'] = 0;


        if ($this->form_validation->run() == FALSE) {
            $this->parser->parse('stat', $data);
        } else {
            $closed_tasks = $this->Tasks_model->get_closed_tasks_for_dates(
                            $this->input->post('task_for'),
                            date('Y-m-d', strtotime($this->input->post('date_start'))),
                            date('Y-m-d', strtotime($this->input->post('date_end'))));

            if ($closed_tasks != null) {
                foreach ($closed_tasks as $closed_days) {
                    $total_time = $total_time + (strtotime($closed_days->tasks_closed_date) - strtotime($closed_days->tasks_user_start_date));
                }
                $full_days = floor($total_time / (60 * 60 * 24));
                $full_hours = floor(($total_time - ($full_days * 60 * 60 * 24)) / (60 * 60));
                $full_minutes = floor(($total_time - ($full_days * 60 * 60 * 24) - ($full_hours * 60 * 60)) / 60);
            }
            
            $data['user_closed_days'] = $full_days;
            $data['user_closed_hours'] = $full_hours;
            $data['user_closed_minutes'] = $full_minutes;
            $data['closed_tasks'] = $closed_tasks;

            $work_days = $this->In_out_model->get_work_dates(
                            $this->input->post('task_for'),
                            date('Y-m-d', strtotime($this->input->post('date_start'))),
                            date('Y-m-d', strtotime($this->input->post('date_end'))));

            if ($work_days != null) {
                $total_w_time = 0;
                $total_l_time = 0;
                foreach ($work_days as $work_day) {
                    $total_w_time = $total_w_time + (strtotime($work_day->in_out_date.' '.$work_day->in_out_time_out) - strtotime($work_day->in_out_date.' '.$work_day->in_out_time_in));
                }
                foreach ($work_days as $work_day) {
                    $total_l_time = $total_l_time + (strtotime($work_day->in_out_date.' '.$work_day->in_out_lunch_out) - strtotime($work_day->in_out_date.' '.$work_day->in_out_lunch_in));
                }
                $total_w_time = $total_w_time - $total_l_time;
                $full_w_days = floor($total_w_time / (60 * 60 * 24));
                $full_w_hours = floor(($total_w_time - ($full_w_days * 60 * 60 * 24)) / (60 * 60));
                $full_w_minutes = floor(($total_w_time - ($full_w_days * 60 * 60 * 24) - ($full_w_hours * 60 * 60)) / 60);
//                $full_l_days = floor($total_l_time / (60 * 60 * 24));
//                $full_l_hours = floor(($total_l_time - ($full_l_days * 60 * 60 * 24)) / (60 * 60));
//                $full_l_minutes = floor(($total_l_time - ($full_l_days * 60 * 60 * 24) - ($full_l_hours * 60 * 60)) / 60);
            }

            $data['user_total_days'] = $full_w_days;
            $data['user_total_hours'] = $full_w_hours;
            $data['user_total_minutes'] = $full_w_minutes;

            $this->parser->parse('stat', $data);
        }
    }

    function in_out_save(){
        // Запись данных о приходе/уходе на работу
        $in_out_data['in_out_user_id'] = $this->session->userdata('users_id');
        $in_out_data['in_out_date'] = date('Y-m-d');
        $in_out_data['in_out_time_in'] = date('H:i:s', strtotime($this->input->post('time_in')));
        $in_out_data['in_out_time_out'] = date('H:i:s', strtotime($this->input->post('time_out')));
        $in_out_data['in_out_lunch_in'] = date('H:i:s', strtotime($this->input->post('lunch_in')));
        $in_out_data['in_out_lunch_out'] = date('H:i:s', strtotime($this->input->post('lunch_out')));
        $this->In_out_model->save_date($in_out_data);
        redirect(base_url());
    }

    function logout(){
        // Выход пользователя
        $this->session->sess_destroy();
        redirect(base_url());
    }

}
?>
