<?php

use Slim\Http\Request;
use Slim\Http\Response;

require "../vendor/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;
require "config.php";

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
$app->get('/getTrainList', function (Request $request, Response $response, array $args) {

    $filepath = '../data/train.csv';
    $stationDataFile = new SplFileObject($filepath);
    $stationDataFile->setFlags(SplFileObject::READ_CSV);

    $query = $request->getQueryParam('query');
    $offset = $request->getQueryParam('offset');
    $limit = $offset + $request->getQueryParam('limit');

    $data = array();
    $responseData = array();
    $totalCount = 0;

    // 全件検索
    if ($query != "") {
        foreach($stationDataFile as $line) {
            $trainName = $line[2];
            if (strpos($trainName, $query) !== false && !is_null($trainName)) {
                $totalCount ++;
                $data[] = [id => $line[0], name => $trainName, watching => false];
            }
        }
    } else {
        foreach($stationDataFile as $line) {
            $trainName = $line[2];
            if (!is_null($trainName)) {
                $totalCount ++;
                $data[] = [id => $line[0], name => $trainName , watching => false];
            }
        }
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

// ウォッチリストの路線情報を取得
$app->get("/getWatchTrainInfo", function (Request $request, Response $response, array $args) {

    $delayInfo = json_decode(file_get_contents("https://rti-giken.jp/fhc/api/train_tetsudo/delay.json"));

    $responseData = [];
    foreach ($request->getQueryParams() as $query) {
        $isDelay = false;
        // 遅延データチェック
        foreach($delayInfo as $info) {
            if ($info->name == $query) {
                $isDelay = true;
            }
        }

        if ($isDelay) {
            array_push($responseData, [name => $query, type => 'error', status => "現在遅延中"]);
        } else {
            array_push($responseData, [name => $query, type => 'success', status => "平常運転中"]);
        }
    }

    return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write(json_encode($responseData));
});

// 遅延情報検索
$app->get("/getDelayInfo", function (Request $request, Response $response, array $args) {
    // Twitter接続
    try {
        $Twitter = new TwitterOAuth(API_KEY, API_SECRET, ACCESS_TOKEN, ACCESS_SECRET);
    } catch (Exception $e) {
        $this->logger->info($e);
        exit;
    }

    // 路線名を取得
    foreach ($request->getQueryParams() as $query) {
        $tweets = $Twitter->get("search/tweets", ["q" => "#".$query." 遅延", "count" => 100]);

        // 遅延ツイートが5件以上の場合はステータスを遅延に設定
        if(count($tweets->statuses) > 5) {

        }
        // ツイート詳細
        // foreach($tweets->statuses as $tweet) {
        //     $this->logger->info(var_dump($tweet->text));
        //     $t = new DateTime($tweet->created_at);
        //     $t->setTimeZone(new DateTimeZone('Asia/Tokyo'));
            
        //     $this->logger->info(var_dump($t->format('Y-m-d H:i:s')));
        // }
    }


    // 結果を返却
    return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json');
});