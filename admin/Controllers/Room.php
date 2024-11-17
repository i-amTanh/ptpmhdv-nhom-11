<?php

namespace Admin\Controllers;


use Admin\Models\RoomModel;
use CodeIgniter\Config\Services;

class Room extends BaseController {
    public function roomIndex(): string
    {
        $model = new RoomModel();
        $rooms = $model->findAll();
        $data = [
            'title' => 'Admin',
            'rooms' => $rooms,
        ];
        return $this->render('room-index',$data);
    }

    /**
     * @throws \ReflectionException
     */
    public function roomCreate(): string
    {
        if ($this->request->getMethod() === 'POST') {
            $model = new RoomModel();

            $data = [
                'resort_id'      => $this->request->getPost('resort_id'),
                'room_type'      => $this->request->getPost('room_type'),
                'price_per_night' => $this->request->getPost('price_per_night'),
                'availability'  => $this->request->getPost('availability'),
                'max_occupancy'  => $this->request->getPost('max_occupancy'),
                'description'     => $this->request->getPost('description'),
                'image'             => $this->request->getPost('image'),
            ];

            if ($model->insert($data)) {
                echo '<script>
                        alert("Success!");
                        window.location.href = "/admin/room";
                      </script>';
            } else {
                print_r($model->errors());
            }
        }

        return $this->render('roomCreate');
    }

    /**
     * @throws \ReflectionException
     */
    public function roomUpdate($id = false): string
    {
        $model   = new roomModel();
        $room = $model->find($id);
        if ($this->request->getMethod() === 'POST') {
            $data = [
                'resort_id'      => $this->request->getPost('resort_id'),
                'room_type'      => $this->request->getPost('room_type'),
                'price_per_night' => $this->request->getPost('price_per_night'),
                'availability'  => $this->request->getPost('availability'),
                'max_occupancy'  => $this->request->getPost('max_occupancy'),
                'description'     => $this->request->getPost('description'),
                'image'             => $this->request->getPost('image'),
            ];

            if ($model->update($id, $data)) {
                echo '<script>
                    alert("Success!");
                    window.location.href = "/admin/room"; // Đường dẫn đến trang index
                  </script>';
            } else {
                print_r($model->errors());
            }
        }
        $data = [
            'room' => $room,
        ];
        return $this->render('roomUpdate',$data);
    }

    public function roomDelete()
    {
        if ($this->request->getMethod() === 'POST') {
            $model = new RoomModel();
            $id    = $this->request->getPost('id');

            if ($id) {
                if ($model->delete($id)) {
                    return $this->response->redirect('/admin/room');
                }
                print_r($model->errors());
            }
        }
    }

    public function roomView($id = false) {
        $model   = new RoomModel();
        $room = $model->find($id);

        $data = [
            'room' => $room,
        ];

        if ($this->request->getMethod() === 'POST') {
            return redirect()->to('admin/room/update/' . $id);
        }

        return $this->render('roomView',$data);
    }

}