<?php

/**
 * VIEW README FILE
 * Replace these with the correct paths. 
 */
$doctrineCommonPath = '/home/justin/fir.com/www/rialto/vendor/doctrine-common/lib';
$doctrineDbalPath = '/home/justin/fir.com/www/rialto/vendor/doctrine-dbal/lib';
$doctrineOrmPath = '/home/justin/fir.com/www/rialto/vendor/doctrine/lib';

require_once "{$doctrineCommonPath}/Doctrine/Common/ClassLoader.php";

use Doctrine\Common\ClassLoader;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Configuration;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\ORM\Mapping\Driver\XmlDriver;

$paths = array(
    'Doctrine\Common' => $doctrineCommonPath,
    'Doctrine\DBAL' => $doctrineDbalPath,
    'Doctrine\ORM' => $doctrineOrmPath,
    'Test' => __DIR__,
    'Proxies' => __DIR__,
);
foreach ( $paths as $namespace => $path ) {
    $loader = new ClassLoader($namespace, $path);
    $loader->register();
}

AnnotationRegistry::registerFile(
    "{$doctrineOrmPath}/Doctrine/ORM/Mapping/Driver/DoctrineAnnotations.php"
);

$cache = new \Doctrine\Common\Cache\ArrayCache;

$config = new Configuration();
$config->setMetadataCacheImpl($cache);
$reader = new AnnotationReader();

/**
 * VIEW README FILE
 * comment/uncomment the below two lines to switch 
 * between XML and Annotation drivers
 */
$driver = new AnnotationDriver($reader, 'Test');
//$driver = new XmlDriver('Test');
$config->setMetadataDriverImpl($driver);
$config->setQueryCacheImpl($cache);
$config->setProxyDir('Proxies');
$config->setProxyNamespace('Proxies');
$config->setAutoGenerateProxyClasses(true);

$connectionOptions = array(
    'driver' => 'pdo_sqlite',
    'path' => 'database.sqlite'
);

$em = EntityManager::create($connectionOptions, $config);

$repo = $em->getRepository('Test\ProductDescription');
$descriptions = $repo->findAll();

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Test</title>
</head>
<body>
    <table>
        <tr>
            <th>Product ID</th>
            <th>Locale</th>
            <th>Description</th>
        </tr>
        <?php foreach ($descriptions as $desc): ?>
            <tr>
                <td><?php echo $desc->getProductId(); ?></td>
                <td><?php echo $desc->getLocale(); ?></td>
                <td><?php echo $desc->getDescription(); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
