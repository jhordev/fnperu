<?php

namespace ADMINFN\Controllers;
use ADMINFN\Core\BaseController;
use ADMINFN\Models\FNPeru\WebConfigModel;

class Configuracion extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->verifyLogin();
    }

    public function index()
    {
        $data['page_title']   = 'Configuraciones Web';
        $data['page_active']  = 'configuracion';
        $data['page_swalert'] = true;
        $data['page_js']      = 'configuracion/configuracion';

        $model = new WebConfigModel;
        $rows  = $model->getAll();
        $data['config'] = array_column($rows, null, 'config_key');

        $this->view(['Template/header', 'Configuracion/configuracion', 'Template/footer'], $data);
    }

    public function update()
    {
        $this->isPost();

        $return = ['status' => false, 'msg' => ''];

        $key   = trim($this->post['key']   ?? '');
        $type  = trim($this->post['type']  ?? 'boolean');
        $value = trim($this->post['value'] ?? '');

        if ($key === '') {
            $return['msg'] = 'Clave inválida.';
            json($return);
        }

        if ($type === 'boolean') {
            if (!in_array($value, ['0', '1'], true)) {
                $return['msg'] = 'Valor inválido.';
                json($return);
            }
        } else {
            $value = strip_tags($value);
            if (mb_strlen($value) > 500) {
                $return['msg'] = 'El valor excede el límite permitido.';
                json($return);
            }
        }

        $model = new WebConfigModel;
        $ok    = $model->updateByKey($key, $value);

        $return['status'] = (bool) $ok;
        $return['msg']    = $ok ? 'Configuración guardada.' : 'Error al guardar.';
        json($return);
    }
}
