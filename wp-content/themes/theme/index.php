<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get posts</title>
    <?php wp_head() ?>
</head>

<body>
    <pre>

    <?php
    #Парсинг страницы API
    function parseAPI($ch)
    {
        $ch = curl_init($ch);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_ENCODING, "deflate");
        $ext = curl_exec($ch);
        return $ext;
        curl_close($ch);
    }
    # Распечатка массива
    function print_pre($value)
    {
        print_r($value);
    }

    #выполняем парсинг функцией parseAPI();
    $devicesLink = 'http://wpapitest.beget.tech/wp-json/wp/v2/posts?acf_format=standard';
    $devicesLink_page = json_decode(parseAPI($devicesLink), true);
    echo '<h1>c</h1><br>
    <h2>http://wpapitest.beget.tech/wp-json/wp/v2/posts?acf_format=standard</h2>
    <br>';
    print_pre($devicesLink_page);

    $devicesLink_cats = 'http://wpapitest.beget.tech/wp-json/wp/v2/categories?acf_format=standard';
    $devicesLink_page_cats = json_decode(parseAPI($devicesLink_cats), true);
    echo '<h1 id="get_cats">Получаем список категорий</h1>
    <h2>http://wpapitest.beget.tech/wp-json/wp/v2/categories?acf_format=standard</h2>
    <br>';
    print_pre($devicesLink_page_cats);

    echo '<h1 id="get_cats_child">Получаем список дочерних категории "Устройства" - получаем по id </h1><br>';
    foreach ($devicesLink_page_cats as $item) {
        if ($item['parent'] === 3) {
            print_r($item);
        }
    }

    ?>
    </pre>
    <?php wp_footer(); ?>
</body>

</html>