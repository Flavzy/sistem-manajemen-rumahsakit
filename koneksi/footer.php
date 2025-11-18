<?php
// Di header.php - tambahkan di bagian atas
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
?>

<!-- page content ends -->
</main>

<footer style="text-align:center; padding:18px 0; color:#718096;">
  <small>© <?= date("Y") ?> Sistem Manajemen Rumah Sakit — All rights reserved</small>
</footer>

</body>
<script>
const toggle = document.getElementById('theme-toggle'); // sesuaikan ID tombol mode kamu
const body = document.body;

toggle?.addEventListener('click', () => {
  body.classList.toggle('dark');
  localStorage.setItem('theme', body.classList.contains('dark') ? 'dark' : 'light');
  fixTableTheme();
});

if (localStorage.getItem('theme') === 'dark') {
  body.classList.add('dark');
}

function fixTableTheme() {
  const tables = document.querySelectorAll('table');
  tables.forEach(table => {
    if (body.classList.contains('dark')) {
      table.style.backgroundColor = '#1e293b';
      table.style.color = '#f1f5f9';
      table.querySelectorAll('th').forEach(th => {
        th.style.backgroundColor = '#334155';
        th.style.color = '#f8fafc';
      });
      table.querySelectorAll('td').forEach(td => {
        td.style.color = '#e2e8f0';
        td.style.borderColor = '#475569';
      });
    } else {
      table.removeAttribute('style');
      table.querySelectorAll('th, td').forEach(el => el.removeAttribute('style'));
    }
  });
}

window.addEventListener('load', fixTableTheme);
</script>
</body>

</html>
