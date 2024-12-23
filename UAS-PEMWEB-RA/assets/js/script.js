// Ambil elemen form dan tabel
const form = document.getElementById('dataForm');
const tableBody = document.getElementById('dataTable').querySelector('tbody');
const submitButton = document.getElementById('submitButton');


submitButton.addEventListener('click', function () {
  const formData = new FormData(form);

  fetch('server/process.php', {
      method: 'POST',
      body: formData
  })
  .then(response => response.text())
  .then(result => {
      if (result.trim() === "Data berhasil disimpan!") {
          alert(result); // Tampilkan pesan sukses
          form.reset(); // Reset form
          loadUserData(); // Perbarui tabel dengan data baru
      } else {
          alert(result); // Tampilkan pesan error
      }
  })
  .catch(error => console.error('Error:', error));
});

// Fungsi untuk memuat data dari server
function loadUserData() {
    fetch('server/view_user.php')
        .then(response => response.json())
        .then(data => {
            tableBody.innerHTML = ''; // Hapus isi tabel sebelumnya

            data.forEach(user => {
                const newRow = tableBody.insertRow();
                newRow.innerHTML = `
                    <td>${user.name}</td>
                    <td>${user.gender}</td>
                    <td>${user.hobbies}</td>
                    <td>${user.country}</td>
                `;
            });
        })
        .catch(error => console.error('Error:', error));
}

// Tambahkan event listener ke form
form.addEventListener('submit', function (e) {
    e.preventDefault(); // Mencegah pengiriman form default

    const formData = new FormData(form);

    fetch('server/process.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(result => {
        if (result.trim() === "Data berhasil disimpan!") {
            alert(result); // Tampilkan pesan sukses
            form.reset(); // Reset form
            loadUserData(); // Perbarui tabel dengan data baru
        } else {
            alert(result); // Tampilkan pesan error
        }
    })
    .catch(error => console.error('Error:', error));
});

// Muat data pengguna saat halaman dimuat
document.addEventListener('DOMContentLoaded', loadUserData);
