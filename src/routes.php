<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes
$app->get('/', function (Request $request, Response $response, array $args) {
    // Sample log message
    // $this->logger->info("Slim-Skeleton '/' route");
    
    // Render index view
    return $this->renderer->render($response, 'index.html', $args);
});

/**
 * 駅データ.jp(http://www.ekidata.jp/)から取得した
 * csvファイルから線路データを読み取り返却する
 */
$app->get('/trainList', function (Request $request, Response $response, array $args) {
    
    $filepath = '../data/line20180330free.csv';
    $stationDataFile = new SplFileObject($filepath);
    $stationDataFile->setFlags(SplFileObject::READ_CSV);

    $offset = $request->getQueryParam('offset');
    $query = $request->getQueryParam('query');
    $limit = $offset + $request->getQueryParam('limit');

    $data = array();
    $responseData = array();
    $totalCount = 0;

    // 全件検索
    if ($query != "") {
        foreach($stationDataFile as $line) {
            if (strpos($line[2], $query) !== false) {
                $totalCount ++;
                $data[] = [id => $line[0], name => $line[2] , watching => false];
            }
        }
    } else {
        foreach($stationDataFile as $line) {
            $totalCount ++;
            $data[] = [id => $line[0], name => $line[2] , watching => false];
        }
        array_shift($data);
    }

    // ページング
    foreach($data as $index => $line) {
        if ($index >= $limit) {
            break;
        }

        if ($index >= $offset) {
            $responseData[] = [id => $line["id"], name => $line["name"] , watching => false];
        }
    }

    return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->withHeader('totalCount', $totalCount)
        ->write(json_encode($responseData));
});