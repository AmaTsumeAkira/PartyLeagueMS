<?php



// 获取class表数据
$query_class = "SELECT id, username,user_type FROM class";
$result_class = mysqli_query($conn, $query_class);

// 假设接收到的id存储在变量$id中
$id = $_GET['id'];

// 遍历查询结果，查找匹配的id
while ($row = mysqli_fetch_assoc($result_class)) {
    if ($row['id'] == $id) {
        $username = $row['username'];
        $bjrs = $row['user_type'];
        break;
    }
}

?>

<hr>
<?php
// 创建一个空数组，用于存储所有数据
$data = array();

$sql = "SELECT * FROM tuiyoujihua WHERE type = 0 AND zhuangtai = 0";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$jihuaid = $row["id"];
$query_students = "SELECT * FROM tystu WHERE jihuaid = $jihuaid;";
$result_students = mysqli_query($conn, $query_students);

while ($row = mysqli_fetch_assoc($result_students)) {
    // 创建一个临时数组，用于存储当前行的数据
    $temp = array();

    // 逻辑处理来获取classid对应的username
    $id = $row['classid'];

    // 重置查询结果指针到起始位置
    mysqli_data_seek($result_class, 0);

    while ($class_row = mysqli_fetch_assoc($result_class)) {
        if ($class_row['id'] == $id) {
            $username = $class_row['username'];
            $bjrs = $class_row['user_type'];
            break;
        }
    }

    // 将当前行的数据存入临时数组
    $temp['username'] = isset($username) ? $username : '未知';
    $temp['bjrs'] = isset($bjrs) ? $bjrs : '未知';
    $temp['stuid'] = $row['stuid'];
    $temp['name'] = $row['name'];
    $temp['mz'] = $row['mz'];
    $temp['sex'] = $row['sex'];
    $temp['idcard'] = $row['idcard'];
    $temp['zhiwu'] = $row['zhiwu'];
    $temp['dizhi'] = $row['dizhi'];
    $temp['xueli'] = $row['xueli'];
    $temp['jiguan'] = $row['jiguan'];
    $temp['chushengriqi'] = $row['chushengriqi'];
    $temp['rutuannianyue'] = $row['rutuannianyue'];
    $temp['peiyangren1'] = $row['peiyangren1'];
    $temp['peiyangren2'] = $row['peiyangren2'];
    $temp['shenqingrudangriqi'] = $row['shenqingrudangriqi'];
    $temp['jijifenzi'] = $row['jijifenzi'];
    $temp['fazhan'] = $row['fazhan'];
    $temp['yubei'] = $row['yubei'];
    $temp['zhuanzheng'] = $row['zhuanzheng'];

    if ($row['zhuangtai'] == 1) {
        $temp['zhuangtai'] = '团务审核中';
    } elseif ($row['zhuangtai'] == 2) {
        $temp['zhuangtai'] = '党务审核中';
    } elseif ($row['zhuangtai'] == 4) {
        $temp['zhuangtai'] = '流程完毕';
    } else {
        $temp['zhuangtai'] = $row['zhuangtai'];
    }

    $temp['beizhu'] = $row['beizhu'];

    // 查询 tychengji 表中的数据
    $id = $row['id'];
    $sql = "SELECT * FROM tychengji WHERE stuid = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // 添加 tychengji 表中的数据到临时数组
            $temp['guake'] = $row['guake'];
            $temp['chufen'] = $row['chufen'];
            $temp['zhiyu'] = $row['zhiyu'];
            $temp['zongce'] = $row['zongce'];

            // 解析 $zhiyu 和 $zongce
            $zhiyuArray = explode('/', $row['zhiyu']);
            $zongceArray = explode('/', $row['zongce']);
            $zhiyulu = array();
            $zongcelu = array();

            foreach ($zhiyuArray as $value) {
                $zhiyulu[] = sprintf("%.2f%%", (floatval($value) / floatval($bjrs)) * 100);
            }

            foreach ($zongceArray as $value) {
                $zongcelu[] = sprintf("%.2f%%", (floatval($value) / floatval($bjrs)) * 100);
            }

            $temp['zhiyulu'] = implode('/', $zhiyulu);
            $temp['zongcelu'] = implode('/', $zongcelu);
        }
    } else {
        // 如果 tychengji 表中没有数据，则添加默认值
        $temp['guake'] = '未录入';
        $temp['chufen'] = '未录入';
        $temp['zhiyu'] = '未录入';
        $temp['zongce'] = '未录入';
        $temp['zhiyulu'] = '未录入';
        $temp['zongcelu'] = '未录入';
    }

    // 将临时数组添加到数据数组中
    $data[] = $temp;
}

//print_r($data);
// 输出 JSON 格式的数据，并保持 Unicode 字符的转义
//echo json_encode($data, JSON_UNESCAPED_UNICODE);
// 统计班级出现次数和性别数量
$counts = array();
$genderCounts = array("男" => 0, "女" => 0); // 初始化性别统计数组
$totalCount = 0; // 初始化数据总数
foreach ($data as $item) {
    $totalCount++; // 增加数据总数
    $username = $item['username'];
    if (isset($counts[$username])) {
        $counts[$username]++;
    } else {
        $counts[$username] = 1;
    }
    // 统计性别数量
    $gender = $item['sex'];
    $genderCounts[$gender]++;
}

// 输出表格
echo "<table border='1'>";
echo "<tr><th>班级名</th><th>推优人数</th></tr>";
foreach ($counts as $username => $count) {
    echo "<tr><td>$username</td><td>$count</td></tr>";
}
echo "</table>";

// 输出性别统计
echo "<br><table border='1'>";
echo "<tr><th>性别</th><th>数量</th></tr>";
foreach ($genderCounts as $gender => $count) {
    echo "<tr><td>$gender</td><td>$count</td></tr>";
}
echo "</table>";

// 输出总数据量
echo "<br>Total Count: $totalCount";
?>



