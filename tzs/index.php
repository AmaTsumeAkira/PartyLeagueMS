<?php
    $pageTitle = "团员管理"; // 设置页面标题
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
    <div class="page">
        <!-- Navbar -->
        <?php
    include '..\sub\bodyhead.php'; 
    include './menu.php'; 
    ?>
<?php
// Include database configuration file
include_once('../controller/.config');

// 创建数据库连接
$conn = new mysqli($host, $username, $password, $database);


// 检查连接
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['add_student'])) {
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

    // 执行插入语句到 tystu 表中
    $query = "INSERT INTO tystu (classid, stuid, name, mz, sex, idcard, zhiwu, dizhi, jihuaid, xueli, jiguan, chushengriqi, rutuannianyue, peiyangren1, peiyangren2, shenqingrudangriqi, jijifenzi, fazhan, yubei, zhuanzheng, zhuangtai, beizhu) VALUES ('$class_id', '$stuid', '$name', '$mz', '$sex', '$idcard', '$zhiwu', '$dizhi', '$jihuaid', '$xueli', '$jiguan', '$chushengriqi', '$rutuannianyue', '$peiyangren1', '$peiyangren2', '$shenqingrudangriqi', '$jijifenzi', '$fazhan', '$yubei', '$zhuanzheng', '$zhuangtai', '$beizhu')";
    $result = mysqli_query($conn, $query);
    if($result) {
        echo "学生添加成功";
        echo "<script>location.href='index.php';</script>";
    } else {
        echo "添加学生时出错：" . mysqli_error($conn);
    }
}

// 删除学生逻辑
if(isset($_GET['delete_student'])) {
    $id = $_GET['delete_student'];

    // 执行删除语句
    $query = "DELETE FROM tystu WHERE id = $id";
    $result = mysqli_query($conn, $query);
    if($result) {
        echo "学生删除成功";
    } else {
        echo "删除学生时出错：" . mysqli_error($conn);
    }
    echo "<script>location.href='index.php';</script>";
}

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
        //刷新网页
        echo "<script>location.href='index.php';</script>";
    } else {
        echo "更新学生信息时出错：" . mysqli_error($conn);
    }
}

// 获取class表数据
$query_class = "SELECT id, username FROM class";
$result_class = mysqli_query($conn, $query_class);


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
        <!-- <option value="<?php echo $row_class['id']; ?>"><?php echo $row_class['username']; ?></option> -->
        <?php
    }
} else {
    // 处理未找到匹配班级的情况
    echo "<option value='-1'>No Class Found</option>";
}


?>

<div class="page-wrapper">
        <!-- Page body -->
        <div class="page-body">
          <div class="container-xl">
            <div class="row row-cards">
              <div class="col-lg-8">
                <div class="card card-lg table-responsive">

                  <table class="table table table-vcenter card-table">
    <tr>
        <!-- <th>ID</th>
        <th>班级</th> -->
        <th>学号</th>
        <th>姓名</th>
        <th>民族</th>
        <th>性别</th>
        <!-- <th>身份证号</th> -->
        <th>班级职务</th>
        <!-- <th>地址</th>
        <th>计划ID</th> -->
        <!-- <th>学历</th> -->
        <th>籍贯</th>
        <th>出生日期</th>
        <th>入团年月</th>
        <!-- <th>培养人1</th>
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
$query_students = "SELECT * FROM tystu WHERE classid = '$classid'";
$result_students = mysqli_query($conn, $query_students);

while($row = mysqli_fetch_assoc($result_students)) {
    echo "<tr>";
    // echo "<td>{$row['id']}</td>";
    // echo "<td>{$row['classid']}</td>";
    echo "<td>{$row['stuid']}</td>";
    echo "<td>{$row['name']}</td>";
    echo "<td>{$row['mz']}</td>";
    echo "<td>{$row['sex']}</td>";
    // echo "<td>{$row['idcard']}</td>";
    echo "<td>{$row['zhiwu']}</td>";
    // echo "<td>{$row['dizhi']}</td>";
    // echo "<td>{$row['jihuaid']}</td>";
    // echo "<td>{$row['xueli']}</td>";
    echo "<td>{$row['jiguan']}</td>";
    echo "<td>{$row['chushengriqi']}</td>";
    echo "<td>{$row['rutuannianyue']}</td>";
    // echo "<td>{$row['peiyangren1']}</td>";
    // echo "<td>{$row['peiyangren2']}</td>";
    // echo "<td>{$row['shenqingrudangriqi']}</td>";
    // echo "<td>{$row['jijifenzi']}</td>";
    // echo "<td>{$row['fazhan']}</td>";
    // echo "<td>{$row['yubei']}</td>";
    // echo "<td>{$row['zhuanzheng']}</td>";
    // echo "<td>{$row['zhuangtai']}</td>";
    // echo "<td>{$row['beizhu']}</td>";
    // echo "<td><a class='btn btn-danger' href='?delete_student={$row['id']}'>删除</a>";
    echo " <td> <a  href='#' class='btn' data-bs-toggle='modal' data-bs-target='#edit' onclick='editStudent({$row['id']}, {$row['classid']}, \"{$row['stuid']}\", \"{$row['name']}\", \"{$row['mz']}\", \"{$row['sex']}\", \"{$row['idcard']}\", \"{$row['zhiwu']}\", \"{$row['dizhi']}\", \"{$row['jihuaid']}\", \"{$row['xueli']}\", \"{$row['jiguan']}\", \"{$row['chushengriqi']}\", \"{$row['rutuannianyue']}\", \"{$row['peiyangren1']}\", \"{$row['peiyangren2']}\", \"{$row['shenqingrudangriqi']}\", \"{$row['jijifenzi']}\", \"{$row['fazhan']}\", \"{$row['yubei']}\", \"{$row['zhuanzheng']}\", \"{$row['zhuangtai']}\", \"{$row['beizhu']}\")'>修改</a></td></tr>";
}
?>

</table>

                </div>
              </div>
              <div class="col-lg-4">



              <form method="post" class="card">
                <div class="card-header">
                  <h3 class="card-title">添加新团员</h3>
                </div>
                <div class="card-body">
                  <div class="mb-3">
                    <label class="col-3 col-form-label required">完整学号</label>
                    <div class="col">
                      <input type="text" name="stuid" class="form-control" placeholder="输入完整12位学号" required>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label class="col-3 col-form-label required">姓名</label>
                    <div class="col">
                      <input type="text" name="name" class="form-control" placeholder="输入姓名" required>
                      <!-- <small class="form-hint">
                        Your password must be 8-20 characters long, contain letters and numbers, and must not contain
                        spaces, special characters, or emoji.
                      </small> -->
                    </div>
                  </div>
                  <div class="mb-3">
                    <label class="col-3 col-form-label required">选择班级</label>
                    <div class="col">
                    <select name="class_id" class="form-select">
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
                  <div class="mb-3">
                    <label class="col-3 col-form-label required">选择民族</label>
                    <div class="col">
                    <select name="mz" class="form-select">
                    <option value="汉族">汉族</option>
                    <option value="蒙古族">蒙古族</option>
                    <option value="回族">回族</option>
                    <option value="藏族">藏族</option>
                    <option value="维吾尔族">维吾尔族</option>
                    <option value="苗族">苗族</option>
                    <option value="彝族">彝族</option>
                    <option value="壮族">壮族</option>
                    <option value="布依族">布依族</option>
                    <option value="朝鲜族">朝鲜族</option>
                    <option value="满族">满族</option>
                    <option value="侗族">侗族</option>
                    <option value="瑶族">瑶族</option>
                    <option value="白族">白族</option>
                    <option value="土家族">土家族</option>
                    <option value="哈尼族">哈尼族</option>
                    <option value="哈萨克族">哈萨克族</option>
                    <option value="傣族">傣族</option>
                    <option value="黎族">黎族</option>
                    <option value="傈僳族">傈僳族</option>
                    <option value="佤族">佤族</option>
                    <option value="畲族">畲族</option>
                    <option value="高山族">高山族</option>
                    <option value="拉祜族">拉祜族</option>
                    <option value="水族">水族</option>
                    <option value="东乡族">东乡族</option>
                    <option value="纳西族">纳西族</option>
                    <option value="景颇族">景颇族</option>
                    <option value="柯尔克孜族">柯尔克孜族</option>
                    <option value="土族">土族</option>
                    <option value="达斡尔族">达斡尔族</option>
                    <option value="仫佬族">仫佬族</option>
                    <option value="羌族">羌族</option>
                    <option value="布朗族">布朗族</option>
                    <option value="撒拉族">撒拉族</option>
                    <option value="毛南族">毛南族</option>
                    <option value="仡佬族">仡佬族</option>
                    <option value="锡伯族">锡伯族</option>
                    <option value="阿昌族">阿昌族</option>
                    <option value="普米族">普米族</option>
                    <option value="塔吉克族">塔吉克族</option>
                    <option value="怒族">怒族</option>
                    <option value="乌孜别克族">乌孜别克族</option>
                    <option value="俄罗斯族">俄罗斯族</option>
                    <option value="鄂温克族">鄂温克族</option>
                    <option value="德昂族">德昂族</option>
                    <option value="保安族">保安族</option>
                    <option value="裕固族">裕固族</option>
                    <option value="京族">京族</option>
                    <option value="塔塔尔族">塔塔尔族</option>
                    <option value="独龙族">独龙族</option>
                    <option value="鄂伦春族">鄂伦春族</option>
                    <option value="赫哲族">赫哲族</option>
                    <option value="门巴族">门巴族</option>
                    <option value="珞巴族">珞巴族</option>
                    <option value="基诺族">基诺族</option>
                    </select>
                    </div>
                  </div>




                  <div class="row">
  <label class="col-3 col-form-label pt-0 required">性别</label>
  <div class="col">
  <select name="sex" class="form-select">
                    <option value="男">男</option>
                    <option value="女">女</option>
                    </select>
  </div>
</div>
                  <div class="mb-3">
                    <label class="col-3 col-form-label required">班级职务</label>
                    <div class="col">
                      <input type="text" name="zhiwu" class="form-control" placeholder="无职务填学生" required>
                      <small class="form-hint">无职务填学生，书记填团支部书记</small>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label class="col-3 col-form-label required">籍贯</label>
                    <div class="col">
                      <input type="text" name="jiguan" class="form-control" placeholder="省+市或者省+县" required>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label class="col-3 col-form-label required">出生日期</label>
                    <div class="col">
                      <input type="date" name="chushengriqi" class="form-control" placeholder="出生日期" required>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label class="col-3 col-form-label required">入团年月</label>
                    <div class="col">
                      <input type="text" name="rutuannianyue" class="form-control" placeholder="XXXX年X月" required>
                      <small class="form-hint">格式必须是：XXXX年X月<br>如：2015年8月、2015年12月</small>
                    </div>
                  </div>
                </div>
                <div class="card-footer text-end">
                <input type="submit" name="add_student" class="btn btn-primary" value="添加团员">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

<!-- 修改学生开始 -->

      <div class="modal modal-blur fade" id="edit" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <form method="post">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">修改团员信息</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
        
        
      
          <div class="modal-body">

        <div class="row row-cards">
        <input type="hidden" name="student_id" id="edit_student_id">
 
        
          <div class="col-md-3">
    <div class="mb-3">
        <label class="col-10 col-form-label required">完整学号</label>
                    <div class="col">
                      <input type="text" name="stuid" id="edit_stuid" class="form-control" required>
                    </div>
                  </div>
                        </div>
                        <div class="col-md-3">
    <div class="mb-3">
        <label class="col-10 col-form-label required">姓名</label>
                    <div class="col">
                      <input type="text" name="name" class="form-control" id="edit_name" placeholder="输入姓名" required readonly="readonly">
                    </div>
                  </div>
                        </div>
                        <div class="col-md-3" style="display:none;">
    <div class="mb-3">
        <label class="col-10 col-form-label required">选择班级</label>
                    <div class="col">
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
                        </div>
                        <div class="col-md-3">
    <div class="mb-3">
        <label class="col-10 col-form-label required">民族</label>
                    <div class="col">
                      <input name="mz" id="edit_mz" class="form-control"  required>
                    </div>
                  </div>
                        </div>
                        <div class="col-md-2">
    <div class="mb-2">
        <label class="col-5 col-form-label required">性别</label>
                    <div class="col">
                      <input name="sex" id="edit_sex" class="form-control"  required>
                    </div>
                  </div>
                        </div>
                        <div class="col-md-3">
    <div class="mb-3">
        <label class="col-10 col-form-label required">班级职务</label>
                    <div class="col">
                      <input name="zhiwu" id="edit_zhiwu" class="form-control"  required>
                      <small class="form-hint">无职务填学生，书记填团支部书记</small>
                    </div>
                  </div>
                   </div>
                   <div class="col-md-2">
    <div class="mb-2">
        <label class="col-5 col-form-label required">籍贯</label>
                    <div class="col">
                      <input name="jiguan" id="edit_jiguan" class="form-control" placeholder="省+市或者省+县" required>
                    </div>
                  </div>
                        </div>
                        <div class="col-md-3">
    <div class="mb-3">
        <label class="col-10 col-form-label required">出生日期</label>
                    <div class="col">
                      <input type="date" name="chushengriqi" id="edit_chushengriqi" class="form-control" placeholder="出生日期" required>
                    </div>
                  </div>
                  </div>
                        <div class="col-md-4">
                        <div class="mb-4">
                    <label class="col-10 col-form-label required">入团年月</label>
                    <div class="col">
                      <input type="text" name="rutuannianyue" id="edit_rutuannianyue" class="form-control" placeholder="XXXX年X月" required>
                      <small class="form-hint">格式必须是：XXXX年X月<br>如：2015年8月、2015年12月</small>
                    </div>
                  </div>
                        </div>
                        <div class="col-md-3" style="display:none;">
     <div class="mb-3">
        <label class="col-10 col-form-label required">身份证号:</label>
        <div class="col">
            <input type="text" name="idcard" id="edit_idcard" class="form-control">
        </div>
    </div>
</div>
<div class="col-md-3" style="display:none;">
    <div class="mb-3">
        <label class="col-10 col-form-label required" for="edit_dizhi">地址:</label>
        <div class="col">
            <input type="text" name="dizhi" id="edit_dizhi" class="form-control" >
        </div>
    </div>
</div>
<div class="col-md-3" style="display:none;">
    <div class="mb-3">
        <label class="col-10 col-form-label required" for="edit_jihuaid">计划id:</label>
        <div class="col">
            <input type="text" name="jihuaid" id="edit_jihuaid" class="form-control" >
        </div>
    </div>
</div>
<div class="col-md-3" style="display:none;">
    <div class="mb-3">
        <label class="col-10 col-form-label required" for="edit_xueli">学历:</label>
        <div class="col">
            <input type="text" name="xueli" id="edit_xueli" class="form-control" >
        </div>
    </div>
</div>
<div class="col-md-3" style="display:none;">
    <div class="mb-3">
        <label class="col-10 col-form-label required" for="edit_peiyangren1">培养人1:</label>
        <div class="col">
            <input type="text" name="peiyangren1" id="edit_peiyangren1" class="form-control" >
        </div>
    </div>
</div>
<div class="col-md-3" style="display:none;">
    <div class="mb-3">
        <label class="col-10 col-form-label required" for="edit_peiyangren2">培养人2:</label>
        <div class="col">
            <input type="text" name="peiyangren2" id="edit_peiyangren2" class="form-control" >
        </div>
    </div>
</div>
<div class="col-md-3" style="display:none;">
    <div class="mb-3">
        <label class="col-10 col-form-label required" for="edit_shenqingrudangriqi">申请入党日期:</label>
        <div class="col">
            <input type="date" name="shenqingrudangriqi" id="edit_shenqingrudangriqi" class="form-control" >
        </div>
    </div>
</div>
<div class="col-md-3" style="display:none;">
    <div class="mb-3">
        <label class="col-10 col-form-label required" for="edit_jijifenzi">积极分子日期:</label>
        <div class="col">
            <input type="date" name="jijifenzi" id="edit_jijifenzi" class="form-control" >
        </div>
    </div>
</div>
<div class="col-md-3" style="display:none;">
    <div class="mb-3">
        <label class="col-10 col-form-label required" for="edit_fazhan">发展对象日期:</label>
        <div class="col">
            <input type="date" name="fazhan" id="edit_fazhan" class="form-control" >
        </div>
    </div>
</div>
<div class="col-md-3" style="display:none;">
    <div class="mb-3">
        <label class="col-10 col-form-label required" for="edit_yubei">预备党员日期:</label>
        <div class="col">
            <input type="date" name="yubei" id="edit_yubei" class="form-control" >
        </div>
    </div>
</div>
<div class="col-md-3" style="display:none;">
    <div class="mb-3">
        <label class="col-10 col-form-label required" for="edit_zhuanzheng">转正日期日期:</label>
        <div class="col">
            <input type="date" name="zhuanzheng" id="edit_zhuanzheng" class="form-control" >
        </div>
    </div>
</div>
<div class="col-md-3" style="display:none;">
    <div class="mb-3">
        <label class="col-10 col-form-label required" for="edit_zhuangtai">状态码:</label>
        <div class="col">
            <input type="text" name="zhuangtai" id="edit_zhuangtai" class="form-control" >
        </div>
    </div>
</div>
<div class="col-md-3" style="display:none;">
    <div class="mb-3">
        <label class="col-10 col-form-label required" for="edit_beizhu">备注:</label>
        <div class="col">
            <input type="text" name="beizhu" id="edit_beizhu" class="form-control" >
        </div>
    </div>
</div> 

        
    
          </div>


        </div>
        
        <div class="modal-footer">
            <button type="button" class="btn me-auto" data-bs-dismiss="modal">返回</button>
            <input type="submit" name="edit_student" value="保存修改" class="btn btn-primary"> 
                   
        </div>
        </div>
        </form> 
    </div>
    </div>

<!-- 修改学生结束 -->
    </div>
    </div>













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
    document.getElementById('edit_zhuangtai').value = zhuangtai;
    document.getElementById('edit_beizhu').value = beizhu;
}

</script>


<?php
    include '..\sub\footer.php'; // 包含页脚文件
    ?>
