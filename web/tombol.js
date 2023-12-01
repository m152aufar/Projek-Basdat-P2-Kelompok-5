var tampilLengkap = false; // variabel untuk melacak status tampilan

function tampilkanKalimat() {
    var kalimatSelamatDatang = "Selamat datang di Easy Task Easy Life – tempat di mana produktivitas bertemu dengan kesederhanaan. Kami memahami betapa berharganya waktumu, dan itulah mengapa Easy Task Easy Life hadir sebagai teman setiamu dalam mengorganisir tugas dan kegiatan sehari-hari.";

    var kalimatLengkap = `
        <p>
            ${kalimatSelamatDatang}
        </p>
        <p>
            Kami menyediakan platform yang intuitif dan serbaguna untuk menyusun dan mengelola tugas-tugasmu dengan mudah. Mari bersama-sama menciptakan pengalaman produktif yang tak terlupakan. 
        </p>
        <p>
            Selamat menggunakan layanan Easy Task Easy Life, di mana menyusun tugas bukanlah lagi beban, melainkan sebuah perjalanan yang menyenangkan menuju kehidupan yang lebih teratur dan efisien.
        </p>
    `;

    // Tampilkan kalimat sesuai dengan status tampilan
    document.getElementById("kalimatAwal").innerHTML = tampilLengkap ? kalimatSelamatDatang : kalimatLengkap;

    // Toggle status tampilan setelah tampilan selesai diperbarui
    tampilLengkap = !tampilLengkap;
}
