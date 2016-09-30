<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__."/../inc/Connection.php";
    require_once __DIR__.'/../src/Store.php';
    require_once __DIR__."/../src/Brand.php";

//Setup
    $app = new Silex\Application();
    $app['debug'] = true;
    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

//Home Path
    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig', array('stores' => Store::getAll(), 'brands' => Brand::getAll()));
    });

//Stores Path
    $app->get("/stores", function() use ($app) {
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
    });

    $app->post("/stores", function() use ($app) {
        $store = new Store($_POST['name']);
        $store->save();
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
    });

    $app->post("/add_brands", function() use ($app) {
        $store = Store::findById($_POST['store_id']);
        $brand = Brand::findById($_POST['brand_id']);
        $store->addJoinList($brand);
        return $app['twig']->render('store.html.twig', array('store' => $store, 'stores' => Store::getAll(), 'brands' => $store->getJoinList(), 'all_brands' => Brand::getAll()));
    });

    $app->get("/stores/{id}", function($id) use ($app) {
        $store = Store::findById($id);
        return $app['twig']->render('store.html.twig', array('store' => $store, 'brands' => $store->getJoinList(), 'all_brands' => Brand::getAll()));
    });

    $app->post("delete_stores", function() use ($app) {
        Store::deleteAll();
        return $app['twig']->render('index.html.twig');
    });

//Edit Stores

    $app->get("/stores/{id}/edit", function($id) use ($app) {
        $store = Store::findById($id);
        return $app['twig']->render('store_edit.html.twig', array('store' => $store));
    });

    $app->patch("/stores/{id}", function($id) use ($app) {
        $name = $_POST['name'];
        $store = Store::findById($id);
        $store->update($name);
        return $app['twig']->render('store.html.twig', array('store' => $store, 'brands' => $store->getJoinList(), 'all_brands' => Brand::getAll()));
    });

//Delete Store
    $app->delete("/stores/{id}", function($id) use ($app) {
        $store = Store::findById($id);
        $store->delete();
        return $app['twig']->render('index.html.twig');
    });


//Brands Path
    $app->get("/brands", function() use ($app) {
            return $app['twig']->render('brands.html.twig', array('brands' => Brand::getAll()));
    });

    $app->post("/brands", function() use ($app) {
        $brand = new Brand($_POST['name']);
        $brand->save();
        return $app['twig']->render('brands.html.twig', array('brands' => Brand::getAll()));
    });

    $app->get("/brands/{id}", function($id) use ($app) {
        $brand = Brand::findById($id);
        return $app['twig']->render('brand.html.twig', array('brand' => $brand, 'stores' => $brand->getJoinList(), 'all_stores' => Store::getAll()));
    });

    $app->post("/add_stores", function() use ($app) {
        $brand = Brand::findById($_POST['brand_id']);
        $store = Store::findById($_POST['store_id']);
        $brand->addJoinList($store);
        return $app['twig']->render('brand.html.twig', array('brand' => $brand, 'brands' => Brand::getAll(), 'stores' => $brand->getJoinList(), 'all_stores' => Store::getAll()));
    });

    $app->post("delete_brands", function() use ($app) {
        Brands::deleteAll();
        return $app['twig']->render('index.html.twig');
    });

//Edit Brands Path
    $app->get("/brands/{id}/edit", function($id) use ($app) {
        $brand = Brand::findById($id);
        return $app['twig']->render('brand_edit.html.twig', array('brand' => $brand));
    });

    $app->patch("/brands/{id}", function($id) use ($app) {
        $name = $_POST['name'];
        $brand = Brand::findById($id);
        $brand->update($name);
        return $app['twig']->render('brand.html.twig', array('brand' => $brand, 'stores' => $brand->getJoinList(), 'all_stores' => Store::getAll()));
    });

//Delete Brand
$app->delete("/brands/{id}", function($id) use ($app) {
    $brand = Brand::findById($id);
    $brand->delete();
    return $app['twig']->render('index.html.twig');
});


//End App
    return $app;
?>
