<?php
function ArrayProductImages($connect, $id)
{
    $images = [];
    $sql = "SELECT image_url FROM product_image WHERE product = '" . $id . "'";
    $result = $connect->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $images[] = $row['image_url'];
        }
    }
    return $images;
}

function RankNumberToStar($rank)
{
    $star = "";
    for ($i = 1; $i <= 5; $i++) {
        if ($i <= $rank) {
            $star .= "<i style='color: orange;' class='fa-solid fa-star'></i>";
        } else if ($i > $rank && ($i - $rank) < 1) {
            $star .= "<i style='color: orange;' class='fa-solid fa-star-half-stroke'></i>";
        } else {
            $star .= "<i class='fa-regular fa-star'></i>";
        }
    }
    return $star;
}


function getIdToName($Arr, $id)
    {
        foreach ($Arr as $item) {
            if ($item->getId() == $id) {
                return $item->getName();
            }
        }
    }