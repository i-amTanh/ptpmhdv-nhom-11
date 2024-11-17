<?php

namespace Admin\Controllers;


use Admin\Models\ResortModel;

class Resort extends BaseController {
    public function resortIndex(): string
    {
        $model = new ResortModel();
        $resorts = $model->findAll();
        $data = [
            'title' => 'Admin',
            'resorts' => $resorts,
        ];
        return $this->render('resort-index',$data);
    }

    /**
     * @throws \ReflectionException
     */
    public function resortCreate(): string
    {
        if ($this->request->getMethod() === 'POST') {
            $model = new ResortModel();

            $data = [
                'resort_name'      => $this->request->getPost('resort_name'),
                'location'         => $this->request->getPost('location'),
                'description'      => $this->request->getPost('description'),
                'rating'           => $this->request->getPost('rating'),
                'image'             => $this->request->getPost('image'),
            ];

            if ($model->insert($data)) {
                echo '<script>
                        alert("Thêm thành công!");
                        window.location.href = "/admin/resort"; // Đường dẫn đến trang index
                      </script>';
            } else {
                print_r($model->errors());
            }
        }

        return $this->render('resortCreate');
    }

    /**
     * @throws \ReflectionException
     */
    public function resortUpdate($id = false): string
    {
        $model   = new ResortModel();
        $resort = $model->find($id);
        if ($this->request->getMethod() === 'POST') {
            $data = [
                'resort_name'      => $this->request->getPost('resort_name'),
                'location'         => $this->request->getPost('location'),
                'description'      => $this->request->getPost('description'),
                'rating'           => $this->request->getPost('rating'),
                'image'             => $this->request->getPost('image'),
            ];

            if ($model->update($id, $data)) {
                echo '<script>
                    alert("Cập nhật thành công!");
                    window.location.href = "/admin/resort"; 
                  </script>';
            } else {
                print_r($model->errors());
            }
        }
        $data = [
            'resort' => $resort,
        ];
        return $this->render('resortUpdate',$data);
    }

    public function resortDelete()
    {
        if ($this->request->getMethod() === 'POST') {
            $model = new ResortModel();
            $id    = $this->request->getPost('id');

            if ($id) {
                if ($model->delete($id)) {
                    return $this->response->redirect('/admin/resort');
                }
                print_r($model->errors());
            }
        }
    }

    public function resortView($id = false) {
        $model   = new ResortModel();
        $resort = $model->find($id);

        $data = [
            'resort' => $resort,
        ];

        if ($this->request->getMethod() === 'POST') {
            return redirect()->to('admin/resort/update/' . $id);
        }

        return $this->render('resortView',$data);
    }

}