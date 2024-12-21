<?php

namespace App\Entities;

use App\Entities\Entity;

/**
 * Class PrintHistoryEntity
 * Đại diện cho dữ liệu của một lịch sử in.
 */
class PrintHistoryEntity extends Entity {
    private $id;
    private $user_id;
    private $printer_id;
    private $file_name;
    private $pages;
    private $created_at;
    /**
     * Constructor của PrintHistoryEntity.
     *
     * @param int|null $id ID của lịch sử in (null nếu là lịch sử mới).
     * @param string|null $user_id id của người dùng.
     * @param string|null $printer_id id của máy in.
     * @param string|null $file_name tên file in.
     * @param string|null $pages số lượng trang in.
     * @param string|null $created_at ngày in.
     */
    public function __construct($id = null, $user_id = null, $printer_id = null, $file_name = null, $pages = null, $created_at = null) {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->printer_id = $printer_id;
        $this->file_name = $file_name;
        $this->pages = $pages;
    }

    /**
     * Lấy ID của lịch sử in.
     *
     * @return int|null ID của lịch sử in.
     */
    public function getId() { return $this->id; }

    /**
     * Thiết lập ID cho lịch sử in.
     *
     * @param int $id ID của lịch sử in.
     */
    public function setId($id) { $this->id = $id; }

    /**
     * Lấy user_id của lịch sử in.
     *
     * @return string|null id của người dùng.
     */
    public function getUserId() { return $this->user_id; }

    /**
     * Thiết lập user_id cho lịch sử in.
     *
     * @param string $user_id id của người dùng.
     */
    public function setUserId($user_id) { $this->user_id = $user_id; }

    /**
     * Lấy id của máy in.
     *
     * @return string|null id của máy in.
     */
    public function getPrinterId() { return $this->printer_id; }

    /**
     * Thiết lập printer_id cho lịch sử in.
     *
     * @param string $printer_id id máy in của lịch sử in.
     */
    public function setPrinterId($printer_id) { $this->printer_id = $printer_id; }

    /**
     * Lấy tên file của lịch sử in.
     *
     * @return string|null file_name của lịch sử in.
     */
    public function getFileName() { return $this->file_name; }

    /**
     * Thiết lập file name cho lịch sử in.
     *
     * @param string $file_name tên file của lịch sử in.
     */
    public function setFileName($file_name) { $this->file_name = $file_name; }

    /**
     * Lấy số lượng trang của lịch sử in.
     *
     * @return string|null pages của lịch sử in.
     */
    public function getPages() { return $this->file_name; }

    /**
     * Thiết lập số lượng trang cho lịch sử in.
     *
     * @param string $file_name tên file của lịch sử in.
     */
    public function setPages($pages) { $this->pages = $pages; }
    
    /**
     * Trả về thông tin lịch sử in dưới dạng mảng.
     *
     * @return array Mảng chứa thông tin lịch sử in.
     */
    public function toArray() {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'printer_id' => $this->printer_id,
            'file_name' => $this->file_name,
            'pages' => $this->pages,
        ];
    }
}
?>
