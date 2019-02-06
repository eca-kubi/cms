<?php /** @noinspection ALL */

use Simple\json;

class ActionLists extends Controller
{
    /**
     * ActionLists constructor.
     */
    public function __construct()
    {
        parent::__construct();
        if (!isLoggedIn()) {
            redirect('users/login');
        }
    }

    public function index()
    {
        // Get posts
        $cms_form_id = -1;
        if (isset($_GET['cms_form_id'])) {
            $cms_form_id = $_GET['cms_form_id'];
        }
        $db = Database::getDbh();
        $ret = $db->where('cms_form_id', $cms_form_id)
            ->objectBuilder()
            ->get('cms_action_list');
        $json = new json();
        $json->data = $ret;
        isset($_GET['callback']) ? $json->send_callback($_GET['callback']) : $json->send();
    }

    public function Create()
    {
        //$_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
        $json = new json();
        $payload = json_decode($_POST['payload']);
        $payload->date = (new \Moment\Moment($payload->date))->format(\Moment\Moment::NO_TZ_MYSQL);
        unset($payload->cms_action_list_id);
        unset($payload->no);
        $action = (new CmsActionList());
        $insert_id = $action->initialize((array)$payload)->insert();
        $ret = $action->fetchSingle($insert_id);
        $json->data = $ret;
        isset($_GET['callback']) ? $json->send_callback($_GET['callback']) : $json->send();
    }

    /**
     * @param $cms_action_list_id
     */
    public function Update($cms_action_list_id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST array
            //$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $json = new json();
            $payload = json_decode($_POST['payload']);
            $payload->date = (new \Moment\Moment($payload->date))->format(\Moment\Moment::NO_TZ_MYSQL);
            unset($payload->no);
            $action = (new CmsActionList());
            $action->update($cms_action_list_id, (array)$payload);
            $ret = $action->fetchSingle($cms_action_list_id);
            $json->data = $ret;
            isset($_GET['callback']) ? $json->send_callback($_GET['callback']) : $json->send();
        } else {
            // Get existing post from model
            $action = (new CmsActionList(['cms_action_list_id' => $cms_action_list_id]));
            if ($action) {
                $json = new \Simple\json();
                /** @noinspection PhpUndefinedFieldInspection */
                $json->data = $action;
                isset($_GET['callback']) ? $json->send_callback($_GET['callback']) : $json->send();
            }
        }
    }

    public function Destroy($cms_action_list_id)
    {
        $json = new json();
        $action = (new CmsActionList());
        $payload = json_decode($_POST['payload']);
        $ret = $action->destroy($cms_action_list_id);
        //$ret = $action->fetchSingle($cms_action_list_id);
        $json->data = $payload;
        isset($_GET['callback']) ? $json->send_callback($_GET['callback']) : $json->send();
    }
}