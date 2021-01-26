$(document).ready(() => {
    // menghilangkan tombol cari
    $("#tombol-cari").hide();
    // event ketika keyword di tulis
    $("#keyword").on("keyup", () => {
        // munculkan icon loading
        $(".display").show();
        // ajax menggunakna load
        // $("#container").load("ajax/mahasiswa.php?keyword=" + $("#keyword").val())
        // $.get()
        $.get("ajax/mahasiswa.php?keyword=" + $("#keyword").val(), (data) => {
            $("#container").html(data);
            $(".display").hide();
        })
    });
});