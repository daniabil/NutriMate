<?php
$url = "https://api.crossref.org/works?query=health";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'User-Agent: MyJournalApp/1.0'
]);

$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response, true);

$items = $data['message']['items'] ?? [];
?>
<div class="container">
  <h2>Jurnal Kesehatan</h2>
  <?php foreach ($items as $item): ?>
    <div class="mb-4 border-bottom pb-3">
      <h5><?php echo $item['title'][0] ?? 'No Title'; ?></h5>
      <p>DOI: <?php echo $item['DOI']; ?></p>
      <a href="https://doi.org/<?php echo $item['DOI']; ?>" target="_blank">Baca di Penerbit</a>
    </div>
  <?php endforeach; ?>
</div>
