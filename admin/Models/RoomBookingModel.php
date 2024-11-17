<?php

namespace Admin\Models;

use Admin\Entities\RoomBooking;
use CodeIgniter\Model;

class RoomBookingModel extends Model {
    protected $table = 'roombooking';
    protected $primaryKey    = 'id';
    protected $returnType    = RoomBooking::class;
    protected $allowedFields = [
        'id',
        'customer_id',
        'room_id',
        'check_in_date',
        'check_out_date',
        'status',
        'total_amount',
    ];

    // Lấy tổng số đặt phòng theo ngày
    public function getTotalBookingsByDate($date)
    {
        return $this->where('DATE(check_in_date)', $date)->countAllResults();
    }

    // Lấy tổng doanh thu theo ngày
    public function getTotalRevenueByDate($date)
    {
        return $this->selectSum('total_amount', 'total_amount')
            ->where('DATE(check_in_date)', $date)
            ->first();
    }

    // Lấy tổng số đặt phòng trong tuần
    public function getTotalBookingsByWeek($week)
    {
        return $this->where('WEEK(check_in_date)', $week)->countAllResults();
    }

    // Lấy tổng doanh thu trong tuần
    public function getTotalRevenueByWeek($week)
    {
        return $this->selectSum('total_amount', 'total_amount')
            ->where('WEEK(check_in_date)', $week)
            ->first();
    }

    // Lấy tổng số đặt phòng trong tháng
    public function getTotalBookingsByMonth($month)
    {
        return $this->where('MONTH(check_in_date)', $month)->countAllResults();
    }

    // Lấy tổng doanh thu trong tháng
    public function getTotalRevenueByMonth($month)
    {
        return $this->selectSum('total_amount', 'total_amount')
            ->where('MONTH(check_in_date)', $month)
            ->first();
    }

}