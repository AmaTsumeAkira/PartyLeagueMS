<?php
    $pageTitle = "推优管理"; // 设置页面标题
    $qxyq = "2"; // 设置权限
    // 1=超级管理员
    // 2=党务、团务、学生会管理员
    // 3=团务、学生会管理员
    // 4=学生会管理员
    // 5=各级团支书
    // 其他页面逻辑和内容
    include '..\sub\qxpd.php'; // 包含页眉文件
    include '..\sub\head.php'; // 包含页眉文件
?>
<script src="../tabler/dist/js/demo-theme.min.js?1684106062"></script>
<div class="page">
    <!-- Navbar -->
    <?php
    include '..\sub\bodyhead.php';
    include './menu.php';
    ?>
    <div class="page-body table">
        <div class="container-xl">
            <div class="row row-cards">
            <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title" _msttexthash="6610136" _msthash="240">推优计划管理</h3>
                        </div>
                        <div class="card-body">
                            <div class="row row-cards">
                                <div class="col-md">
                                    <div class="card">
                                        <div class="card-status-top bg-red"></div>
                                        <div class="card-header">
                                            <h3 class="card-title" _msttexthash="10570118" _msthash="241">推优计划管理</h3>
                                        </div>




    <?php
// 导入配置文件
require_once('..\controller\.config');

// 连接数据库
$conn = new mysqli($host, $username, $password, $database);

// 检查连接是否成功
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

    // 处理新增操作
    if(isset($_POST['submit'])) {
        $pici = $_POST['pici'];
        $type = $_POST['type'];
        $zhuangtai = $_POST['zhuangtai'];

        $sql = "INSERT INTO tuiyoujihua (pici, type, zhuangtai) VALUES ('$pici', '$type', '$zhuangtai')";

        if ($conn->query($sql) === TRUE) {
            echo "新记录插入成功";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // 处理删除操作
    if(isset($_GET['delete'])) {
        $id = $_GET['delete'];

        $sql = "DELETE FROM tuiyoujihua WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            echo "记录删除成功";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    }

    // 处理修改操作
    if(isset($_POST['update'])) {
        $id = $_POST['id'];
        $pici = $_POST['pici'];
        $type = $_POST['type'];
        $zhuangtai = $_POST['zhuangtai'];

        $sql = "UPDATE tuiyoujihua SET pici='$pici', type='$type', zhuangtai='$zhuangtai' WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            echo "记录更新成功";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }

    // 查询数据
    $sql = "SELECT id, pici, type, zhuangtai FROM tuiyoujihua";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>推优批次</th>
                <th>类型</th>
                <th>状态</th>
                <th>操作</th>
            </tr>";

        while($row = $result->fetch_assoc()) {
            echo "<tr>
                <form method='post' action=''>
                <td>".$row["id"]."<input type='hidden' name='id' value='".$row["id"]."'></td>
                <td><input type='text' name='pici' value='".$row["pici"]."'></td>
                <td>
                    <select name='type'>
                        <option value='0' ".($row["type"] == 0 ? "selected" : "").">积极分子</option>
                        <option value='1' ".($row["type"] == 1 ? "selected" : "").">发展对象</option>
                    </select>
                </td>
                <td>
                    <select name='zhuangtai'>
                        <option value='0' ".($row["zhuangtai"] == 0 ? "selected" : "").">进行中</option>
                        <option value='1' ".($row["zhuangtai"] == 1 ? "selected" : "").">已结束</option>
                    </select>
                </td>
                <td><input type='submit' name='update' value='更新'></form>
                <a href='?delete=".$row["id"]."'>删除</a></td>
            </tr>";
        }
        echo "</table>";
    } else {
        echo "0 结果";
    }

    
    ?>

    <h2>新增记录</h2>
    <form method="post" action="">
        <label>推优批次:</label><input type="text" name="pici"><br>
        <label>类型:</label>
        <select name="type">
            <option value="0">积极分子</option>
            <option value="1">发展对象</option>
        </select><br>
        <label>状态:</label>
        <select name="zhuangtai">
            <option value="0">进行中</option>
            <option value="1">已结束</option>
        </select><br>
        <input type="submit" name="submit" value="提交">
    </form>







                                        
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="card">
                                        <div class="card-status-top bg-green"></div>
                                        <div class="card-header">
                                            <h3 class="card-title" _msttexthash="10584678" _msthash="242">批次详细信息</h3>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <?php
// 导入配置文件
require_once('..\controller\.config');

// 连接数据库
$conn = new mysqli($host, $username, $password, $database);

// 检查连接是否成功
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 检查连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

// 查询数据库
$sql = "SELECT * FROM tuiyoujihua WHERE type = 0 AND zhuangtai = 0";
$result = $conn->query($sql);


if(isset($_POST['edit_student'])) {
    $id = $_POST['student_id'];//学生id
    $class_id = $_POST['class_id']; //班级id
    $stuid = $_POST['stuid']; //学号
    $name = $_POST['name']; //姓名
    $mz = $_POST['mz']; //民族
    $sex = $_POST['sex']; //性别
    $idcard = $_POST['idcard']; //身份证号
    $zhiwu = $_POST['zhiwu']; //职务
    $dizhi = $_POST['dizhi']; //地址
    $jihuaid = $_POST['jihuaid']; //计划id
    $xueli = $_POST['xueli']; //学历
    $jiguan = $_POST['jiguan'];//籍贯
    $chushengriqi = $_POST['chushengriqi'];//出生日期
    $rutuannianyue = $_POST['rutuannianyue'];//入团年月
    $peiyangren1 = $_POST['peiyangren1'];//培养人1
    $peiyangren2 = $_POST['peiyangren2'];//培养人2
    $shenqingrudangriqi = $_POST['shenqingrudangriqi'];//申请入党日期
    $jijifenzi = $_POST['jijifenzi'];//积极分子
    $fazhan = $_POST['fazhan'];//发展对象
    $yubei = $_POST['yubei'];//预备党员
    $zhuanzheng = $_POST['zhuanzheng'];//转正日期
    $zhuangtai = $_POST['zhuangtai'];//状态码
    $beizhu = $_POST['beizhu'];//备注

    // 执行更新语句
    $query = "UPDATE tystu SET classid='$class_id', stuid='$stuid', name='$name', mz='$mz', sex='$sex', idcard='$idcard', zhiwu='$zhiwu', dizhi='$dizhi', jihuaid='$jihuaid', xueli='$xueli', jiguan='$jiguan', chushengriqi='$chushengriqi', rutuannianyue='$rutuannianyue', peiyangren1='$peiyangren1', peiyangren2='$peiyangren2', shenqingrudangriqi='$shenqingrudangriqi', jijifenzi='$jijifenzi', fazhan='$fazhan', yubei='$yubei', zhuanzheng='$zhuanzheng', zhuangtai='$zhuangtai', beizhu='$beizhu' WHERE id=$id";
    $result = mysqli_query($conn, $query);
    if($result) {
        echo "学生信息更新成功";
    } else {
        echo "更新学生信息时出错：" . mysqli_error($conn);
    }
}


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










            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    <div class="container-xl d-flex flex-column justify-content-center">
            <div class="empty">
              <p class="empty-title"><?php // 查询数据库
$sql = "SELECT * FROM tuiyoujihua WHERE type = 0 AND zhuangtai = 0";
$result = $conn->query($sql);

// 判断是否有符合条件的数据
if ($result->num_rows > 0) {
    // 符合条件的数据存在，显示相应内容
    while($row = $result->fetch_assoc()) {
        echo "当前\"" . $row["pici"] . "\"批次计划正在审批中。";
    }
} else {
    // 不存在符合条件的数据，显示提示信息
    echo "目前没有开放的批次";
    include '..\sub\footer.php'; // 包含页脚文件
    exit();
}?></p>

            </div>
          </div>
                    </div>
                    
                    <ul class="steps steps-green steps-counter my-4">
                      <li class="step-item">推优开放</li>
                      <li class="step-item">团支部推荐</li>
                      <li class="step-item">团务审核</li>
                      <li class="step-item active">党务审核</li>
                      <li class="step-item">审核通过，推荐成功</li>
                    </ul>
                    <div class="card-body">
                        <div class="row row-cards">
                            <div class="col-md">
                                <div class="card">
                                    <div class="card-status-top bg-red"></div>
                                    <div class="card-header">
                                        <h3 class="card-title" _msttexthash="10584678" _msthash="242">待审核</h3>
                                    </div>
                                    <table class="table">
    <tr>
        <!-- <th>ID</th> -->
        <th>班级</th>
        <!-- <th>学号</th> -->
        <th>姓名</th>
        <th>班级总人数</th>
        <!-- <th>民族</th>
        <th>性别</th>
        <th>身份证号</th>
        <th>职务</th>
        <th>地址</th>
        <th>计划ID</th>
        <th>学历</th>
        <th>籍贯</th>
        <th>出生日期</th>
        <th>入团年月</th>
        <th>培养人1</th>
        <th>培养人2</th>
        <th>申请入党日期</th>
        <th>积极分子日期</th>
        <th>发展对象日期</th>
        <th>预备党员日期</th>
        <th>转正日期日期</th>
        <th>状态码</th> -->
        <th>备注</th>
        <th>操作</th>
    </tr>
    <?php
    //获取推优ID，注意此项在团支书页面设置
    $sql = "SELECT * FROM tuiyoujihua WHERE type = 0 AND zhuangtai = 0";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $jihuaid = $row["id"];
    $query_students = "SELECT * FROM tystu WHERE zhuangtai = 2 AND jihuaid = $jihuaid;";
    $result_students = mysqli_query($conn, $query_students);
    while($row = mysqli_fetch_assoc($result_students)) {
        echo "<tr>";
        //echo "<td>{$row['id']}</td>";

           // 调用之前的逻辑处理来获取classid对应的username
    $id = $row['classid'];

    // 遍历查询结果，查找匹配的id
    mysqli_data_seek($result_class, 0); // 重置查询结果指针到起始位置
    while ($class_row = mysqli_fetch_assoc($result_class)) {
        if ($class_row['id'] == $id) {
            $username = $class_row['username'];
            $bjrs = $class_row['user_type'];
            break;
        }
    }

    if (isset($username)) {
        echo "<td>{$username}</td>";
    } else {
        echo "<td>未知</td>";
    }


        //echo "<td>{$row['stuid']}</td>";
        echo "<td>{$bjrs}</td>";
        echo "<td>{$row['name']}</td>";
        // echo "<td>{$row['mz']}</td>";
        // echo "<td>{$row['sex']}</td>";
        // echo "<td>{$row['idcard']}</td>";
        // echo "<td>{$row['zhiwu']}</td>";
        // echo "<td>{$row['dizhi']}</td>";
        // echo "<td>{$row['jihuaid']}</td>";
        // echo "<td>{$row['xueli']}</td>";
        // echo "<td>{$row['jiguan']}</td>";
        // echo "<td>{$row['chushengriqi']}</td>";
        // echo "<td>{$row['rutuannianyue']}</td>";
        // echo "<td>{$row['peiyangren1']}</td>";
        // echo "<td>{$row['peiyangren2']}</td>";
        // echo "<td>{$row['shenqingrudangriqi']}</td>";
        // echo "<td>{$row['jijifenzi']}</td>";
        // echo "<td>{$row['fazhan']}</td>";
        // echo "<td>{$row['yubei']}</td>";
        // echo "<td>{$row['zhuanzheng']}</td>";
        // echo "<td>{$row['zhuangtai']}</td>";
        echo "<td>{$row['beizhu']}</td>";
        echo "<td><a href='#' onclick='editStudent({$row['id']}, {$row['classid']}, \"{$row['stuid']}\", \"{$row['name']}\", \"{$row['mz']}\", \"{$row['sex']}\", \"{$row['idcard']}\", \"{$row['zhiwu']}\", \"{$row['dizhi']}\", \"{$row['jihuaid']}\", \"{$row['xueli']}\", \"{$row['jiguan']}\", \"{$row['chushengriqi']}\", \"{$row['rutuannianyue']}\", \"{$row['peiyangren1']}\", \"{$row['peiyangren2']}\", \"{$row['shenqingrudangriqi']}\", \"{$row['jijifenzi']}\", \"{$row['fazhan']}\", \"{$row['yubei']}\", \"{$row['zhuanzheng']}\", \"{$row['zhuangtai']}\", \"{$row['beizhu']}\")'>审核</a></td>";
        echo "</tr>";
    }
    ?>
</table>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="card table-responsive">
                                    <div class="card-status-top bg-green"></div>
                                    <div class="card-header">
                                        <h3 class="card-title" _msttexthash="10584678" _msthash="242">该批次推优团员详细信息（包括党团均未审核数据）</h3>
                                        <button onclick="exportToExcel()" class='btn btn-green'>导出数据</button>
                                    </div>
                                    
                                    <table class="table table-vcenter table-nowrap" id="xxxyTable">
    <tr>
        <!-- <th>ID</th> -->
        <th>班级</th>
        <th>班级人数</th>
        <th>学号</th>
        <th>姓名</th>
        
        <th>民族</th>
        <th>性别</th>
        <th>身份证号</th>
        <th>职务</th>
        <th>地址</th>
        <!-- <th>计划ID</th> -->
        <th>学历</th>
        <th>籍贯</th>
        <th>出生日期</th>
        <th>入团年月</th>
        <th>培养人1</th>
        <th>培养人2</th>
        <th>申请入党日期</th>
        <!-- <th>积极分子日期</th>
        <th>发展对象日期</th>
        <th>预备党员日期</th>
        <th>转正日期日期</th> -->
        <th>状态码</th>
        <th>备注</th>
        <th>操作</th>
        <th>挂科科目数量</th>
        <th>处分</th>
        <th>智育班级排名</th>
        <th>综测班级排名</th>
        <th>智育排名百分比</th>
        <th>班级排名百分比</th>
    </tr>
    <?php
    //获取推优ID，注意此项在团支书页面设置
    $sql = "SELECT * FROM tuiyoujihua WHERE type = 0 AND zhuangtai = 0";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $jihuaid = $row["id"];
    $query_students = "SELECT * FROM tystu WHERE jihuaid = $jihuaid;";
    $result_students = mysqli_query($conn, $query_students);
    while($row = mysqli_fetch_assoc($result_students)) {
        echo "<tr>";
        //echo "<td>{$row['id']}</td>";

           // 调用之前的逻辑处理来获取classid对应的username
    $id = $row['classid'];

    // 遍历查询结果，查找匹配的id
    mysqli_data_seek($result_class, 0); // 重置查询结果指针到起始位置
    while ($class_row = mysqli_fetch_assoc($result_class)) {
        if ($class_row['id'] == $id) {
            $username = $class_row['username'];
            $bjrs = $class_row['user_type'];
            break;
        }
    }

    if (isset($username)) {
        echo "<td>{$username}</td>";
        echo "<td>{$bjrs}</td>";
    } else {
        echo "<td>未知</td>";
    }


        echo "<td>{$row['stuid']}</td>";
        echo "<td>{$row['name']}</td>";

        echo "<td>{$row['mz']}</td>";
        echo "<td>{$row['sex']}</td>";
        echo "<td>{$row['idcard']}</td>";
        echo "<td>{$row['zhiwu']}</td>";
        echo "<td>{$row['dizhi']}</td>";
        //echo "<td>{$row['jihuaid']}</td>";
        echo "<td>{$row['xueli']}</td>";
        echo "<td>{$row['jiguan']}</td>";
        echo "<td>{$row['chushengriqi']}</td>";
        echo "<td>{$row['rutuannianyue']}</td>";
        echo "<td>{$row['peiyangren1']}</td>";
        echo "<td>{$row['peiyangren2']}</td>";
        echo "<td>{$row['shenqingrudangriqi']}</td>";
        // echo "<td>{$row['jijifenzi']}</td>";
        // echo "<td>{$row['fazhan']}</td>";
        // echo "<td>{$row['yubei']}</td>";
        // echo "<td>{$row['zhuanzheng']}</td>";
        if ($row['zhuangtai'] == 1) {
            echo "<td>团务审核中</td>";
        } elseif ($row['zhuangtai'] == 2) {
            echo "<td>党务审核中</td>";
        } elseif ($row['zhuangtai'] == 4) {
            echo "<td>流程完毕</td>";
        } else {
            echo "<td>{$row['zhuangtai']}</td>";
        }
        echo "<td>{$row['beizhu']}</td>";
        
        echo "<td><a href='#' onclick='editStudent({$row['id']}, {$row['classid']}, \"{$row['stuid']}\", \"{$row['name']}\", \"{$row['mz']}\", \"{$row['sex']}\", \"{$row['idcard']}\", \"{$row['zhiwu']}\", \"{$row['dizhi']}\", \"{$row['jihuaid']}\", \"{$row['xueli']}\", \"{$row['jiguan']}\", \"{$row['chushengriqi']}\", \"{$row['rutuannianyue']}\", \"{$row['peiyangren1']}\", \"{$row['peiyangren2']}\", \"{$row['shenqingrudangriqi']}\", \"{$row['jijifenzi']}\", \"{$row['fazhan']}\", \"{$row['yubei']}\", \"{$row['zhuanzheng']}\", \"{$row['zhuangtai']}\", \"{$row['beizhu']}\")'>编辑</a></td>";
                // 获取传入的id
                //查询成绩与换算百分比开始
$id = $row['id'];

// 查询匹配的数据
$sql = "SELECT * FROM tychengji WHERE stuid = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // 输出表格头部
    // echo "<table>
    //         <tr>
                // <th>挂科科目数量</th>
                // <th>处分</th>
                // <th>智育班级排名</th>
                // <th>班级排名</th>
    //             <th>备注</th>
    //         </tr>";

    // 输出每行数据
    while ($row = $result->fetch_assoc()) {



        echo "
                <td>" . $row['guake'] . "</td>
                <td>" . $row['chufen'] . "</td>
                <td>" . $row['zhiyu'] . "</td>";
                // 解析 $zhiyu 和 $zongce
                $zhiyu = $row['zhiyu'];
                $zongce = $row['zongce'];
                $zhiyuArray = explode('/', $zhiyu);
$zongceArray = explode('/', $zongce);

// 将 $bjrs 转换为浮点数类型
$bjrs_float = floatval($bjrs);

// 初始化结果数组
$zhiyulu = array();
$zongcelu = array();

// 遍历 $zhiyuArray 和 $zongceArray
foreach ($zhiyuArray as $value) {
    // 将 $value 转换为浮点数类型并进行除法运算，并转换为百分比形式
    $zhiyulu[] = sprintf("%.2f%%", (floatval($value) / $bjrs_float) * 100);
}

foreach ($zongceArray as $value) {
    // 将 $value 转换为浮点数类型并进行除法运算，并转换为百分比形式
    $zongcelu[] = sprintf("%.2f%%", (floatval($value) / $bjrs_float) * 100);
}
echo " <td>" . $row['zongce'] . "</td><td>" . implode('/', $zhiyulu) . "</td><td>" . implode('/', $zongcelu) . "</td>";
                //<td>" . $row['info'] . "</td>
            
    }

} else {
    echo "<td>未录入</td>
    <td>未录入</td>
    <td>未录入</td>
    <td>未录入</td>";
}
        echo "</tr>";
    }
    //换算成绩百分比结束
    ?>
</table>
                                </div>
                            </div>
                        </div><br>
                        <div class="row row-cards">
                        <div class="col-md">
                                    <div class="card">
                                        <div class="card-status-top bg-blue"></div>
                                        <div class="card-header">
                                            <h3 class="card-title" _msttexthash="10584678" _msthash="242">此批次数据统计</h3>
                                        </div>
                                        <?php
    include '..\sub\picifenxi.php'; // 包含页脚文件
    ?>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>

            </div>
        </div>
    </div>

    0=共青团员<br>
1=团委未审核的共青团员<br>
2=党委未审核的共青团员<br>
3=退回团支部修改信息<br>
4=积极分子身份<br>
5=发展对象身份<br>
6=预备党员身份<br>
7=正式党员身份<br>
8=组织关系已转交<br>
9=其他类型、问题党员<br>

<div id="editForm" style="display:none;" class="table">
    <h2>修改学生</h2>
    <form method="post">
        <input type="hidden" name="student_id" id="edit_student_id">
        <label>选择班级:</label>
        <select name="class_id" id="edit_class_id">
            <?php
            mysqli_data_seek($result_class, 0); // Reset result set to the beginning
            while ($row = mysqli_fetch_assoc($result_class)) {
                echo "<option value=\"{$row['id']}\">{$row['username']}</option>";
            }
            ?>
        </select><br>
        <label>学号:</label>
        <input type="text" name="stuid" id="edit_stuid"><br>
        <label>姓名:</label>
        <input type="text" name="name" id="edit_name"><br>
        <label>民族:</label>
        <input type="text" name="mz" id="edit_mz"><br>
        <label>性别:</label>
        <input type="text" name="sex" id="edit_sex"><br>
        <label>身份证号:</label>
        <input type="text" name="idcard" id="edit_idcard"><br>
        <label>职务:</label>
        <input type="text" name="zhiwu" id="edit_zhiwu"><br>
        <label for="edit_dizhi">地址:</label>
        <input type="text" name="dizhi" id="edit_dizhi"><br>
        <label for="edit_jihuaid">计划id:</label>
        <input type="text" name="jihuaid" id="edit_jihuaid"><br>
        <label for="edit_xueli">学历:</label>
        <input type="text" name="xueli" id="edit_xueli"><br>
        <label for="edit_jiguan">籍贯:</label>
        <input type="text" name="jiguan" id="edit_jiguan"><br>
        <label for="edit_chushengriqi">出生日期:</label>
        <input type="date" name="chushengriqi" id="edit_chushengriqi"><br>
        <label for="edit_rutuannianyue">入团年月:</label>
        <input type="text" name="rutuannianyue" id="edit_rutuannianyue"><br>
        <label for="edit_peiyangren1">培养人1:</label>
        <input type="text" name="peiyangren1" id="edit_peiyangren1"><br>
        <label for="edit_peiyangren2">培养人2:</label>
        <input type="text" name="peiyangren2" id="edit_peiyangren2"><br>
        <label for="edit_shenqingrudangriqi">申请入党日期:</label>
        <input type="date" name="shenqingrudangriqi" id="edit_shenqingrudangriqi"><br>
        <label for="edit_jijifenzi">积极分子日期:</label>
        <input type="date" name="jijifenzi" id="edit_jijifenzi"><br>
        <label for="edit_fazhan">发展对象日期:</label>
        <input type="date" name="fazhan" id="edit_fazhan"><br>
        <label for="edit_yubei">预备党员日期:</label>
        <input type="date" name="yubei" id="edit_yubei"><br>
        <label for="edit_zhuanzheng">转正日期日期:</label>
        <input type="date" name="zhuanzheng" id="edit_zhuanzheng"><br>
        <label for="edit_zhuangtai">状态码:</label>
        <input type="text" name="zhuangtai" id="edit_zhuangtai"><br>
        <label for="edit_beizhu">备注:</label>
        <input type="text" name="beizhu" id="edit_beizhu"><br>

        <input type="submit" name="edit_student" value="保存修改">
    </form>
</div>


<script>
function editStudent(id, classId, stuid, name, mz, sex, idcard, zhiwu, dizhi, jihuaid, xueli, jiguan, chushengriqi, rutuannianyue, peiyangren1, peiyangren2, shenqingrudangriqi, jijifenzi, fazhan, yubei, zhuanzheng, zhuangtai, beizhu) {
    document.getElementById('editForm').style.display = 'block';
    document.getElementById('edit_student_id').value = id;
    document.getElementById('edit_class_id').value = classId;
    document.getElementById('edit_stuid').value = stuid;
    document.getElementById('edit_name').value = name;
    document.getElementById('edit_mz').value = mz;
    document.getElementById('edit_sex').value = sex;
    document.getElementById('edit_idcard').value = idcard;
    document.getElementById('edit_zhiwu').value = zhiwu;
    document.getElementById('edit_dizhi').value = dizhi;
    document.getElementById('edit_jihuaid').value = jihuaid;
    document.getElementById('edit_xueli').value = xueli;
    document.getElementById('edit_jiguan').value = jiguan;
    document.getElementById('edit_chushengriqi').value = chushengriqi;
    document.getElementById('edit_rutuannianyue').value = rutuannianyue;
    document.getElementById('edit_peiyangren1').value = peiyangren1;
    document.getElementById('edit_peiyangren2').value = peiyangren2;
    document.getElementById('edit_shenqingrudangriqi').value = shenqingrudangriqi;
    document.getElementById('edit_jijifenzi').value = jijifenzi;
    document.getElementById('edit_fazhan').value = fazhan;
    document.getElementById('edit_yubei').value = yubei;
    document.getElementById('edit_zhuanzheng').value = zhuanzheng;
    document.getElementById('edit_zhuangtai').value = 4;
    document.getElementById('edit_beizhu').value = beizhu;
}

function exportToExcel() {
            const table = document.getElementById("xxxyTable");
            const rows = table.querySelectorAll("tr");
            let csvContent = "";

            rows.forEach(function(row, index) {
                const rowData = [];
                const cells = row.querySelectorAll("td, th");
                cells.forEach(function(cell, cellIndex) {
                    rowData.push('"' + cell.innerText.replace(/"/g, '""') + '"');
                });
                csvContent += rowData.join(",") + "\n";
            });

            const blob = new Blob(["\ufeff" + csvContent], { type: "text/csv;charset=utf-8;" });
            const url = URL.createObjectURL(blob);
            const link = document.createElement("a");
            link.setAttribute("href", url);
            link.setAttribute("download", "table_data.csv");
            link.style.visibility = "hidden";
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }





</script>

    <?php
    include '..\sub\footer.php'; // 包含页脚文件
    $conn->close();
    ?>