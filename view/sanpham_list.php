<?php
if (isset($_SESSION['dathang'])) {
    unset($_SESSION['dathang']);
}


$sql = "SELECT MIN(price) AS gia_min, MAX(price) AS gia_max
FROM sanpham;";
$mimax = pdo_query_one($sql);
$page = $_GET["page"];
if (isset($_POST['search'])) {
    $search = $_POST['search'];
} else {
    $search = "";
}

if (isset($_GET['danhmuc'])) {
    $danhmuc = $_GET['danhmuc'];
} else {
    $danhmuc = "";
}
if (isset($_GET['timkiem'])) {
    $search = $_GET['timkiem'];
}
?>
<?php
if ($danhmuc != 0) {
    $sql = "SELECT * FROM danhmuc where id=$danhmuc";
    $named_m = pdo_query_one($sql);
    $namedm = $named_m['name'];
} else {
    $namedm = "Tất cả sản phẩm";
}
?>

<main class="container_sanpham_list">
    <h4 style='width: 100%; background-color: #fad9f6; text-align: center; padding: 20px;  font-family: "Times New Roman", Times, serif; font-weight: bolder;'>Danh sách sản phẩm: <?= $namedm ?></h4>

    <div class="box_top">

        <div class="locgia">
            <script>
                $(function() {
                    $("#slider-range").slider({
                        range: true,
                        min: <?= $mimax['gia_min'] ?>,
                        max: <?= $mimax['gia_max'] ?>,
                        values: [<?= $mimax['gia_min'] ?>, <?= $mimax['gia_max'] ?>],
                        slide: function(event, ui) {
                            $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
                            $.post("ajax/locgia.php", {
                                price_start: ui.values[0],
                                price_end: ui.values[1],
                                page: <?= $page ?>,
                                danhmuc: "<?= $danhmuc ?>",
                                search: "<?= $search ?>",
                            }, function(data) {
                                $(".box_right").html(data);
                            });
                        }
                    });
                    $("#amount").val("$" + $("#slider-range").slider("values", 0) +
                        " - $" + $("#slider-range").slider("values", 1));
                    $.post("ajax/locgia.php", {
                        price_start: $("#slider-range").slider("values", 0),
                        price_end: $("#slider-range").slider("values", 1),
                        page: <?= $page ?>,
                        danhmuc: "<?= $danhmuc ?>",
                        search: "<?= $search ?>",
                    }, function(data) {
                        $(".box_right").html(data);
                    });
                });
            </script>
            <p>
                <label for="amount">Giá từ:</label>
                <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
            </p>
            <div style="width: 300px;" id="slider-range"></div>
        </div>
        <div class="search" style="margin-right: 100px;">
            <form action="index.php?act=sanpham_list&page=1&danhmuc=<?= $danhmuc ?>" method="post">
                <input type="text" class="ip_search" name="search" placeholder="Tìm kiếm" style="width: 300px;">
            </form>
        </div>

    </div>
    <div class="box_right">
    </div>

</main>