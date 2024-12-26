<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<!-- Tombol Scroll to Top -->
<button id="scrollToTopBtn" class="btn-scroll-top">
    <img src="{{ asset('assets/up-arrow.png') }}" alt="Scroll to Top" class="img-scroll-top">
</button>

<script>
    // Mendapatkan tombol
    const scrollToTopBtn = document.getElementById("scrollToTopBtn");

    // Menampilkan tombol saat scroll ke bawah
    window.onscroll = function () {
        if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
            scrollToTopBtn.style.display = "flex"; // Menampilkan tombol
        } else {
            scrollToTopBtn.style.display = "none"; // Menyembunyikan tombol
        }
    };

    // Fungsi untuk scroll ke atas
    scrollToTopBtn.addEventListener("click", function () {
        window.scrollTo({
            top: 0,
            behavior: "smooth", // Animasi smooth scroll
        });
    });
</script>

<style>
.btn-scroll-top {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 50px;
    height: 50px;
    background-color: transparent; /* Background transparan */
    border: none; /* Hilangkan border */
    display: none; /* Tersembunyi secara default */
    justify-content: center;
    align-items: center;
    cursor: pointer;
    z-index: 1000;
    padding: 0;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Opsional untuk shadow */
}

.img-scroll-top {
    width: 50%; /* Gambar menyesuaikan tombol */
    height: 50%;
    object-fit: contain; /* Menghindari distorsi gambar */
}

.btn-scroll-top:hover .img-scroll-top {
    transform: scale(1.1); /* Animasi saat hover */
    transition: transform 0.2s ease-in-out;
}
</style>
