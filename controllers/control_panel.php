<?php

namespace Controller;

use Exception\ForbiddenException;
use Helper\RequestedPermissions;
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
        try {
            $this->model->checkGuest();

            View::viewPage('control_panel.html', [
                'title' => "Контрольная панель",
                'css' => 'main_table'
            ]);
        } catch (ForbiddenException $exception) {
            $this->forbidden($exception->getMessage());
        } catch (\Throwable $exception) {
            http_response_code(400);
            print json_encode([
                'issueType' => substr(strrchr(get_class($exception), "\\"), 1),
                'issueMessage' => $exception->getMessage(),
            ]);
        }

    }

    function action_getmembers()
    {
        header('Content-Type: application/json');
        $request = json_decode(file_get_contents("php://input"), true);
        try {

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
        } catch (\Throwable $exception) {
            http_response_code(400);
            print json_encode([
                'issueType' => substr(strrchr(get_class($exception), "\\"), 1),
                'issueMessage' => $exception->getMessage(),
            ]);
        }
    }

    function action_addmember()
    {
        header('Content-Type: application/json');
        try {
            $this->model->checkUser();

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

    function action_changemember()
    {
        header('Content-Type: application/json');
        $request = json_decode(file_get_contents("php://input"), true);

        try {
            $this->model->changeUser($request['usedata']);
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

    function action_delete($params)
    {
        header('Content-Type: application/json');

        if (empty($params)) die;

        try {
            if ($params[0] == "member") {
                $this->model->deleteMember($params[1]);
                http_response_code(200);
            }
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

    function action_truncate()
    {
        header('Content-Type: application/json');

        try {
            $this->model->truncateMembers();
            http_response_code(200);
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