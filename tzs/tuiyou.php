<?php
    $pageTitle = "推优管理"; // 设置页面标题
    $qxyq = "5"; // 设置权限
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

    <!-- Navbar -->
    <?php
    include '..\sub\bodyhead.php';
    include './menu.php';
    ?>

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



    // 判断是否有符合条件的数据
    
    if ($result->num_rows > 0) {
        // 符合条件的数据存在，显示相应内容
        while ($row = $result->fetch_assoc()) {
            
        }
    } else {
        // 不存在符合条件的数据，显示提示信息
        echo "<h2>目前没有开放的批次</h2><br>";
        include '..\sub\footer.php'; // 包含页脚文件
        exit();
    }


    // 获取class表数据
    $query_class = "SELECT id, username FROM class";
    $result_class = mysqli_query($conn, $query_class);


    // 从$_SESSION['username']获取用户登录名
    $user_username = $_SESSION['username'];

    // 查询tzb表以获取登录名所在行数据的classid
    $query_tzb = "SELECT classid FROM tzb WHERE shujiname = '$user_username'";
    $result_tzb = mysqli_query($conn, $query_tzb);

    if (mysqli_num_rows($result_tzb) > 0) {
        $row_tzb = mysqli_fetch_assoc($result_tzb);
        $classid = $row_tzb['classid'];

        // 使用classid查询class表以获取班级信息
        $query_class = "SELECT id, username FROM class WHERE id = $classid";
        $result_class = mysqli_query($conn, $query_class);

        // 显示班级信息
    
    } else {
        // 处理未找到匹配班级的情况
        echo "<option value='-1'>No Class Found</option>";
    }


    if (isset($_POST['edit_student'])) {
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
        if ($result) {
            echo "学生信息更新成功";
        } else {
            echo "更新学生信息时出错：" . mysqli_error($conn);
        }
    }



    ?>

<div class="page-wrapper">
        <!-- Page body -->
        <div class="page-body">
          <div class="container-xl">
            <div class="row row-cards">


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
        echo "当前\"" . $row["pici"] . "\"批次计划正在推荐中";
    }
} else {
    // 不存在符合条件的数据，显示提示信息
    echo "目前没有开放的批次";
    include '..\sub\footer.php'; // 包含页脚文件
    exit();
}?></p>

            </div>
          </div>
                    
                <ul class="steps steps-green steps-counter my-4">
                    <li class="step-item">推优开放</li>
                    <li class="step-item active">团支部推荐</li>
                    <li class="step-item">团务审核</li>
                    <li class="step-item">党务审核</li>
                    <li class="step-item">推荐成功</li>
                </ul>
            </div>
            <div class="card-body">
                <div class="row row-cards">
                    <div class="col-md">
                        <div class="card">
                            <div class="card-status-top bg-red"></div>
                            <div class="card-header">
                                <h3 class="card-title" _msttexthash="10570118" _msthash="241">可推荐团员</h3>
                            </div>
                            <table class="table table table-vcenter card-table">
                                <tr>
                                    <!-- <th>ID</th>
        <th>班级</th> -->
                                    <th>学号</th>
                                    <th>姓名</th>
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
        <th>状态码</th>
        <th>备注</th> -->
                                    <th>操作</th>
                                </tr>
                                <?php
                                session_start();

                                // 假设$_SESSION['username']包含用户登录名
                                $username = $_SESSION['username'];

                                // 查询用户的classid
                                $query_classid = "SELECT classid FROM tzb WHERE shujiname = '$username'";
                                $result_classid = mysqli_query($conn, $query_classid);
                                $row_classid = mysqli_fetch_assoc($result_classid);
                                $classid = $row_classid['classid'];

                                // 查询符合条件的学生数据
                                $query_students = "SELECT * FROM tystu WHERE classid = '$classid' AND zhuangtai = 0";
                                $result_students = mysqli_query($conn, $query_students);

                                while ($row = mysqli_fetch_assoc($result_students)) {
                                    echo "<tr>";
                                    // echo "<td>{$row['id']}</td>";
                                    // echo "<td>{$row['classid']}</td>";
                                    echo "<td>{$row['stuid']}</td>";
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
                                    // echo "<td>{$row['beizhu']}</td>";
                                
                                    echo " <td> <a  href='#' class='btn' data-bs-toggle='modal' data-bs-target='#edit' onclick='editStudent({$row['id']}, {$row['classid']}, \"{$row['stuid']}\", \"{$row['name']}\", \"{$row['mz']}\", \"{$row['sex']}\", \"{$row['idcard']}\", \"{$row['zhiwu']}\", \"{$row['dizhi']}\", \"{$row['jihuaid']}\", \"{$row['xueli']}\", \"{$row['jiguan']}\", \"{$row['chushengriqi']}\", \"{$row['rutuannianyue']}\", \"{$row['peiyangren1']}\", \"{$row['peiyangren2']}\", \"{$row['shenqingrudangriqi']}\", \"{$row['jijifenzi']}\", \"{$row['fazhan']}\", \"{$row['yubei']}\", \"{$row['zhuanzheng']}\", \"{$row['zhuangtai']}\", \"{$row['beizhu']}\")'>点击推荐</a></td></tr>";
                                    echo "</tr>";
                                }

                                //获取推优ID，注意此项在团支书页面设置
                                $sql = "SELECT * FROM tuiyoujihua WHERE type = 0 AND zhuangtai = 0";
                                $result = $conn->query($sql);
                                $row = $result->fetch_assoc();
                                $jihuaid = $row["id"];

                                ?>

                            </table>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="card">
                            <div class="card-status-top bg-green"></div>
                            <div class="card-header">
                                <h3 class="card-title" _msttexthash="10584678" _msthash="242">审核中团员</h3>
                            </div>
                            <table class="table">
                                <tr>
                                    <!-- <th>ID</th>
        <th>班级</th> -->
                                    <th>学号</th>
                                    <th>姓名</th>
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
        <th>转正日期日期</th>-->
                                    <th>审核状态</th>
                                    <!-- <th>备注</th>  -->
                                    <!-- <th>操作</th> -->
                                </tr>
                                <?php
                                session_start();

                                // 假设$_SESSION['username']包含用户登录名
                                $username = $_SESSION['username'];

                                // 查询用户的classid
                                $query_classid = "SELECT classid FROM tzb WHERE shujiname = '$username'";
                                $result_classid = mysqli_query($conn, $query_classid);
                                $row_classid = mysqli_fetch_assoc($result_classid);
                                $classid = $row_classid['classid'];

                                // 查询符合条件的学生数据
                                $query_students = "SELECT * FROM tystu WHERE classid = '$classid' AND (zhuangtai = 1 OR zhuangtai = 2)";
                                $result_students = mysqli_query($conn, $query_students);

                                while ($row = mysqli_fetch_assoc($result_students)) {
                                    echo "<tr>";
                                    // echo "<td>{$row['id']}</td>";
                                    // echo "<td>{$row['classid']}</td>";
                                    echo "<td>{$row['stuid']}</td>";
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
                                    if ($row['zhuangtai'] == 1) {
                                        echo "<td>团务审核中</td>";
                                    } elseif ($row['zhuangtai'] == 2) {
                                        echo "<td>党务审核中</td>";
                                    } else {
                                        echo "<td>{$row['zhuangtai']}</td>";
                                    }
                                    // echo "<td>{$row['beizhu']}</td>";
                                    //echo "<td><a href='#' onclick='editStudent({$row['id']}, {$row['classid']}, \"{$row['stuid']}\", \"{$row['name']}\", \"{$row['mz']}\", \"{$row['sex']}\", \"{$row['idcard']}\", \"{$row['zhiwu']}\", \"{$row['dizhi']}\", \"{$row['jihuaid']}\", \"{$row['xueli']}\", \"{$row['jiguan']}\", \"{$row['chushengriqi']}\", \"{$row['rutuannianyue']}\", \"{$row['peiyangren1']}\", \"{$row['peiyangren2']}\", \"{$row['shenqingrudangriqi']}\", \"{$row['jijifenzi']}\", \"{$row['fazhan']}\", \"{$row['yubei']}\", \"{$row['zhuanzheng']}\", \"{$row['zhuangtai']}\", \"{$row['beizhu']}\")'>推荐</a></td>";
                                    echo "</tr>";
                                }
                                ?>

                            </table>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="card">
                            <div class="card-status-top bg-blue"></div>
                            <div class="card-header">
                                <h3 class="card-title" _msttexthash="10571054" _msthash="243">历史推荐团员</h3>
                            </div>
                            <table class="table">
                                <tr>
                                    <!-- <th>ID</th>
        <th>班级</th> -->
                                    <th>学号</th>
                                    <th>姓名</th>
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
        <th>转正日期日期</th>-->
                                    <th>审核状态</th>
                                    <!-- <th>备注</th>  -->
                                    <!-- <th>操作</th> -->
                                </tr>
                                <?php
                                session_start();

                                // 假设$_SESSION['username']包含用户登录名
                                $username = $_SESSION['username'];

                                // 查询用户的classid
                                $query_classid = "SELECT classid FROM tzb WHERE shujiname = '$username'";
                                $result_classid = mysqli_query($conn, $query_classid);
                                $row_classid = mysqli_fetch_assoc($result_classid);
                                $classid = $row_classid['classid'];

                                // 查询符合条件的学生数据
                                $query_students = "SELECT * FROM tystu WHERE classid = '$classid' AND zhuangtai > 3";
                                $result_students = mysqli_query($conn, $query_students);

                                while ($row = mysqli_fetch_assoc($result_students)) {
                                    echo "<tr>";
                                    // echo "<td>{$row['id']}</td>";
                                    // echo "<td>{$row['classid']}</td>";
                                    echo "<td>{$row['stuid']}</td>";
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
                                    echo "<td>已审核通过</td>";
                                    // echo "<td>{$row['beizhu']}</td>";
                                    //echo "<td><a href='#' onclick='editStudent({$row['id']}, {$row['classid']}, \"{$row['stuid']}\", \"{$row['name']}\", \"{$row['mz']}\", \"{$row['sex']}\", \"{$row['idcard']}\", \"{$row['zhiwu']}\", \"{$row['dizhi']}\", \"{$row['jihuaid']}\", \"{$row['xueli']}\", \"{$row['jiguan']}\", \"{$row['chushengriqi']}\", \"{$row['rutuannianyue']}\", \"{$row['peiyangren1']}\", \"{$row['peiyangren2']}\", \"{$row['shenqingrudangriqi']}\", \"{$row['jijifenzi']}\", \"{$row['fazhan']}\", \"{$row['yubei']}\", \"{$row['zhuanzheng']}\", \"{$row['zhuangtai']}\", \"{$row['beizhu']}\")'>推荐</a></td>";
                                    echo "</tr>";
                                }
                                ?>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
</div>


    <!-- <div id="editForm" style="display:none;">
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
            <input type="text" name="jihuaid" id="edit_jihuaid" readonly="readonly"><br>
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
            <input type="text" name="zhuangtai" id="edit_zhuangtai" readonly="readonly"><br>
            <label for="edit_beizhu">备注:</label>
            <input type="text" name="beizhu" id="edit_beizhu"><br>

            <input type="submit" name="edit_student" value="保存修改">
        </form>
    </div> -->

<!-- 修改学生开始 -->

<div class="modal modal-blur fade" id="edit" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <form method="post">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">提交信息</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
        
        
      
          <div class="modal-body">

        <div class="row row-cards">
        <input type="hidden" name="student_id" id="edit_student_id">
                        <div class="col-md-3">
                            <div class="input-group mb-3">
                            <label class="col-form-label input-group-text required">学号</label>
                            <input type="text" name="stuid" id="edit_stuid" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group mb-3">
        <label class="col-form-label input-group-text required">姓名</label>
                    
                      <input type="text" name="name" class="form-control" id="edit_name" placeholder="输入姓名" required readonly="readonly">
                    </div>
                  </div>
                        
                        <div class="col-md-6">
                            <div class="input-group mb-3">
        <label class="col-form-label input-group-text required">选择班级</label>
                    
                    <select name="class_id" id="edit_class_id" class="form-select">
        <?php 
        // 从$_SESSION['username']获取用户登录名
$user_username = $_SESSION['username'];

// 查询tzb表以获取登录名所在行数据的classid
$query_tzb = "SELECT classid FROM tzb WHERE shujiname = '$user_username'";
$result_tzb = mysqli_query($conn, $query_tzb);
if(mysqli_num_rows($result_tzb) > 0) {
    $row_tzb = mysqli_fetch_assoc($result_tzb);
    $classid = $row_tzb['classid'];

    // 使用classid查询class表以获取班级信息
    $query_class = "SELECT id, username FROM class WHERE id = $classid";
    $result_class = mysqli_query($conn, $query_class);

    // 显示班级信息
    while($row_class = mysqli_fetch_assoc($result_class)) {
        ?>
        <option value="<?php echo $row_class['id']; ?>"><?php echo $row_class['username']; ?></option>
        <?php
    }
} else {
    // 处理未找到匹配班级的情况
    echo "<option value='-1'>No Class Found</option>";
}?>
    </select>
                    </div>
                  </div>
                        
                        <div class="col-md-3">
                            <div class="input-group mb-3">
        <label class="col-form-label input-group-text required">民族</label>
                    
                      <input name="mz" id="edit_mz" class="form-control"  required>
                    </div>
                  </div>
                        
                        <div class="col-md-3">
                            <div class="input-group mb-3">
        <label class="col-form-label input-group-text required">性别</label>
                    
                      <input name="sex" id="edit_sex" class="form-control"  required>
                    </div>
                  </div>
                        
                        <div class="col-md-6">
                            <div class="input-group mb-3">
        <label class="col-form-label input-group-text required">班级职务</label>
                    
                      <input name="zhiwu" id="edit_zhiwu" class="form-control"  required>
                    </div>
                  </div>
                   
                   <div class="col-md-3">
                            <div class="input-group mb-3">
        <label class=" col-form-label input-group-text required">籍贯</label>
                    
                      <input name="jiguan" id="edit_jiguan" class="form-control" placeholder="省+市或者省+县" required>
                    </div>
                  </div>
                        
                        <div class="col-md-5">
                            <div class="input-group mb-3">
        <label class="col-form-label input-group-text required">出生日期</label>
                    
                      <input type="date" name="chushengriqi" id="edit_chushengriqi" class="form-control" placeholder="出生日期" required>
                    </div>
                  </div>
                  
                  <div class="col-md-4">
                            <div class="input-group">
                    <label class="col-form-label input-group-text required">入团年月</label>
                    
                      <input type="text" name="rutuannianyue" id="edit_rutuannianyue" class="form-control" placeholder="XXXX年X月" required>
                      <small class="form-hint">格式必须是：XXXX年X月<br>如：2015年8月、2015年12月</small>
                    </div>
                  </div>
                        
                        <div class="col-md-5">
                            <div class="input-group mb-3">
        <label class="col-form-label input-group-text required">身份证号</label>
        
            <input type="text" name="idcard" id="edit_idcard" class="form-control" required>
        </div>
    </div>

<div class="col-md-7">
                            <div class="input-group mb-3">
        <label class="col-form-label input-group-text required" for="edit_dizhi">户籍地址</label>
        
            <input type="text" name="dizhi" id="edit_dizhi" class="form-control" required>
        </div>
    </div>

<!-- <div class="col-md-3" style="display:none;"> -->
<div class="col-md-3" style="display:none;">
                            <div class="input-group mb-3">
        <label class="col-form-label input-group-text required" for="edit_jihuaid">计划ID</label>
        
            <input type="text" name="jihuaid" id="edit_jihuaid" class="form-control">
        </div>
    </div>

<div class="col-md-4">
                            <div class="input-group mb-3">
        <label class="col-form-label input-group-text required" for="edit_xueli">学历</label>
        
            <input type="text" name="xueli" id="edit_xueli" class="form-control" required>
            
        </div>
        <small class="form-hint">格式：大学专科在读</small>
    </div>

<div class="col-md-4">
                            <div class="input-group mb-3">
        <label class="col-form-label input-group-text required" for="edit_peiyangren1">培养人1</label>
        
            <input type="text" name="peiyangren1" id="edit_peiyangren1" class="form-control" required>
        </div>
    </div>

<div class="col-md-4">
                            <div class="input-group mb-3">
        <label class="col-form-label input-group-text required" for="edit_peiyangren2">培养人2</label>
        
            <input type="text" name="peiyangren2" id="edit_peiyangren2" class="form-control" required>
        </div>
    </div>

<div class="col-md-4">
                            <div class="input-group mb-3">
        <label class="col-form-label input-group-text required" for="edit_shenqingrudangriqi">入党申请书落款日期</label>
        
            <input type="date" name="shenqingrudangriqi" id="edit_shenqingrudangriqi" class="form-control" required>
        </div>
    </div>

<div class="col-md-6" style="display:none;">
                            <div class="input-group mb-3">
        <label class="col-form-label input-group-text required" for="edit_jijifenzi">积极分子日期</label>
        
            <input type="date" name="jijifenzi" id="edit_jijifenzi" class="form-control" >
        </div>
    </div>

<div class="col-md-6" style="display:none;">
                            <div class="input-group mb-3">
        <label class="col-form-label input-group-text required" for="edit_fazhan">发展对象日期</label>
        
            <input type="date" name="fazhan" id="edit_fazhan" class="form-control" >
        </div>
    </div>

<div class="col-md-6" style="display:none;">
                            <div class="input-group mb-3">
        <label class="col-form-label input-group-text required" for="edit_yubei">预备党员日期</label>
        
            <input type="date" name="yubei" id="edit_yubei" class="form-control" >
        </div>
    </div>

<div class="col-md-6" style="display:none;">
                            <div class="input-group mb-3">
        <label class="col-form-label input-group-text required" for="edit_zhuanzheng">转正日期日期</label>
        
            <input type="date" name="zhuanzheng" id="edit_zhuanzheng" class="form-control" >
        </div>
    </div>

<div class="col-md-3" style="display:none;">
                            <div class="input-group mb-3">
        <label class="col-form-label input-group-text required" for="edit_zhuangtai">状态码</label>
        
            <input type="text" name="zhuangtai" id="edit_zhuangtai" class="form-control" >
        </div>
    </div>

<div class="col-md-8">
                            <div class="input-group mb-3">
        <label class="col-form-label input-group-text" for="edit_beizhu">备注</label>
        
            <input type="text" name="beizhu" id="edit_beizhu" class="form-control">
            
        </div>
        <small class="form-hint">格式：学院职务（没有不填）+团支部书记评语</small>
    </div>
</div> 

        
    
          </div>


        
        
        <div class="modal-footer">
            <button type="button" class="btn me-auto" data-bs-dismiss="modal">取消推荐</button>
            <input type="submit" name="edit_student" value="提交信息并推荐" class="btn btn-primary"> 
                   
        </div>
        </div>
        </form> 
    </div>
    </div>

<!-- 修改学生结束 -->

    <script>
        function editStudent(id, classId, stuid, name, mz, sex, idcard, zhiwu, dizhi, jihuaid, xueli, jiguan, chushengriqi, rutuannianyue, peiyangren1, peiyangren2, shenqingrudangriqi, jijifenzi, fazhan, yubei, zhuanzheng, zhuangtai, beizhu) {
            //document.getElementById('editForm').style.display = 'block';
            document.getElementById('edit_student_id').value = id;
            document.getElementById('edit_class_id').value = classId;
            document.getElementById('edit_stuid').value = stuid;
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_mz').value = mz;
            document.getElementById('edit_sex').value = sex;
            document.getElementById('edit_idcard').value = idcard;
            document.getElementById('edit_zhiwu').value = zhiwu;
            document.getElementById('edit_dizhi').value = dizhi;
            document.getElementById('edit_jihuaid').value = <?php echo $jihuaid; ?>;
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
            document.getElementById('edit_zhuangtai').value = 1;
            document.getElementById('edit_beizhu').value = beizhu;
        }

    </script>

    <?php
    include '..\sub\footer.php'; // 包含页脚文件
    $conn->close();
    ?>