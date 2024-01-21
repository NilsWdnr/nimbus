<?php

namespace nimbus\Controller;

use Exception;
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

    public function edit(int $id): void
    {
        $job = $this->jobModel->get_by_id($id);
        $args = [...$job];
        $args['method'] = "edit";
        $this->view->set_title('Edit Job');
        $this->view->show_sidebar();
        $this->view->load_view('JobEdit', $args);
    }

    public function delete(int $id): void
    {
        if ($this->jobModel->delete($id)) {
            if(isset($_SERVER['HTTP_REFERER'])){
                $this->redirect($_SERVER['HTTP_REFERER']);
            } else {
                $this->redirect('/jobs');
            }

        } else {
            throw new Exception('Es ist ein Fehler beim löschen des Jobs aufgetreten.');
        }
    }

    public function save(int $id): void
    {
        $update_data = [
            "title" => $_POST['title'],
            "time_model" => $_POST['time_model'],
            "section" => $_POST['section'],
            "description" => $_POST['description']
        ];

        if ($this->jobModel->update($id, $update_data)) {
            $this->redirect('/jobs');
        } else {
            throw new Exception('Es ist ein Fehler beim Speichern des Jobs aufgetreten.');
        }
    }

    public function save_new(): void
    {
        $create_data = [
            "title" => $_POST['title'],
            "time_model" => $_POST['time_model'],
            "section" => $_POST['section'],
            "description" => $_POST['description'],
            "date_created" => date("Y-m-d H:i:s")
        ];

        if ($this->jobModel->insert($create_data)) {
            $this->redirect('/jobs');
        } else {
            throw new Exception('Fehler beim Erstellen des Jobs');
        }
    }
}