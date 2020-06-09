<?php

namespace Controller;

use Exception\ForbiddenException;
use Helper\View;

class control_panel extends Base
{

    /**
     * control_panel constructor.
     */
    public function __construct()
    {
        parent::__construct(\Model\ControlPanel::class);
    }

    function action_index()
    {
        View::viewPage('control_panel.html');
    }

    function action_getmembers()
    {
        header('Content-Type: application/json');
        $request = json_decode(file_get_contents("php://input"), true);

        if (!isset($request['page'])) {
            http_response_code(400);
            die;
        }

        $members = $this->model->getAllMembers($request['page'] - 1);


        if (sizeof($members) == 0) {
            http_response_code(204);
            exit();
        }

        print json_encode([
            'page' => $request['page'],
            'members' => $members,
            'pageCount' => ceil($this->model->getCountOfMembers() / 10),
        ]);
    }

    function action_addmember()
    {
        header('Content-Type: application/json');
        try {
            $this->model->checkuser();

            $request = json_decode(file_get_contents("php://input"), true);

            $this->model->addUser($request);
        } catch (ForbiddenException $exception) {
            http_response_code(403);
            print json_encode([
                'issueType' => substr(strrchr(get_class($exception), "\\"), 1),
                'issueMessage' => $exception->getMessage(),
            ]);
        } catch (\Throwable $exception) {
            http_response_code(400);
            print json_encode([
                'issueType' => substr(strrchr(get_class($exception), "\\"), 1),
                'issueMessage' => $exception->getMessage(),
            ]);
        }
    }
}