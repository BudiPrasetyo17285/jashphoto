<?php
require_once "database/koneksi.php";

$query = mysqli_query($host, "
    SELECT 
        id,
        name,
        bio,
        rating,
        lokasi,
        foto_profil
    FROM photographer
    WHERE id_categories = 1
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Fotografer Wedding</title>

<style>
body {
  font-family: Arial, sans-serif;
  background: #f7f7f7;
  margin: 0;
}

.container {
  max-width: 1100px;
  margin: 40px auto;
  padding: 20px;
}

h1 {
  text-align: center;
  margin-bottom: 30px;
}

.grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
  gap: 20px;
}

.card {
  background: white;
  border-radius: 15px;
  padding: 20px;
  box-shadow: 0 5px 15px rgba(0,0,0,0.1);
  text-align: center;
}

.card img {
  width: 120px;
  height: 120px;
  object-fit: cover;
  border-radius: 50%;
  margin-bottom: 10px;
}

.name {
  font-size: 18px;
  font-weight: bold;
}

.rating {
  color: gold;
  margin: 5px 0;
}

.lokasi {
  font-size: 14px;
  color: #555;
}

.bio {
  font-size: 14px;
  margin-top: 10px;
  color: #333;
}

.btn {
  display: inline-block;
  margin-top: 15px;
  padding: 10px 20px;
  background: #2563eb;
  color: white;
  text-decoration: none;
  border-radius: 10px;
}

.btn:hover {
  background: #1e40af;
}

.btn-book {
  display: inline-block;
  margin: 30px auto;
  padding: 10px 25px;
  background: #2563eb;
  color: white;
  border-radius: 10px;
  text-decoration: none;
}
</style>
</head>

<body>

<div class="container">
<h1>Daftar Fotografer Wedding</h1>

<div class="grid">
<?php while ($row = mysqli_fetch_assoc($query)) { ?>

  <div class="card">
    <img 
      src="assets/<?= htmlspecialchars($row['foto_profil']); ?>" 
      alt="<?= htmlspecialchars($row['name']); ?>"
    >

    <div class="name"><?= htmlspecialchars($row['name']); ?></div>
    <div class="rating"><?= str_repeat("⭐", (int)$row['rating']); ?></div>
    <div class="lokasi"><?= htmlspecialchars($row['lokasi']); ?></div>
    <p class="bio"><?= htmlspecialchars($row['bio']); ?></p>

    <a href="program.php?id=<?= $row['id']; ?>" class="btn">
      Lihat Portofolio
    </a>
  </div>

<?php } ?>
</div>

<a href="homepage.php" class="btn-book">⬅ Kembali</a>

</div>
</body>
</html>
