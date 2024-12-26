<?php

namespace Admin\Controllers;

use Admin\Libraries\Menu;
use Admin\Models\RoomBookingModel;

/**
 * Class Home.
 *
 * This is the default Admin controller.
 */
class Home extends BaseController
{
    /**
     * Default action.
     */
    public function index(): string
    {
        $model = new RoomBookingModel();

        $today = date('Y-m-d');
        $week = date('YW');
        $month = date('m');

        // Lấy dữ liệu từ model
        $todayBookings = $model->getTotalBookingsByDate($today);
        $todayRevenue = $model->getTotalRevenueByDate($today);
        $weekBookings = $model->getTotalBookingsByWeek($week);
        $weekRevenue = $model->getTotalRevenueByWeek($week);
        $monthBookings = $model->getTotalBookingsByMonth($month);
        $monthRevenue = $model->getTotalRevenueByMonth($month);

        $data = [
            'title' => 'Admin',
            'todayBookings' => $todayBookings,
            'todayRevenue' => $todayRevenue ? $todayRevenue->total_amount : 0,
            'weekBookings' => $weekBookings,
            'weekRevenue' => $weekRevenue ? $weekRevenue->total_amount : 0,
            'monthBookings' => $monthBookings,
            'monthRevenue' => $monthRevenue ? $monthRevenue->total_amount : 0,
        ];

        return $this->render('dashboard-index', $data);
    }

}
