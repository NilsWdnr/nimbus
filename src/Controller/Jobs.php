<?php

namespace nimbus\Controller;

use nimbus\Controller;
use nimbus\Model\Job as JobModel;

final class Jobs extends Controller {
    private $jobModel;

    public function __construct()
    {
        parent::__construct();
        $this->GuestsOnly();
        $this->jobModel = new JobModel();
    }

    public function index(): void
    {
        $jobs = $this->jobModel->get_all();

        $view_args = [
            'jobs' => $jobs
        ];

        $this->view->set_title('Jobs');
        $this->view->show_sidebar();
        $this->view->load_view('Jobs', $view_args);
    }

    public function create(): void 
    {
        $args = [
            'method' => 'create'
        ];

        $this->view->set_title('Create Job');
        $this->view->show_sidebar();
        $this->view->load_view('JobEdit', $args);
    }
}