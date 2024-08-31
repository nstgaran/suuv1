<style>
    .grid-container-2 {
        display: flex;
        flex-wrap: nowrap;
        overflow-x: auto;
        scroll-behavior: smooth;
        padding-bottom: 20px;
    }

    .card-2 {
        flex: 0 0 auto;
        width: 200px;
        margin-right: 10px;
        display: flex;
        flex-direction: column;
    }

    .card-body {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        flex-grow: 1;
        justify-content: space-between;
    }

    .truyen-title {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
        /* Số dòng tối đa hiển thị */
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .btn {
        margin-top: auto;
        margin-bottom: 10px;
    }

    
    .navigation-buttons {
        display: flex;
        justify-content: center;
        margin-top: 10px;
    }

    .prev-button {
        margin-right: 10px;
    }
</style>

<div class="grid-container-2">
    <?php
    $totalTruyen = count($data);
    $visibleTruyen = 6;
    $currentIndex = 0;
    for ($i = 0; $i < $visibleTruyen; $i++) {
        $index = ($currentIndex + $i) % $totalTruyen;
        $truyen = $data[$index];
    ?>
        <div class="card card-2">
            <?php if ($truyen['truyen_loai'] == 1) { ?>
                <a href="/freetruyen/chitiettruyen.php?truyen_id=<?= $truyen['truyen_id'] ?>">
                    <img src="/freetruyen/assets/uploads/tieuthuyet/<?= $truyen['truyen_hinhdaidien'] ?>" style="width: 190px; height: 200px;" />
                </a>
            <?php } else if ($truyen['truyen_loai'] == 2) { ?>
                <a href="/freetruyen/chitiettruyen.php?truyen_id=<?= $truyen['truyen_id'] ?>">
                    <img src="/freetruyen/assets/uploads/truyen-tranh/<?= $truyen['truyen_hinhdaidien'] ?>" style="width: 198px; height: 200px;" />
                </a>
            <?php } ?>
            <div class="card-body">
                <h5 style="font-family: 'Prompt', sans-serif;" class="card-title-2">
                    <span class="truyen-title"><?= $truyen['truyen_ten'] ?></span>
                </h5>
                <a href="/freetruyen/chitiettruyen.php?truyen_id=<?= $truyen['truyen_id'] ?>" class="btn btn-primary">Đọc Truyện</a>
            </div>
        </div>
    <?php } ?>
</div>
<div class="navigation-buttons">
    <button class="prev-button btn btn-info" onclick="movePrev()"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i></button>
    <button class="next-button btn btn-info" onclick="moveNext()"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i></button>
</div>

<script>
    var currentIndex = 0;
    var totalTruyen = <?= $totalTruyen ?>;
    var visibleTruyen = <?= $visibleTruyen ?>;

    function movePrev() {
        currentIndex = (currentIndex - visibleTruyen + totalTruyen) % totalTruyen;
        updateVisibleTruyen();
    }

    function moveNext() {
        currentIndex = (currentIndex + visibleTruyen) % totalTruyen;
        updateVisibleTruyen();
    }

    function updateVisibleTruyen() {
        var cards = document.querySelectorAll('.grid-container-2 .card-2');
        cards.forEach(function(card, index) {
            var truyenIndex = (currentIndex + index) % totalTruyen;
            var truyen = <?= json_encode($data) ?>[truyenIndex];
            var imgElement = card.querySelector('img');
            var aElement = card.querySelector('a');
            var titleElement = card.querySelector('.truyen-title');
            var btnElement = card.querySelector('.btn');
            if (truyen['truyen_loai'] == 1) {
                imgElement.src = "/freetruyen/assets/uploads/tieuthuyet/" + truyen['truyen_hinhdaidien'];
            } else if (truyen['truyen_loai'] == 2) {
                imgElement.src = "/freetruyen/assets/uploads/truyen-tranh/" + truyen['truyen_hinhdaidien'];
            }
            aElement.href = "/freetruyen/chitiettruyen.php?truyen_id=" + truyen['truyen_id'];
            titleElement.innerText = truyen['truyen_ten'];
            btnElement.href = "/freetruyen/chitiettruyen.php?truyen_id=" + truyen['truyen_id'];
        });
    }

    var titleElements = document.querySelectorAll('.truyen-title');
    titleElements.forEach(function(titleElement) {
        var titleText = titleElement.innerText;
        var maxTitleLength = 20; // Độ dài tối đa cho tiêu đề
        var trimmedTitle = titleText.length > maxTitleLength ? titleText.substring(0, maxTitleLength) + '...' : titleText;
        titleElement.innerText = trimmedTitle;
    });
</script>
