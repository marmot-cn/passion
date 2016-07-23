<?php
namespace Admin\Controller;

use System\Classes\Controller;
use Marmot\Core;
use Product\Model\Product;

class ProductController extends Controller
{

    use AdminController;

    public function __construct()
    {
        parent::__construct();

        $this->getResponse()->view()->assign('productSideBar', true);
    }

    /**
     * 列表
     */
    public function index()
    {
        $perpage = 20;
        $curpage = !empty($_GET['page']) ? $_GET['page'] : 1;
        $start = ($curpage-1)*$perpage;

        $this->getResponse()->view()->assign('productListRef', true);

        $productList = array();

        $filter = is_array($this->getRequest()->get('filter')) ? $this->getRequest()->get('filter') : array();

        $repository = Core::$container->get('Product\Repository\Product\ProductRepository');
        list($num, $productList) = $repository->filter(
            $filter,
            array(),
            $start,
            $perpage
        );

        $urlCondition = http_build_query(array('filter'=>$filter));
       
        $multi = $this->getResponse()->multiPages(
            $num,
            $perpage,
            $curpage,
            '/Admin/Product?'.$urlCondition
        );

        $this->getResponse()->view()->assign('productList', $productList);
        $this->getResponse()->view()->assign('multi', $multi);
        $this->getResponse()->view()->display('Admin/productIndex.tpl');
    }

    /**
     * 保存
     */
    public function save(int $productId = 0)
    {
        $this->getResponse()->view()->assign('producSaveRef', true);

        $product = new Product();
        if (!empty($productId)) {
            $repository = Core::$container->get('Product\Repository\Product\ProductRepository');
            $product = $repository->getOne($productId);
        }
        //品牌
        $repository = Core::$container->get('Product\Repository\Brand\BrandRepository');
        $brandList = $repository->filter(
            array('status'=>STATUS_NORMAL),
            array(),
            0,
            0,
            false
        );

        $this->getResponse()->view()->assign('product', $product);
        $this->getResponse()->view()->assign('brandList', $brandList);
        $this->getResponse()->view()->display('Admin/productSave.tpl');
    }

    /**
     * 保存
     */
    public function action()
    {
        $this->getResponse()->view()->assign('producSaveRef', true);

        $title = $this->getRequest()->post('title');
        $content = $this->getRequest()->post('content');
        $brand = $this->getRequest()->post('brand');
        $categroy = $this->getRequest()->post('categroy');
        $model = $this->getRequest()->post('model');
        $number = $this->getRequest()->post('number');
        $moq = $this->getRequest()->post('moq');
        $warrantyTime = $this->getRequest()->post('warrantyTime');
        $certificates = $this->getRequest()->post('certificates');
        $id = $this->getRequest()->post('productId');
        /**
         * 数据校验
         */
        $product = new Product(intval($id));
        $product->setTitle($title);
        $product->setContent($content);
        $product->getBrand()->setId($brand);
        $product->getCategory()->setId($categroy);
        $product->setModel($model);
        $product->setNumber($number);
        $product->setMoq($moq);
        $product->setWarrantyTime($warrantyTime);
        $product->setCertificates($certificates);

        if (isset($_FILES)) {
            $product->getLogo()->upload('logo');
        }
        
        $product->save();

        $this->message('保存成功', '/Admin/Product/'.$product->getId());
    }


    /**
     * 详情
     */
    public function get(int $productId = 0)
    {
        $this->getResponse()->view()->assign('productListRef', true);

        $repository = Core::$container->get('Product\Repository\Product\ProductRepository');

        $product = new Product();
        $product = $repository->getOne($productId);
 
        $this->getResponse()->view()->assign('product', $product);
        $this->getResponse()->view()->display('Admin/productGet.tpl');
    }

    /**
     * 删除
     */
    public function delete(int $productId = 0)
    {
        $this->getResponse()->view()->assign('productListRef', true);

        $product = new Product($productId);
        $product->delete();

        $this->message('删除成功', '/Admin/Product');
    }

    /**
     * 幻灯列表
     */
    public function slides(int $productId)
    {
        $this->getResponse()->view()->assign('productListRef', true);

        $repository = Core::$container->get('Product\Repository\Product\ProductRepository');

        $product = new Product();
        $product = $repository->getOne($productId);
        
        $this->getResponse()->view()->assign('product', $product);
        $this->getResponse()->view()->display('Admin/productSlides.tpl');
    }

    /**
     * 添加幻灯片页面
     */
    public function slidesSave(int $productId)
    {
        $this->getResponse()->view()->assign('productListRef', true);

        $repository = Core::$container->get('Product\Repository\Product\ProductRepository');

        $product = new Product();
        $product = $repository->getOne($productId);
        
        $this->getResponse()->view()->assign('product', $product);
        $this->getResponse()->view()->display('Admin/productSlidesSave.tpl');
    }

    /**
     * 保存幻灯片
     */
    public function slidesAction(int $productId)
    {
        // $productId = $this->getRequest()->post('productId');
        $product = new Product($productId);

        if (isset($_FILES)) {
            $file = Core::$container->make('Common\Model\File');
            $file->upload('slide');
            $product->addSlide($file);

            $this->message('添加轮播图成功', '/Admin/Product/'.$productId.'/Slides');
        }

        return false;
    }

    /**
     * 删除幻灯片
     */
    public function slidesDelete(int $productId, int $fileId)
    {
        $this->getResponse()->view()->assign('productListRef', true);

        $file = Core::$container->make('Common\Model\File', ['id'=>$fileId]);
        
        $product = new Product($productId);
        $product->deleteSlide($file);

        $this->message('删除成功', '/Admin/Product/'.$productId.'/Slides');
    }
}