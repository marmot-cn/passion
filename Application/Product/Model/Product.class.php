<?php
namespace Product\Model;

use Common\Model\ModifyTime;
use Common\Model\Status;

/**
 * Product 商品领域对象
 * @author chloroplast
 * @version 1.0.0:2016.07.03
 */

class Product
{
    /**
     * @var ModifyTime 时间性状
     */
    use ModifyTime;
    /**
     * @var Status 状态性状
     */
    use Status;
    /**
     * @var int $id 新闻id
     */
    private $id;
    /**
     * @var string $title 标题
     */
    private $title;
    /**
     * @var string $content 内容
     */
    private $content;
    /**
     * @var \Product\Model\Brand $brand 品牌
     */
    private $brand;
    /**
     * @var \Product\Model\Category $category 分类
     */
    private $category;
    /**
     * @var string $model 尺寸
     */
    private $model;
    /**
     * @var string $number 产品编号
     */
    private $number;
    /**
     * @var string $moq 最小订单量
     */
    private $moq;
    /**
     * @var string $warrantyTime 质保时间
     */
    private $warrantyTime;
    /**
     * @var string $certificates 证书
     */
    private $certificates;

    /**
     * Product 商品领域对象 构造函数
     */
    public function __construct(int $id = 0)
    {
        global $_FWGLOBAL;
        $this->id = !empty($id) ? $id : 0;
        $this->title = '';
        $this->content = '';
        $this->createTime = $_FWGLOBAL['timestamp'];
        $this->updateTime = $_FWGLOBAL['timestamp'];
        $this->statusTime = $_FWGLOBAL['timestamp'];
        $this->status = STATUS_NORMAL;
        $this->brand = new \Product\Model\Brand();
        $this->category = new \Product\Model\Category();
        $this->model = '';
        $this->number = '';
        $this->moq = '';
        $this->warrantyTime = '';
        $this->certificates = '';
    }

    /**
     * Product 商品领域对象 析构函数
     */
    public function __destruct()
    {
        unset($this->id);
        unset($this->title);
        unset($this->content);
        unset($this->createTime);
        unset($this->updateTime);
        unset($this->statusTime);
        unset($this->status);
        unset($this->brand);
        unset($this->category);
        unset($this->model);
        unset($this->number);
        unset($this->moq);
        unset($this->warrantyTime);
        unset($this->certificates);
    }

    /**
     * 设置新闻id
     * @param int $id 新闻id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * 获取新闻id
     * @return int $id 新闻id
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * 设置标题
     * @param string $title 标题
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * 获取标题
     * @return string $title 标题
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * 设置内容
     * @param string $content 内容
     */
    public function setContent(string $content)
    {
        $this->content = $content;
    }

    /**
     * 获取内容
     * @return string $content 内容
     */
    public function getContent()
    {
        return $this->content;
    }
    
    /**
     * 设置品牌
     * @param \Product\Model\Brand $brand 品牌
     */
    public function setBrand(\Product\Model\Brand $brand)
    {
        $this->brand = $brand;
    }

    /**
     * 获取品牌
     * @return \Product\Model\Brand $brand 品牌
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * 设置分类
     * @param \Product\Model\Category $category 分类
     */
    public function setCategory(\Product\Model\Category $category)
    {
        $this->category = $category;
    }

    /**
     * 获取分类
     * @return \Product\Model\Category $category 分类
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * 设置尺寸
     * @param string $model 尺寸
     */
    public function setModel(string $model)
    {
        $this->model = $model;
    }

    /**
     * 获取尺寸
     * @return string $model 尺寸
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * 设置产品编号
     * @param string $number 产品编号
     */
    public function setNumber(string $number)
    {
        $this->number = $number;
    }

    /**
     * 获取产品编号
     * @return string $number 产品编号
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * 设置最小订单量
     * @param string $moq 最小订单量
     */
    public function setMoq(string $moq)
    {
        $this->moq = $moq;
    }

    /**
     * 获取最小订单量
     * @return string $moq 最小订单量
     */
    public function getMoq()
    {
        return $this->moq;
    }

    /**
     * 设置质保时间
     * @param string $warrantyTime 质保时间
     */
    public function setWarrantyTime(string $warrantyTime)
    {
        $this->warrantyTime = $warrantyTime;
    }

    /**
     * 获取质保时间
     * @return string $warrantyTime 质保时间
     */
    public function getWarrantyTime()
    {
        return $this->warrantyTime;
    }

    /**
     * 设置证书
     * @param string $certificates 证书
     */
    public function setCertificates(string $certificates)
    {
        $this->certificates = $certificates;
    }

    /**
     * 获取证书
     * @return string $certificates 证书
     */
    public function getCertificates()
    {
        return $this->certificates;
    }
}