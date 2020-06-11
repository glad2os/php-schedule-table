<?php

namespace Controller;

use Helper\View;

class all_table extends Base
{

    /**
     * all_table constructor.
     */
    public function __construct()
    {
        parent::__construct(\Model\AllTable::class);
    }

    public function action_index()
    {
        View::viewPage('all_table.html');
    }

    public function action_sorting()
    {
        header('Content-Type: application/json');
        $request = json_decode(file_get_contents("php://input"), true);

        try {
            if (!empty($request['sorting']))
                switch ($request['sorting']) {
                    case 'clubM':
                        $members = $this->model->getClub("man");
                        break;
                    case 'clubW':
                        $members = $this->model->getClub("woman");
                        break;
                    case '12M':
                        $members = $this->model->get12cat("man");
                        break;
                    case '12W':
                        $members = $this->model->get12cat("woman");
                        break;
                    case '11M':
                        $members = $this->model->get11cat("man");
                        break;
                    case '11W':
                        $members = $this->model->get11cat("woman");
                        break;
                    case '10M':
                        $members = $this->model->get10cat("man");
                        break;
                    case '10W':
                        $members = $this->model->get10cat("woman");
                        break;
                    case '9M':
                        $members = $this->model->get9cat("man");
                        break;
                    case '9W':
                        $members = $this->model->get9cat("woman");
                        break;
                    case '8M':
                        $members = $this->model->get8cat("man");
                        break;
                    case '8W':
                        $members = $this->model->get8cat("woman");
                        break;
                    default:
                        break;
                }

            if (sizeof($members) == 0) {
                http_response_code(204);
                exit();
            }

            print json_encode([
                'members' => $members,
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