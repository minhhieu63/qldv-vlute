<?php
$server="localhost";
$usname="root";
$password="";
$dtbase="qldv";
$conn=mysqli_connect($server,$usname,$password,$dtbase);
if(!$conn){
    echo "Kết nối thất bại";
}
function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
 }
 function removeSpacesAndAccents($inputString) {
    // Loại bỏ tất cả khoảng trắng
    $inputString = preg_replace('/\s+/', '', $inputString);

    // Chuyển sang chuỗi thường không dấu
    $inputString = mb_strtolower($inputString, 'UTF-8');
    $inputString = removeAccents($inputString);

    return $inputString;
}

function removeAccents($str) {
    $str = str_replace(
        ['á', 'à', 'ả', 'ã', 'ạ', 'ă', 'ắ', 'ằ', 'ẳ', 'ẵ', 'ặ', 'â', 'ấ', 'ầ', 'ẩ', 'ẫ', 'ậ',
         'é', 'è', 'ẻ', 'ẽ', 'ẹ', 'ê', 'ế', 'ề', 'ể', 'ễ', 'ệ',
         'í', 'ì', 'ỉ', 'ĩ', 'ị',
         'ó', 'ò', 'ỏ', 'õ', 'ọ', 'ô', 'ố', 'ồ', 'ổ', 'ỗ', 'ộ', 'ơ', 'ớ', 'ờ', 'ở', 'ỡ', 'ợ',
         'ú', 'ù', 'ủ', 'ũ', 'ụ', 'ư', 'ứ', 'ừ', 'ử', 'ữ', 'ự',
         'ý', 'ỳ', 'ỷ', 'ỹ', 'ỵ'],
        ['a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a',
         'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e',
         'i', 'i', 'i', 'i', 'i',
         'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o',
         'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u',
         'y', 'y', 'y', 'y', 'y'],
        $str
    );

    return $str;
}
?>