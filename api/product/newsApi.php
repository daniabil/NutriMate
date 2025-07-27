<?php
$apiKey = "8effb58f656b456e94ab67b6e177e313";
$url = "https://newsapi.org/v2/top-headlines?category=health&country=us&apiKey=$apiKey";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'User-Agent: MyNewsApp/1.0'
]);

$response = curl_exec($ch);
curl_close($ch);

echo "<pre>$response</pre>";

$data = json_decode($response, true);

$articles = $data['articles'] ?? [];
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Berita Kesehatan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-5">
    <h1 class="mb-4">Berita Kesehatan (Health)</h1>
    <div class="row">
      <?php foreach ($articles as $article): ?>
        <div class="col-md-4 mb-4">
          <div class="card h-100">
            <?php if ($article['urlToImage']): ?>
              <img src="<?php echo $article['urlToImage']; ?>" class="card-img-top" alt="News Image">
            <?php endif; ?>
            <div class="card-body">
              <h5 class="card-title"><?php echo $article['title']; ?></h5>
              <p class="card-text"><?php echo $article['description']; ?></p>
            </div>
            <div class="card-footer">
              <a href="<?php echo $article['url']; ?>" target="_blank" class="btn btn-primary btn-sm">Baca Selengkapnya</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</body>
</html>
