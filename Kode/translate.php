<?php
// Tampilkan error untuk debugging selama masa pengembangan
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'config/config.php';
include 'includes/header.php';
include 'includes/ai_logic.php';

$hasil = "";
$input = "";

// Cek apakah form telah dikirim
if (isset($_POST['translate'])) {
    $input = $_POST['input_text'];
    
    // API Key dari Google AI Studio
    $myKey = "AIzaSyCLLkS9NUy1dB603knIgsYqveAG2ngdQsA"; 
    
    // Panggil fungsi AI yang ada di ai_logic.php
    if (!empty($input)) {
        $hasil = translateWithGemini($input, $myKey);
    } else {
        $hasil = "Silakan masukkan teks Bahasa Indonesia terlebih dahulu.";
    }
}
?>

<div class="container py-3 py-md-5" style="min-height: 80vh;">
    <div class="card shadow-lg border-0 mx-auto" style="max-width: 900px; border-radius: 15px;">
        
        <div class="card-header text-white p-3 p-md-4" style="background-color: #800000;">
            <h3 class="text-center mb-0 fs-4 fs-md-3" style="font-family: 'Playfair Display', serif; color: #D4AF37;">Penerjemah Bahasa Lampung</h3>
            <p class="text-center small mb-0 text-white-50"></p>
        </div>

        <div class="card-body p-3 p-md-4">
            <form action="" method="POST" id="translateForm">
                <div class="row g-3 g-md-4">
                    <div class="col-md-6">
                        <label class="form-label fw-bold"><i class="bi bi-translate"></i> Bahasa Indonesia</label>
                        <textarea class="form-control border-1 bg-light" 
                                  name="input_text" 
                                  rows="6" 
                                  placeholder="Contoh: Apa kabar? atau Saya ingin pergi ke pantai." 
                                  required><?= htmlspecialchars($input) ?></textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold text-maroon">Dialek Lampung</label>
                        <textarea id="outputTranslate" 
                                  class="form-control border-1 bg-white" 
                                  style="border: 1px solid #dee2e6 !important;" 
                                  rows="6" 
                                  readonly placeholder="Hasil terjemahan AI akan muncul di sini..."><?= htmlspecialchars($hasil) ?></textarea>
                    </div>
                </div>

                <div class="mt-4 d-flex flex-column flex-md-row justify-content-center gap-2 gap-md-3">
                    <button type="submit" name="translate" class="btn btn-maroon py-2 text-white shadow-sm w-100 w-md-auto px-md-5" style="background-color: #800000;">
                        Terjemahkan
                    </button>
                    
                    <button type="button" class="btn btn-outline-dark py-2 w-100 w-md-auto px-md-4" onclick="copyText()">
                        Salin Teks
                    </button>
                    
                    <a href="translate.php" class="btn btn-outline-secondary py-2 w-100 w-md-auto px-md-4">
                        Reset
                    </a>
                </div>
            </form>
        </div>
        
        <div class="card-footer bg-light p-3 text-center">
            <small class="text-muted italic">saat ini dioptimalkan untuk Dialek Api (Pesisir) dan Nyo.</small>
        </div>
    </div>
</div>

<script>
function copyText() {
    var copyText = document.getElementById("outputTranslate");
    
    if (copyText.value === "" || copyText.value.includes("Gagal")) {
        alert("Tidak ada teks yang dapat disalin.");
        return;
    }

    copyText.select();
    copyText.setSelectionRange(0, 99999); // Untuk perangkat mobile

    navigator.clipboard.writeText(copyText.value).then(function() {
        alert("Terjemahan berhasil disalin ke clipboard!");
    }, function(err) {
        console.error('Gagal menyalin teks: ', err);
    });
}
</script>

<style>
    .text-maroon { color: #800000; }
    .btn-maroon:hover { background-color: #600000 !important; transform: translateY(-2px); transition: 0.3s; }
    textarea { resize: none; }
    .card { animation: fadeIn 0.8s; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    
    /* Tambahan agar tombol otomatis lebarnya auto di layar besar */
    @media (min-width: 768px) {
        .w-md-auto { width: auto !important; }
    }
</style>

<?php include 'includes/footer.php'; ?>