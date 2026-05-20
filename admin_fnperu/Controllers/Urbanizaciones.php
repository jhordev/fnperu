<?php

namespace ADMINFN\Controllers;
use ADMINFN\Core\BaseController;
use ADMINFN\Helpers\Helper;
use ADMINFN\Models\FNPeru\UrbanizationBenefitsModel;
use ADMINFN\Models\FNPeru\UrbanizationContactModel;
use ADMINFN\Models\FNPeru\UrbanizationDocModel;
use ADMINFN\Models\FNPeru\UrbanizationIndicatorModel;
use ADMINFN\Models\FNPeru\UrbanizationModel;
use ADMINFN\Models\FNPeru\UrbanizationModulesModel;
use ADMINFN\Models\FNPeru\UrbanizationSliderModel;

class Urbanizaciones extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this -> verifyLogin();
    }

    public function index()
    {
        $data['page_title'] = 'Habilitaciones Urbanas';
        $data['page_active'] = 'urbanization';
        $data['page_css'] = 'urbanization/urbanization';
        $data['page_js'] = 'urbanization/urbanization';
        $data['page_datatable'] = true;

        $this -> view(['Template/header', 'Urbanization/urbanization', 'Template/footer'], $data);
    }

    public function ordenar()
    {
        $data['page_title'] = 'Ordenar Habilitaciones Urbanas';
        $data['page_active'] = 'urbanization';
        // $data['page_css'] = 'cursos/cursos';
        $data['page_js'] = 'urbanization/order';
        $data['page_sortable'] = true;
        // $data['page_datatable'] = true;

        $cursos = new UrbanizationModel();
        $data['urbanization'] = $cursos -> getLast();

        $this -> view(['Template/header', 'Urbanization/order', 'Template/footer'], $data);
    }

    public function order()
    {
        $this -> isPost();

        $return = [];
        $return['status'] = false;

        if ($this -> post['data'] == '') {
            json($return);
        }

        $dataOrden = explode('-', $this -> post['data']);

        if ($dataOrden == []) {
            json($return);
        }

        foreach ($dataOrden as $key => $value) {
            if (!ctype_digit($value)) {
                json($return);
            }
        }

        $cursos = new UrbanizationModel();

        foreach ($dataOrden as $key => $value)
        {
            $update = $cursos -> query('UPDATE urbanization SET urbanization.order = :order WHERE id = :id');
            $update -> bindValue(':order', $key);
            $update -> bindValue(':id', $value);
            $result = $update -> execute();

            if ($result !== true) {
                json($return);
            }
        }

        $return['status'] = true;
        json($return);
    }

    public function editar(int $idUrbanization)
    {
        $data['page_title'] = 'Editar Habilitación Urbana';
        $data['page_active'] = 'urbanization';
        $data['page_js'] = 'urbanization/editar';
        $data['page_css'] = 'urbanization/editar';
        $data['page_swalert'] = true;
        $data['page_sortable'] = true;

        $cursos = new UrbanizationModel();
        $data['urbanization'] = $cursos -> getById($idUrbanization);

        if (!$data['urbanization']) {
            redirect($this -> base_url() . '/urbanizaciones');
        }

        $auxClass = new UrbanizationDocModel();
        $data['docs'] = $auxClass -> getByUrbanization($idUrbanization);

        $auxClass = new UrbanizationContactModel();
        $data['contacts'] = $auxClass -> getByUrbanization($idUrbanization);

        $auxClass = new UrbanizationBenefitsModel();
        $data['benefits'] = $auxClass -> getByUrbanization($idUrbanization);

        $auxClass = new UrbanizationSliderModel();
        $data['slider'] = $auxClass -> getByUrbanization($idUrbanization);

        $auxClass = new UrbanizationModulesModel();
        $data['modules'] = $auxClass -> getWithIndicatorsByUrbanization($idUrbanization);

        $this -> view(['Template/header', 'Urbanization/edit', 'Template/footer'], $data);
    }

    public function save()
    {
        $this -> isPost();

        $return = [
            'status' => false,
            'message' => 'Ocurrió un error inesperado',
            'title' => 'ERROR',
            'type' => 'danger'
        ];

        if (!isset($this -> post['action']) || !isset($this -> post['id'])) {
            json($return);
        }

        $this -> post['id'] = intval($this -> post['id']);

        if($this -> post['action'] == 'image') {
            $this -> post['data'] = 'image';
        }

        if($this -> post['action'] == 'brochure') {
            $this -> post['data'] = 'brochure';
        }

        if (!isset($this -> post['data'])) {
            json($return);
        }

        $this -> post['data'] = trim($this -> post['data'] );

        $urbanizationModel = new UrbanizationModel();
        $dataUrbanization = $urbanizationModel -> getById($this -> post['id']);

        if (!$dataUrbanization) {
            json($return);
        }

        if ($this -> post['action'] == 'name')
        {
            if ($this -> post['data'] == $dataUrbanization['name']) {
                $return['status'] = true;
                json($return);
            }

            if ( mb_strlen($this -> post['data']) > 198 || mb_strlen($this -> post['data']) < 5 || !isAlphaDash($this -> post['data'], ' ()[]-_.,;:') ) {
                $return['message'] = 'Nombre de la Habilitación Urbana no válida';
                $return['title'] = 'ALERTA';
                $return['type'] = 'warning';
                json($return);
            }

            $update = $urbanizationModel -> query('UPDATE urbanization SET name = :name WHERE id = :id');
            $update -> bindValue(':name', $this -> post['data']);
            $update -> bindValue(':id', $this -> post['id']);
            $result = $update -> execute();

            if ($result === true && $update -> rowCount() === 1) {
                $return['status'] = true;
            }
            json($return);
        }

        if ($this -> post['action'] == 'video')
        {
            $video = trim($this -> post['data']);

            $video = explode( 'https://www.youtube.com/watch?v=', $video);

            if (count($video) > 1) {
                if (trim($video[1]) != '') {
                    $video = explode('&', $video[1]);
                    $video = trim($video[0]);
                    if ($video == '') {
                        $video = null;
                    }
                } else {
                    $video = null;
                }
            } else {
                $video = null;
            }

            if ($video == null)
            {
                $video = trim($this -> post['data']);

                $video = explode( 'https://youtu.be/', $video);

                if (count($video) > 1) {
                    if (trim($video[1]) != '') {
                        $video = explode('&', $video[1]);
                        $video = trim($video[0]);
                        if ($video == '') {
                            $video = null;
                        }
                    } else {
                        $video = null;
                    }
                } else {
                    $video = null;
                }
            }

            if ($video == null) {
                $return['message'] = 'Link del no válido';
                $return['title'] = 'ALERTA';
                $return['type'] = 'warning';
                json($return);
            }

            if ( mb_strlen($video) > 20 || mb_strlen($video) < 3 || !isAlphaDash($video, ' ()[]-_.,;:') ) {
                $return['message'] = 'Link del no válido';
                $return['title'] = 'ALERTA';
                $return['type'] = 'warning';
                json($return);
            }

            if ($video == $dataUrbanization['youtube_video']) {
                $return['status'] = true;
                json($return);
            }

            $update = $urbanizationModel -> query('UPDATE urbanization SET youtube_video = :youtube_video WHERE id = :id');
            $update -> bindValue(':youtube_video', $video);
            $update -> bindValue(':id', $this -> post['id']);
            $result = $update -> execute();

            if ($result === true && $update -> rowCount() === 1) {
                $return['status'] = true;
            }
            json($return);
        }

        if ($this -> post['action'] == 'orden_contact')
        {
            if ($this -> post['data'] == '') {
                json($return);
            }

            $dataOrden = explode('-', $this -> post['data']);

            if ($dataOrden == []) {
                json($return);
            }

            foreach ($dataOrden as $value) {
                if (!ctype_digit($value)) {
                    json($return);
                }
            }

            foreach ($dataOrden as $key => $value)
            {
                $update = $urbanizationModel -> query('UPDATE urbanization_contact SET urbanization_contact.order = :order WHERE id = :id AND urbanization_id = :urbanization_id');
                $update -> bindValue(':order', $key);
                $update -> bindValue(':id', $value);
                $update -> bindValue(':urbanization_id', $this -> post['id']);
                $result = $update -> execute();

                if ($result !== true) {
                    json($return);
                }
            }

            $return['status'] = true;
            json($return);
        }

        if ($this -> post['action'] == 'orden_material')
        {
            if ($this -> post['data'] == '') {
                json($return);
            }

            $dataOrden = explode('-', $this -> post['data']);

            if ($dataOrden == []) {
                json($return);
            }

            foreach ($dataOrden as $value) {
                if (!ctype_digit($value)) {
                    json($return);
                }
            }

            foreach ($dataOrden as $key => $value)
            {
                $update = $urbanizationModel -> query('UPDATE urbanization_doc SET urbanization_doc.order = :order WHERE id = :id AND urbanization_id = :urbanization_id');
                $update -> bindValue(':order', $key);
                $update -> bindValue(':id', $value);
                $update -> bindValue(':urbanization_id', $this -> post['id']);
                $result = $update -> execute();

                if ($result !== true) {
                    json($return);
                }
            }

            $return['status'] = true;
            json($return);
        }

        if ($this -> post['action'] == 'orden_bienes')
        {
            if ($this -> post['data'] == '') {
                json($return);
            }

            $dataOrden = explode('-', $this -> post['data']);

            if ($dataOrden == []) {
                json($return);
            }

            foreach ($dataOrden as $key => $value) {
                if (!ctype_digit($value)) {
                    json($return);
                }
            }

            foreach ($dataOrden as $key => $value)
            {
                $update = $urbanizationModel -> query('UPDATE urbanization_benefit SET urbanization_benefit.order = :order WHERE id = :id AND urbanization_id = :urbanization_id');
                $update -> bindValue(':order', $key);
                $update -> bindValue(':id', $value);
                $update -> bindValue(':urbanization_id', $this -> post['id']);
                $result = $update -> execute();

                if ($result !== true) {
                    json($return);
                }
            }

            $return['status'] = true;
            json($return);
        }

        if ($this -> post['action'] == 'orden_slider')
        {
            if ($this -> post['data'] == '') {
                json($return);
            }

            $dataOrden = explode('-', $this -> post['data']);

            if ($dataOrden == []) {
                json($return);
            }

            foreach ($dataOrden as $value) {
                if (!ctype_digit($value)) {
                    json($return);
                }
            }

            foreach ($dataOrden as $key => $value)
            {
                $update = $urbanizationModel -> query('UPDATE urbanization_slider SET urbanization_slider.order = :order WHERE id = :id AND urbanization_id = :urbanization_id');
                $update -> bindValue(':order', $key);
                $update -> bindValue(':id', $value);
                $update -> bindValue(':urbanization_id', $this -> post['id']);
                $result = $update -> execute();

                if ($result !== true) {
                    json($return);
                }
            }

            $return['status'] = true;
            json($return);
        }

        if ($this -> post['action'] == 'orden_modulos')
        {
            if ($this -> post['data'] == '') {
                json($return);
            }

            $dataOrden = explode('-', $this -> post['data']);

            if ($dataOrden == []) {
                json($return);
            }

            foreach ($dataOrden as $key => $value) {
                if (!ctype_digit($value)) {
                    json($return);
                }
            }

            foreach ($dataOrden as $key => $value)
            {
                $update = $urbanizationModel -> query('UPDATE urbanization_modules SET urbanization_modules.order = :order WHERE id = :id AND urbanization_id = :urbanization_id');
                $update -> bindValue(':order', $key);
                $update -> bindValue(':id', $value);
                $update -> bindValue(':urbanization_id', $this -> post['id']);
                $result = $update -> execute();

                if ($result !== true) {
                    json($return);
                }
            }

            $return['status'] = true;
            json($return);
        }

        if ($this -> post['action'] == 'orden_indicadores')
        {
            if ($this -> post['data'] == '') {
                json($return);
            }

            $dataOrden = explode('-', $this -> post['data']);

            if ($dataOrden == []) {
                json($return);
            }

            foreach ($dataOrden as $key => $value) {
                if (!ctype_digit($value)) {
                    json($return);
                }
            }

            foreach ($dataOrden as $key => $value)
            {
                $update = $urbanizationModel -> query('UPDATE urbanization_indicator SET urbanization_indicator.order = :order WHERE id = :id');
                $update -> bindValue(':order', $key);
                $update -> bindValue(':id', $value);
                $result = $update -> execute();

                if ($result !== true) {
                    json($return);
                }
            }

            $return['status'] = true;
            json($return);
        }

        if ($this -> post['action'] == 'price')
        {
            if ($this -> post['data'] == $dataUrbanization['price']) {
                $return['status'] = true;
                json($return);
            }

            if ( mb_strlen($this -> post['data']) > 18 ) {
                $return['message'] = 'Precio no valido';
                $return['title'] = 'ALERTA';
                $return['type'] = 'warning';
                json($return);
            }

            $update = $urbanizationModel -> query('UPDATE urbanization SET price = :price WHERE id = :id');
            $update -> bindValue(':price', floatval($this -> post['data']));
            $update -> bindValue(':id', $this -> post['id']);
            $result = $update -> execute();

            if ($result === true && $update -> rowCount() === 1) {
                $return['status'] = true;
            }
            json($return);
        }

        if ($this -> post['action'] == 'coordinates')
        {
            if ($this -> post['data'] == $dataUrbanization['coordinates']) {
                $return['status'] = true;
                json($return);
            }

            $this -> post['data'] = str_replace(' ', '', $this -> post['data']);

            if ( mb_strlen($this -> post['data']) > 90 || !$this->esCoordenadaValida($this -> post['data']))
            {
                $return['message'] = 'Coordenadas no validas';
                $return['title'] = 'ALERTA';
                $return['type'] = 'warning';
                json($return);
            }

            $update = $urbanizationModel -> query('UPDATE urbanization SET coordinates = :coordinates WHERE id = :id');
            $update -> bindValue(':coordinates', $this -> post['data']);
            $update -> bindValue(':id', $this -> post['id']);
            $result = $update -> execute();

            if ($result === true && $update -> rowCount() === 1) {
                $return['status'] = true;
            }
            json($return);
        }

        if ($this -> post['action'] == 'office')
        {
            if ($this -> post['data'] == $dataUrbanization['office']) {
                $return['status'] = true;
                json($return);
            }

            $this -> post['data'] = str_replace(' ', '', $this -> post['data']);

            if ( mb_strlen($this -> post['data']) > 90 || !$this->esCoordenadaValida($this -> post['data']))
            {
                $return['message'] = 'Coordenadas no validas';
                $return['title'] = 'ALERTA';
                $return['type'] = 'warning';
                json($return);
            }

            $update = $urbanizationModel -> query('UPDATE urbanization SET office = :office WHERE id = :id');
            $update -> bindValue(':office', $this -> post['data']);
            $update -> bindValue(':id', $this -> post['id']);
            $result = $update -> execute();

            if ($result === true && $update -> rowCount() === 1) {
                $return['status'] = true;
            }
            json($return);
        }

        if ($this -> post['action'] == 'intro_uno')
        {
            if ($this -> post['data'] == $dataUrbanization['introduction_one']) {
                $return['status'] = true;
                json($return);
            }

            if ( mb_strlen($this -> post['data']) > 498 || ($this -> post['data']  != '' && mb_strlen($this -> post['data']) < 15)  || !isAlphaDash($this -> post['data'], ' ()[]-_.,;:') ) {
                $return['message'] = 'Introducción 1 no valida';
                $return['title'] = 'ALERTA';
                $return['type'] = 'warning';
                json($return);
            }

            $update = $urbanizationModel -> query('UPDATE urbanization SET introduction_one = :introduction_one WHERE id = :id');
            $update -> bindValue(':introduction_one', $this -> post['data']);
            $update -> bindValue(':id', $this -> post['id']);
            $result = $update -> execute();

            if ($result === true && $update -> rowCount() === 1) {
                $return['status'] = true;
            }
            json($return);
        }

        if ($this -> post['action'] == 'intro_dos')
        {
            if ($this -> post['data'] == $dataUrbanization['introduction_two']) {
                $return['status'] = true;
                json($return);
            }

            if ( mb_strlen($this -> post['data']) > 990 || ($this -> post['data']  != '' && mb_strlen($this -> post['data']) < 15)  || !isAlphaDash($this -> post['data'], ' ()[]-_.,;:') ) {
                $return['message'] = 'Introducción 2 no valida';
                $return['title'] = 'ALERTA';
                $return['type'] = 'warning';
                json($return);
            }

            $update = $urbanizationModel -> query('UPDATE urbanization SET introduction_two = :introduction_two WHERE id = :id');
            $update -> bindValue(':introduction_two', $this -> post['data']);
            $update -> bindValue(':id', $this -> post['id']);
            $result = $update -> execute();

            if ($result === true && $update -> rowCount() === 1) {
                $return['status'] = true;
            }
            json($return);
        }

        if ($this -> post['action'] == 'publicar')
        {
            if ($dataUrbanization['public'] == 1) {
                $return['status'] = true;
                json($return);
            }

            $update = $urbanizationModel -> query('UPDATE urbanization SET public = 1 WHERE id = :id');
            $update -> bindValue(':id', $this -> post['id']);
            $result = $update -> execute();

            if ($result === true && $update -> rowCount() === 1) {
                $return['status'] = true;
            }
            json($return);
        }

        if ($this -> post['action'] == 'publicar_video')
        {
            if ($dataUrbanization['video_overlay'] == 1) {
                $return['status'] = true;
                json($return);
            }

            $update = $urbanizationModel -> query('UPDATE urbanization SET video_overlay = 1 WHERE id = :id');
            $update -> bindValue(':id', $this -> post['id']);
            $result = $update -> execute();

            if ($result === true && $update -> rowCount() === 1) {
                $return['status'] = true;
            }
            json($return);
        }

        if ($this -> post['action'] == 'add_material')
        {
            if ( mb_strlen($this -> post['data']) > 198 || mb_strlen($this -> post['data']) < 5 || !isAlphaDash($this -> post['data'], ' ()[]-_.,;:') ) {
                $return['message'] = 'Nombre del Documento no válido';
                $return['title'] = 'ALERTA';
                $return['type'] = 'warning';
                json($return);
            }

            $arrayAux = [
                'urbanization_id' => $this -> post['id'],
                'name' => $this -> post['data']
            ];

            $materialModel = new UrbanizationDocModel();
            $insert = $materialModel -> value($arrayAux) -> insert();

            if ($insert > 0) {
                $return['status'] = true;
            }
            json($return);
        }

        if ($this -> post['action'] == 'add_contact')
        {
            $data = explode('--||--', $this -> post['data']);

            if (count($data) !== 3) {
                $return['message'] = 'Error';
                $return['title'] = 'ALERTA';
                $return['type'] = 'danger';
                json($return);
            }

            $name = trim($data[0]);
            $whatsApp = intval($data[1]);
            $email = trim($data[2]);

            if ($name === '' && $whatsApp == 0 && $email == '') {
                $return['message'] = 'Complete alguno de los campos';
                $return['title'] = 'ALERTA';
                $return['type'] = 'warning';
                json($return);
            }

            if ($whatsApp != 0 && ($whatsApp <= 900000000 || $whatsApp >= 999999999)) {
                $return['message'] = 'Ingrese un número de celular valido';
                $return['title'] = 'ALERTA';
                $return['type'] = 'warning';
                json($return);
            }

            if ($email != '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $return['message'] = 'Ingrese un correo valido';
                $return['title'] = 'ALERTA';
                $return['type'] = 'warning';
                json($return);
            }

            $arrayAux = [
                'urbanization_id' => $this -> post['id'],
                'name' => $name,
                'whatsapp' => $whatsApp,
                'email' => $email
            ];

            $materialModel = new UrbanizationContactModel();
            $insert = $materialModel -> value($arrayAux) -> insert();

            if ($insert > 0) {
                $return['status'] = true;
            }
            json($return);
        }

        if ($this -> post['action'] == 'add_modulo')
        {
            if ( mb_strlen($this -> post['data']) > 198 || mb_strlen($this -> post['data']) < 5 || !isAlphaDash($this -> post['data'], ' ()[]-_.,;:') ) {
                $return['message'] = 'Nombre del Módulo no válido';
                $return['title'] = 'ALERTA';
                $return['type'] = 'warning';
                json($return);
            }

            $arrayAux = [
                'urbanization_id' => $this -> post['id'],
                'name' => $this -> post['data'],
            ];

            $moduloModel = new UrbanizationModulesModel();
            $insert = $moduloModel -> value($arrayAux) -> insert();

            if ($insert > 0) {
                $return['status'] = true;
            }
            json($return);
        }

        if ($this -> post['action'] == 'add_indicador')
        {
            $arrayData = explode('--||--', $this -> post['data']);

            if (!isset($arrayData[0]) || !isset($arrayData[1])) {
                json($return);
            }

            $nameIndicador = trim($arrayData[0]);
            $idModulo = $arrayData[1];

            if (!ctype_digit($idModulo)) {
                json($return);
            }

            if ( mb_strlen($nameIndicador) > 198 || mb_strlen($nameIndicador) < 5 || !isAlphaDash($nameIndicador, ' ()[]-_.,;:') ) {
                $return['message'] = 'Nombre del Indicador no válido';
                $return['title'] = 'ALERTA';
                $return['type'] = 'warning';
                json($return);
            }

            $arrayAux = [
                'module_id' => $idModulo,
                'name' => $nameIndicador
            ];

            $moduloModel = new UrbanizationIndicatorModel();
            $insert = $moduloModel -> value($arrayAux) -> insert();

            if ($insert > 0) {
                $return['status'] = true;
            }
            json($return);
        }

        if ($this -> post['action'] == 'delete_material')
        {
            if ( !ctype_digit($this -> post['data']) ) {
                json($return);
            }

            $materialModel = new UrbanizationDocModel();
            $update = $materialModel -> query('DELETE FROM urbanization_doc WHERE urbanization_id = :urbanization_id AND id = :id');
            $update -> bindValue(':urbanization_id', $this -> post['id']);
            $update -> bindValue(':id', $this -> post['data']);
            $result = $update -> execute();

            if ($result === true && $update -> rowCount() === 1) {
                $return['status'] = true;
            }
            json($return);
        }

        if ($this -> post['action'] == 'delete_contact')
        {
            if ( !ctype_digit($this -> post['data']) ) {
                json($return);
            }

            $materialModel = new UrbanizationContactModel();
            $update = $materialModel -> query('DELETE FROM urbanization_contact WHERE urbanization_id = :urbanization_id AND id = :id');
            $update -> bindValue(':urbanization_id', $this -> post['id']);
            $update -> bindValue(':id', $this -> post['data']);
            $result = $update -> execute();

            if ($result === true && $update -> rowCount() === 1) {
                $return['status'] = true;
            }
            json($return);
        }

        if ($this -> post['action'] == 'delete_indicador')
        {
            if ( !ctype_digit($this -> post['data']) ) {
                json($return);
            }

            $materialModel = new UrbanizationIndicatorModel();
            $update = $materialModel -> query('DELETE FROM urbanization_indicator WHERE id = :id');
            $update -> bindValue(':id', $this -> post['data']);
            $result = $update -> execute();

            if ($result === true && $update -> rowCount() === 1) {
                $return['status'] = true;
            }
            json($return);
        }

        if ($this -> post['action'] == 'add_beneficio')
        {
            if ( mb_strlen($this -> post['data']) > 198 || mb_strlen($this -> post['data']) < 5 || !isAlphaDash($this -> post['data'], ' ()[]-_.,;:') ) {
                $return['message'] = 'Nombre del Beneficio no válido';
                $return['title'] = 'ALERTA';
                $return['type'] = 'warning';
                json($return);
            }

            $arrayAux = [
                'urbanization_id' => $this -> post['id'],
                'name' => $this -> post['data']
            ];

            $beneficioModel = new UrbanizationBenefitsModel();
            $insert = $beneficioModel -> value($arrayAux) -> insert();

            if ($insert > 0) {
                $return['status'] = true;
            }
            json($return);
        }

        if ($this -> post['action'] == 'delete_slider')
        {
            if ( !ctype_digit($this -> post['data']) ) {
                json($return);
            }

            $beneficioModel = new UrbanizationSliderModel();
            $update = $beneficioModel -> query('DELETE FROM urbanization_slider WHERE urbanization_id = :urbanization_id AND id = :id');
            $update -> bindValue(':urbanization_id', $this -> post['id']);
            $update -> bindValue(':id', $this -> post['data']);
            $result = $update -> execute();

            if ($result === true && $update -> rowCount() === 1) {
                $return['status'] = true;
            }
            json($return);
        }

        if ($this -> post['action'] == 'delete_bien')
        {
            if ( !ctype_digit($this -> post['data']) ) {
                json($return);
            }

            $beneficioModel = new UrbanizationBenefitsModel();
            $update = $beneficioModel -> query('DELETE FROM urbanization_benefit WHERE urbanization_id = :urbanization_id AND id = :id');
            $update -> bindValue(':urbanization_id', $this -> post['id']);
            $update -> bindValue(':id', $this -> post['data']);
            $result = $update -> execute();

            if ($result === true && $update -> rowCount() === 1) {
                $return['status'] = true;
            }
            json($return);
        }

        if ($this -> post['action'] == 'delete_modulo')
        {
            if ( !ctype_digit($this -> post['data']) ) {
                json($return);
            }

            $modelAux = new UrbanizationIndicatorModel();
            $indicadores = $modelAux -> getByModule($this -> post['data']);

            if ($indicadores != []) {
                $return['message'] = 'Para eliminar un módulo, este no debe tener algún indicador asociado';
                $return['title'] = 'ALERTA';
                $return['type'] = 'warning';
                json($return);
            }

            $update = $modelAux -> query('DELETE FROM urbanization_modules WHERE urbanization_id = :urbanization_id AND id = :id');
            $update -> bindValue(':urbanization_id', $this -> post['id']);
            $update -> bindValue(':id', $this -> post['data']);
            $result = $update -> execute();

            if ($result === true && $update -> rowCount() === 1) {
                $return['status'] = true;
            }
            json($return);
        }

        if ($this -> post['action'] == 'ocultar')
        {
            if ($dataUrbanization['public'] == 0) {
                $return['status'] = true;
                json($return);
            }

            $update = $urbanizationModel -> query('UPDATE urbanization SET public = 0 WHERE id = :id');
            $update -> bindValue(':id', $this -> post['id']);
            $result = $update -> execute();

            if ($result === true && $update -> rowCount() === 1) {
                $return['status'] = true;
            }
            json($return);
        }

        if ($this -> post['action'] == 'ocultar_video')
        {
            if ($dataUrbanization['video_overlay'] == 0) {
                $return['status'] = true;
                json($return);
            }

            $update = $urbanizationModel -> query('UPDATE urbanization SET video_overlay = 0 WHERE id = :id');
            $update -> bindValue(':id', $this -> post['id']);
            $result = $update -> execute();

            if ($result === true && $update -> rowCount() === 1) {
                $return['status'] = true;
            }
            json($return);
        }

        if ($this -> post['action'] == 'delete_curso')
        {
            if ($dataUrbanization['status'] == 0) {
                $return['status'] = true;
                json($return);
            }

            $update = $urbanizationModel -> query('UPDATE urbanization SET status = 0, public = 0 WHERE id = :id');
            $update -> bindValue(':id', $this -> post['id']);
            $result = $update -> execute();

            if ($result === true && $update -> rowCount() === 1) {
                $return['status'] = true;
            }
            json($return);
        }

        if ($this -> post['action'] == 'add_slider')
        {
            if (!isset($this -> post['data']) || !isset($this -> post['dataThree'])) {
                json($return);
            }

            if ($this -> post['data'] !== '0' && $this -> post['data'] !== '1') {
                json($return);
            }

            $description = trim($this -> post['dataThree']);

            if (strlen($description) > 96) {
                json($return);
            }

            $isImage = null;

            if ($this -> post['data'] === '0') {
                $isImage = false;
            } else if ($this -> post['data'] === '1') {
                $isImage = true;
            }

            if ($isImage === null) {
                json($return);
            }

            $file = '';

            if ($isImage)
            {
                if (!isset($this -> files['dataTwo']['error']) || !isset($this -> files['dataTwo']['name']) || !isset($this -> files['dataTwo']['size']) || !isset($this -> files['dataTwo']['tmp_name']) || !isset($this -> files['dataTwo']['type']))
                {
                    $return['message'] = 'Imagen no válida';
                    $return['title'] = 'ALERTA';
                    $return['type'] = 'warning';
                    json($return);
                }

                if ($this -> files['dataTwo']['error'] !== 0 || ($this -> files['dataTwo']['type'] !== 'image/jpeg' && $this -> files['dataTwo']['type'] !== 'image/png') || intval($this -> files['dataTwo']['size']) <= 100)
                {
                    $return['message'] = 'Imagen no válida';
                    $return['title'] = 'ALERTA';
                    $return['type'] = 'warning';
                    json($return);
                }

                $extension = getExtension($this -> files['dataTwo']['name']);
                $newName = nameForFiles($dataUrbanization['name'], $extension) . '.' . $extension;

                if (trim($extension) == '' || trim($newName) == '')
                {
                    $return['message'] = 'Imagen no válida';
                    $return['title'] = 'ALERTA';
                    $return['type'] = 'warning';
                    json($return);
                }

                $newName = date('ynjGis') . rand(100, 999) . '_' . $newName;
                $newPath = Helper::public_path() . '/assets/admin/images/slider/' . $newName;

                $auxMoveFile = move_uploaded_file($this -> files['dataTwo']['tmp_name'], $newPath);

                if ($auxMoveFile !== true) {
                    $return['message'] = 'Error al guardar la imagen';
                    json($return);
                }

                $file = $newName;
            }
            else
            {
                $video = trim($this -> post['dataTwo']);

                $video = explode( 'https://www.youtube.com/watch?v=', $video);

                if (count($video) > 1) {
                    if (trim($video[1]) != '') {
                        $video = explode('&', $video[1]);
                        $video = trim($video[0]);
                        if ($video == '') {
                            $video = null;
                        }
                    } else {
                        $video = null;
                    }
                } else {
                    $video = null;
                }

                if ($video == null)
                {
                    $video = trim($this -> post['dataTwo']);

                    $video = explode( 'https://youtu.be/', $video);

                    if (count($video) > 1) {
                        if (trim($video[1]) != '') {
                            $video = explode('&', $video[1]);
                            $video = trim($video[0]);
                            if ($video == '') {
                                $video = null;
                            }
                        } else {
                            $video = null;
                        }
                    } else {
                        $video = null;
                    }
                }

                if ($video == null) {
                    $return['message'] = 'Link del no válido';
                    $return['title'] = 'ALERTA';
                    $return['type'] = 'warning';
                    json($return);
                }

                if ( mb_strlen($video) > 20 || mb_strlen($video) < 3 || !isAlphaDash($video, ' ()[]-_.,;:') ) {
                    $return['message'] = 'Link del no válido';
                    $return['title'] = 'ALERTA';
                    $return['type'] = 'warning';
                    json($return);
                }

                $file = $video;
            }

            $urbanizationSliderModel = new UrbanizationSliderModel();
            $insert = $urbanizationSliderModel
                -> value([
                    'urbanization_id' => $this -> post['id'],
                    'description' => $description,
                    'file' => $file,
                    'is_video' => $isImage ? 0 : 1
                ])
                -> insert();

            if ($insert > 0) {
                $return['status'] = true;
                $return['id'] = $insert;
            }

            json($return);
        }

        if ($this -> post['action'] == 'image')
        {
            if (!isset($this -> files['data']['error']) || !isset($this -> files['data']['name']) || !isset($this -> files['data']['size']) || !isset($this -> files['data']['tmp_name']) || !isset($this -> files['data']['type']))
            {
                $return['message'] = 'Imagen no válida';
                $return['title'] = 'ALERTA';
                $return['type'] = 'warning';
                json($return);
            }

            if ($this -> files['data']['error'] !== 0 || ($this -> files['data']['type'] !== 'image/jpeg' && $this -> files['data']['type'] !== 'image/png') || intval($this -> files['data']['size']) <= 100)
            {
                $return['message'] = 'Imagen no válida';
                $return['title'] = 'ALERTA';
                $return['type'] = 'warning';
                json($return);
            }

            $extension = getExtension($this -> files['data']['name']);
            $newName = nameForFiles($dataUrbanization['name'], $extension) . '.' . $extension;

            if (trim($extension) == '' || trim($newName) == '')
            {
                $return['message'] = 'Imagen no válida';
                $return['title'] = 'ALERTA';
                $return['type'] = 'warning';
                json($return);
            }

            $newName = date('ynjGis') . rand(100, 999) . '_' . $newName;
            $newPath = Helper::public_path() . '/assets/admin/images/urbanization/' . $newName;

            $auxMoveFile = move_uploaded_file($this -> files['data']['tmp_name'], $newPath);

            if ($auxMoveFile !== true) {
                $return['message'] = 'Error al guardar la imagen';
                json($return);
            }

            $update = $urbanizationModel -> query('UPDATE urbanization SET image = :image WHERE id = :id');
            $update -> bindValue(':image', $newName);
            $update -> bindValue(':id', $this -> post['id']);
            $result = $update -> execute();

            if ($result === true && $update -> rowCount() === 1) {
                $return['status'] = true;
            }
            json($return);
        }

        if ($this -> post['action'] == 'brochure')
        {
            if (!isset($this -> files['data']['error']) || !isset($this -> files['data']['name']) || !isset($this -> files['data']['size']) || !isset($this -> files['data']['tmp_name']) || !isset($this -> files['data']['type']))
            {
                $return['message'] = 'PDF no válido';
                $return['title'] = 'ALERTA';
                $return['type'] = 'warning';
                json($return);
            }

            if ($this -> files['data']['error'] !== 0 || $this -> files['data']['type'] !== 'application/pdf' || intval($this -> files['data']['size']) <= 100)
            {
                $return['message'] = 'PDF no válido';
                $return['title'] = 'ALERTA';
                $return['type'] = 'warning';
                json($return);
            }

            $extension = getExtension($this -> files['data']['name']);
            $newName = nameForFiles($dataUrbanization['name'], $extension) . '.' . $extension;

            if (trim($extension) == '' || trim($newName) == '')
            {
                $return['message'] = 'PDF no válido';
                $return['title'] = 'ALERTA';
                $return['type'] = 'warning';
                json($return);
            }

            $newName = date('ynjGis') . rand(100, 999) . '_' . $newName;
            $newPath = Helper::public_path() . '/assets/admin/docs/house-plans/' . $newName;

            $auxMoveFile = move_uploaded_file($this -> files['data']['tmp_name'], $newPath);

            if ($auxMoveFile !== true) {
                $return['message'] = 'Error al guardar el PDF';
                json($return);
            }

            $update = $urbanizationModel -> query('UPDATE urbanization SET plan = :plan WHERE id = :id');
            $update -> bindValue(':plan', $newName);
            $update -> bindValue(':id', $this -> post['id']);
            $result = $update -> execute();

            if ($result === true && $update -> rowCount() === 1) {
                $return['status'] = true;
            }
            json($return);
        }

        json($return);
    }

    public function create()
    {
        $this -> isPost();

        $return = [
            'status' => false,
            'message' => 'Ocurrió un error inesperado',
            'title' => 'ERROR',
            'id' => 0,
            'type' => 'danger'
        ];

        if (!isset($this -> post['name']) ||
        ( isset($this -> post['name']) &&
        ( mb_strlen($this -> post['name']) > 198 || mb_strlen($this -> post['name']) < 5 || !isAlphaDash($this -> post['name'], ' ()[]-_.,;:')) ) )
        {
            $return['message'] = 'Nombre de la Habilitación Urbana no valida';
            $return['title'] = 'ALERTA';
            $return['type'] = 'warning';
            json($return);
        }

        $urbanizationName = $this -> post['name'];

        $urbanizationModel = new UrbanizationModel();
        $insert = $urbanizationModel -> value(['name' => $urbanizationName]) -> insert();

        if ($insert > 0) {
            $return['status'] = true;
            $return['id'] = $insert;
        }

        json($return);
    }

    public function getTable()
    {
        $urbanization = new UrbanizationModel();
        $urbanizationData = $urbanization -> getUrbanizationTable();

        $sinBrochure = '<div class="text-center">No Tiene</div>';
        $estado = [
            '<div class="text-center">
                <span class="position-relative pe-2">
                    No Publicado
            
                    <span class="position-absolute top-0 start-100 translate-bottom p-2 bg-info border border-light rounded-circle">
                        <span class="visually-hidden"></span>
                    </span>
                </span>
            </div>',
            '<div class="text-center">
                <span class="position-relative pe-2">
                    Publicado
            
                    <span class="position-absolute top-0 start-100 translate-bottom p-2 bg-success border border-light rounded-circle">
                        <span class="visually-hidden"></span>
                    </span>
                </span>
            </div>'
        ];

        $action = [
            ' d-block',
            '<div class="text-center',
            '"> <a href="' . $this -> base_url() . '/urbanizaciones/editar/',
            '" class="fw-bold text-decoration-none text-primary">Ver Más <i class="fa-solid fa-angles-right"></i></a>
            </div>'
        ];

        $actionDos = [
            ' d-block',
            '<div class="text-center',
            '"> <a data-id="',
            '" data-nombre="',
            '" class="fw-bold text-decoration-none text-primary btn_select_curso" type="button">Elegir <i class="fa-solid fa-hand-pointer"></i></a>
            </div>'
        ];

        $linkBrochure = [
            '<div class="text-center">
                <a target="_blank" href="' . Helper::assets_url() . '/admin/docs/house-plans/',
            '" class="fw-bold text-decoration-none">Ver Plano <i class="fa-solid fa-arrow-up-right-from-square"></i></a>
            </div>'
        ];

        foreach ($urbanizationData as $key => $value)
        {
            $urbanizationData[$key]['number'] = $key + 1;
            $urbanizationData[$key]['plan'] = ($value['plan'] == '') ? $sinBrochure : $linkBrochure[0] . $urbanizationData[$key]['plan'] . $linkBrochure[1];
            $urbanizationData[$key]['public'] = $estado[$value['public']];
            $urbanizationData[$key]['actions'] = $action[1] . $action[0] . $action[2] . $value['id'] . $action[3];
            $action[0] = '';

            $urbanizationData[$key]['actions_select'] = $actionDos[1] . $actionDos[0] . $actionDos[2] . $value['id'] . $actionDos[3] . $value['name'] . $actionDos[4];
            $actionDos[0] = '';

            $urbanizationData[$key]['created'] = '<div class="text-center">' . date('d-m-Y', strtotime($value['created'])) . '</div>';
        }

        json($urbanizationData);
    }

    public function esCoordenadaValida($coordenada): bool
    {
        // Patrón de expresión regular para validar la coordenada
        $patron = '/^[-]?[0-9]{1,3}(?:\.[0-9]+)?,[-]?[0-9]{1,3}(?:\.[0-9]+)?$/';

        // Verificar si la cadena coincide con el patrón de coordenada
        if (preg_match($patron, $coordenada)) {
            // Dividir la cadena en partes separadas por ","
            $partes = explode(",", $coordenada);
            $latitud = floatval($partes[0]);
            $longitud = floatval($partes[1]);

            // Verificar los rangos de latitud y longitud
            if ($latitud >= -90 && $latitud <= 90 && $longitud >= -180 && $longitud <= 180) {
                return true;
            }
        }

        return false;
    }

}
