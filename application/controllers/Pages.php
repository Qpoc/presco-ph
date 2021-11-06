<?php
    class Pages extends CI_Controller{
        
        public function index() {
            $this->load->view('templates/header');
		    $this->load->view('pages/home');
            $this->load->view('templates/footer');
	    }

        public function view($page = 'home'){
            if (!file_exists(APPPATH.'views/pages/'.$page.'.php')) {
                show_404();
            }

            $data['title'] = ucfirst($page);

            $this->load->view('templates/header');
            $this->load->view('pages/'.$page, $data);
            $this->load->view('templates/footer');
        }

        public function indexAdmin(){
            $this->load->view('templates/admin/header');
            $this->load->view('pages/admin/dashboard');
            $this->load->view('templates/footer');
        }

        public function viewAdmin($page = 'dashboard'){
            if (!file_exists(APPPATH."views/pages/admin/" . $page . '.php')) {
                show_404();
            }

            $data['title'] = ucfirst($page);

            $this->load->view("templates/admin/header");
            $this->load->view("pages/admin/" . $page, $data);
            $this->load->view("templates/footer");
        }
    }