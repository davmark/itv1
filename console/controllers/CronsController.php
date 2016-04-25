<?php
namespace console\controllers;
use common\models\Program;
use common\models\Show;
use common\models\Tv;
use Google_Client;
use Google_Service_YouTube;
use yii\console\Controller;

Class CronsController extends Controller
{
    public function actionCron()
    {

        $chanals = Show::find()->all();

        $DEVELOPER_KEY = 'AIzaSyAKRfkmnG7VEwdLEdOdCn3UMRxtMr0Mi5g';
        $nextPageToken = '';

        $client = new Google_Client();
        $client->setDeveloperKey($DEVELOPER_KEY);

        foreach($chanals as $chanal) {

            $youtube = new Google_Service_YouTube($client);

            $yt_chan_id = $chanal->url;

            do {
                try {
                    $playlistItemsResponse = $youtube->playlistItems->listPlaylistItems('snippet', array(
                        'playlistId' => $yt_chan_id,
                        'maxResults' => 50,
                        'pageToken' => $nextPageToken));

                    foreach ($playlistItemsResponse['items'] as $item) {
                        $model = new Program();
                        $model->alias = $item['snippet']['resourceId']['videoId'];
                        $model->title = $item['snippet']['title'] ? $item['snippet']['title'] : '';
                        $model->url = $item['snippet']['resourceId']['videoId'] ? $item['snippet']['resourceId']['videoId'] : '';
                        $model->image_youtube = $item['snippet']['thumbnails']['medium']['url'];
                        $model->publishedAt = $item['snippet']['publishedAt'];
                        $model->status = 1;
                        $model->shows_id = $chanal->id;
                        $post['Program']['alias'] = $item['snippet']['resourceId']['videoId'];
                        if ($model->load($post) && $item['snippet']['thumbnails']['default']['url']) {
                            $model->save();
                        }
                    }
                    $nextPageToken = $playlistItemsResponse['nextPageToken'];
                } catch (\Google_Service_Exception $e) {

                    $model = Show::findOne($chanal->id);
                    $model->delete();
                }

            } while ($nextPageToken <> '');
        }
    }
}