<?php
// 文件名稱/臨時名稱/類型/大小/錯誤代碼
$fileName = $_FILES['file1']['name'];
$fileTmpLoc = $_FILES['file1']['tmp_name'];
$fileType = $_FILES['file1']['type'];
$fileSize = $_FILES['file1']['size'];
$fileErrorMsg = $_FILES['file1']['error'];

// 若沒選擇文檔
if (!$fileTmpLoc) {
    $retcode = array('success' => 'false', 'msg' => '上傳暫存儅無法建立！', 'fileName' => '');
    echo json_encode($retcode, JSON_UNESCAPED_UNICODE);
    exit();
}

if (move_uploaded_file($fileTmpLoc, "uploads/$fileName")) {
    $retcode = array('success' => 'true', 'msg' => '完成檔案上傳', 'fileName' => $fileName);
} else {
    $retcode = array('success' => 'false', 'msg' => '無法完成檔案上傳', 'fileName' => '');
}
echo json_encode($retcode, JSON_UNESCAPED_UNICODE);
exit();
?>