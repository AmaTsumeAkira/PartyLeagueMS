<?php
    $pageTitle = "智育综测管理"; // 设置页面标题
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
        <?php
    include '..\sub\bodyhead.php'; 
    include './menu.php'; 
    ?>
        <div class="page-wrapper">
        <!-- Page body -->
        <div class="page-body">
          <div class="container-xl">
            <div class="row row-cards">
              <div class="col-lg-9">
                <div class="card card-lg table-responsive">
                <?php
// 导入配置文件
require_once('..\controller\.config');

// 连接数据库
$conn = new mysqli($host, $username, $password, $database);

// 检查连接是否成功
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



    // 处理表单提交
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // 添加数据
        if (isset($_POST['add'])) {
            $stuid = $_POST['stuid'];
            $guake = $_POST['guake'];
            $chufen = $_POST['chufen'];
            $zhiyu = $_POST['zhiyu'];
            $zongce = $_POST['zongce'];
            $info = $_POST['info'];

            $sql = "INSERT INTO tychengji (stuid, guake, chufen, zhiyu, zongce, info) VALUES ('$stuid', '$guake', '$chufen', '$zhiyu', '$zongce', '$info')";

            if ($conn->query($sql) === TRUE) {
                echo "新记录插入成功";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        // 修改数据
        if (isset($_POST['edit'])) {
            $id = $_POST['id'];
            $stuid = $_POST['stuid'];
            $guake = $_POST['guake'];
            $chufen = $_POST['chufen'];
            $zhiyu = $_POST['zhiyu'];
            $zongce = $_POST['zongce'];
            $info = $_POST['info'];

            $sql = "UPDATE tychengji SET stuid='$stuid', guake='$guake', chufen='$chufen', zhiyu='$zhiyu', zongce='$zongce', info='$info' WHERE id='$id'";

            if ($conn->query($sql) === TRUE) {
                echo "记录修改成功";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        // 删除数据
        if (isset($_POST['delete'])) {
            $id = $_POST['id'];

            $sql = "DELETE FROM tychengji WHERE id='$id'";

            if ($conn->query($sql) === TRUE) {
                echo "记录删除成功";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }


    
    // 假设您的会话中包含用户名信息
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
    
        // 查询用户所在班级的 classid
        $class_sql = "SELECT classid FROM tzb WHERE shujiname = '$username'";
        $class_result = $conn->query($class_sql);
    
        if ($class_result->num_rows > 0) {
            $class_row = $class_result->fetch_assoc();
            $classid = $class_row['classid'];
    
            // 查询 tystu 表中所有与用户班级一致的学生的 id
            $student_ids = array();
            $student_sql = "SELECT id FROM tystu WHERE classid = '$classid'";
            $student_result = $conn->query($student_sql);
    
            if ($student_result->num_rows > 0) {
                while ($student_row = $student_result->fetch_assoc()) {
                    $student_ids[] = $student_row['id'];
                }
    
                // 查询 tychengji 表中符合条件的学生成绩并进行显示
                $student_ids_string = implode(',', $student_ids);
                $grade_sql = "SELECT tychengji.*, tystu.name FROM tychengji JOIN tystu ON tychengji.stuid = tystu.id WHERE tychengji.stuid IN ($student_ids_string)";
                $grade_result = $conn->query($grade_sql);
    
                if ($grade_result->num_rows > 0) {
                    echo "<table border='1' class='table table-vcenter card-table center'>
                            <tr>
                            <!-- <th>ID</th>-->
                                <th>学生姓名</th>
                                <th>挂科科目数量</th>
                                <th>处分</th>
                                <th>智育班级排名</th>
                                <th>综测班级排名</th>
                                <th>备注</th>
                                <th>操作</th>
                            </tr>";
    
                    // 输出数据
                    while ($row = $grade_result->fetch_assoc()) {
                        echo "<tr>
                        <form method='post' action='".$_SERVER["PHP_SELF"]."'> 
                                <!-- <td>".$row["id"]."</td> -->
                                <input type='hidden' name='id' value='".$row["id"]."'' >
                                <input type='hidden' name='stuid' value='".$row["stuid"]."' >
                                <td>".$row["name"]."</td>
                                <td><input type='text' name='guake' value='".$row["guake"]."' style='width: 50px;'></td>
                                <td><input type='text' name='chufen' value='".$row["chufen"]."' style='width: 50px;'></td>
                                <td><input type='text' name='zhiyu' value='".$row["zhiyu"]."' style='width: 100px;'></td>
                                <td><input type='text' name='zongce' value='".$row["zongce"]."' style='width: 100px;'></td>
                                <td><input type='text' name='info' value='".$row["info"]."' style='width: 50px;'></td>
                                <td>
                                <input class='btn btn-primary' type='submit' name='edit' value='提交'>
                                <!--  <input type='submit' name='delete' value='删除'> -->
                                </form>
                                </td>
                            </tr>";
                    }
                    
                    echo "</table>";
                } else {
                    echo "没有符合条件的结果";
                }
            } else {
                echo "没有找到符合条件的学生";
            }
        } else {
            echo "没有找到用户所在班级的信息";
        }
    } else {
        echo "用户未登录";
    }
    ?>

                </div>
              </div>
              <div class="col-lg-3">
              <form method="post" class="card" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="card-header">
                  <h3 class="card-title">录入智育综测</h3>
                </div>
                <div class="card-body">
    <!-- <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> -->

        <div class="mb-3">
                    <label class="col-5 col-form-label required">姓名</label>
                    <div class="col">
                    <select name="stuid" class="form-select">
        <?php

session_start(); // 开启会话
// 假设您已经建立了数据库连接$conn

// 获取用户登录名
if(isset($_SESSION['username'])) {
    $user_username = $_SESSION['username'];

    // 查询用户对应的classid
    $sql_classid = "SELECT classid FROM tzb WHERE shujiname = '$user_username'";
    $result_classid = $conn->query($sql_classid);
    if($result_classid->num_rows > 0) {
        $row_classid = $result_classid->fetch_assoc();
        $classid = $row_classid['classid'];

        // 查询符合条件的学生信息
        $sql_students = "SELECT id, name FROM tystu WHERE classid = '$classid'";
        $result_students = $conn->query($sql_students);

        // 输出学生选项
        if ($result_students->num_rows > 0) {
            while($row_student = $result_students->fetch_assoc()) {
                echo "<option value='" . $row_student['id'] . "'>" . $row_student['name'] . "</option>";
            }
        } else {
            echo "<option value=''>没有学生</option>";
        }
    } else {
        echo "<option value=''>没有学生</option>";
    }
} else {
    echo "<option value=''>用户未登录</option>";
}
?>

        </select>
                    </div>
                  </div>
        <div class="mb-3">
                    <label class="col-5 col-form-label required">挂科科目数量</label>
                    <div class="col">
                      <input type="text" name="guake" class="form-control" placeholder="输入挂科数量" required>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label class="col-5 col-form-label required">处分</label>
                    <div class="col">
                      <input type="text" name="chufen" class="form-control" placeholder="输入处分详情" required>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label class="col-5 col-form-label required">智育排名</label>
                    <div class="col">
                      <input type="text" name="zhiyu" class="form-control" placeholder="用/分隔学期排名：1/2/3" required>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label class="col-5 col-form-label required">综测排名</label>
                    <div class="col">
                      <input type="text" name="zongce" class="form-control" placeholder="用/分隔学期排名：1/2/3" required>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label class="col-5 col-form-label">备注</label>
                    <div class="col">
                      <input type="text" name="info" class="form-control" placeholder="其他智育综测情况">
                    </div>
                  </div>
                </div>  
                <div class="card-footer text-end">
                <input type="submit" name="add" value="录入记录" class="btn btn-primary">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

<?php
$conn->close();
    include '..\sub\footer.php'; // 包含页脚文件
    ?>



<!-- <tr>
                                <td>".$row["id"]."</td>
                                <td>".$row["name"]."</td>
                                <td>".$row["guake"]."</td>
                                <td>".$row["chufen"]."</td>
                                <td>".$row["zhiyu"]."</td>
                                <td>".$row["zongce"]."</td>
                                <td>".$row["info"]."</td>
                                <td>
                                <form method='post' action='".$_SERVER["PHP_SELF"]."'>
                                <input type='hidden' name='id' value='".$row["id"]."'>
                                <input type='hidden' name='stuid' value='".$row["stuid"]."'>
                                <input type='text' name='guake' value='".$row["guake"]."'><br>
                                <input type='text' name='chufen' value='".$row["chufen"]."'><br>
                                <input type='text' name='zhiyu' value='".$row["zhiyu"]."'><br>
                                <input type='text' name='zongce' value='".$row["zongce"]."'><br>
                                <input type='text' name='info' value='".$row["info"]."'><br>
                                <input type='submit' name='edit' value='编辑'>
                                <input type='submit' name='delete' value='删除'>
                                </form>
                                </td>
                            </tr>"; -->