<?php
    $pageTitle = "智育综测管理"; // 设置页面标题
    $qxyq = "3"; // 设置权限
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
            <div class="input-group mb-2">
                <select id="columnSelect" class="form-select">
                    <!-- 表头选项将由JavaScript生成 -->
                </select>
                <input type="text" id="filterInput" placeholder="输入要筛选的内容" class="form-control">
                <button onclick="filterTable()" class="btn btn-primary">筛选</button>
                            </div>
              <div class="col-lg-12">
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
            $student_sql = "SELECT id FROM tystu";
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
                    echo "<table border='1' class='table table-vcenter card-table center' id='dataTable'>
                            <tr>
                            <!-- <th>ID</th>-->
                                <th>学生姓名</th>
                                <th>挂科科目数量</th>
                                <th>处分</th>
                                <th>智育班级排名</th>
                                <th>班级排名</th>
                                <th>备注</th>
                                <th>操作</th>
                                <th>智育综测百分比查询</th>
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
                                <td><input type='text' name='zhiyu' value='".$row["zhiyu"]."' style='width: 50px;'></td>
                                <td><input type='text' name='zongce' value='".$row["zongce"]."' style='width: 50px;'></td>
                                <td><input type='text' name='info' value='".$row["info"]."' style='width: 50px;'></td>
                                <td>
                                <input class='btn btn-primary' type='submit' name='edit' value='提交'>
                                <input class='btn btn-red' type='submit' name='delete' value='删除'>
                                <td>";
                                //解析并换算百分比
                            $stuid = $row["stuid"];

                            // 查询 tystu 表中与 stuid 字段在同一行的 classid 字段的值
                            $tystu_query = "SELECT classid FROM tystu WHERE id = $stuid";
                            $tystu_result = mysqli_query($conn, $tystu_query);
                            
                            if ($tystu_result) {
                                // 从查询结果中获取 classid 字段的值
                                $tystu_row = mysqli_fetch_assoc($tystu_result);
                                $classid = $tystu_row['classid'];
                            
                                // 查询 class 表与 classid 字段与 id 字段在一行的 user_type 值
                                $class_query = "SELECT user_type FROM class WHERE id = $classid";
                                $class_result = mysqli_query($conn, $class_query);
                            
                                if ($class_result) {
                                    // 从查询结果中获取 user_type 值
                                    $class_row = mysqli_fetch_assoc($class_result);
                                    $bjrs = $class_row['user_type'];
                            
                                    // 现在 $bjrs 变量包含了您想要的 user_type 值
                                } else {
                                    // 查询失败时的处理
                                    echo "Class 查询失败: " . mysqli_error($conn);
                                }
                            } else {
                                // 查询失败时的处理
                                echo "Tystu 查询失败: " . mysqli_error($conn);
                            }
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
                            //echo "<td>" . implode('/', $zhiyulu) . "</td><td>" . implode('/', $zongcelu) . "</td>";
                                            //<td>" . $row['info'] . "</td>
                                            echo "<table border='1' class='table table-vcenter card-table center'>";
                                            echo "<tr>";
                                            echo "<th>数据名</th>";
                                            
                                            // 自动统计表头数量
                                            $headerCount = count($zhiyulu);
                                            for ($i = 1; $i <= $headerCount; $i++) {
                                                echo "<th>第 $i 学期</th>";
                                            }
                                            echo "</tr>";
                                            
                                            // 遍历数组并显示值
                                            $dataNames = ['智育率', '综测率']; // 在这里更改显示的自定义名称
                                            foreach ($dataNames as $index => $dataName) {
                                                echo "<tr><td>$dataName</td>";
                                                $data = ($index == 0) ? $zhiyulu : $zongcelu;
                                                foreach ($data as $value) {
                                                    echo "<td>$value</td>";
                                                }
                                                echo "</tr>";
                                            }
                                            
                                            echo "</table>";
                            
                                            
                                                        //换算结束
                                echo "</td>
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
              
              <div class="col-lg-2" style="display:none;">
              <div class="mb-3">

                  </div>
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
        $sql_students = "SELECT id, name FROM tystu";
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

    <script>
      function populateColumnSelect() {
            var table = document.getElementById('dataTable');
            var headerRow = table.getElementsByTagName('tr')[0];
            var columnSelect = document.getElementById('columnSelect');

            for (var i = 0; i < headerRow.cells.length; i++) {
                var cellText = headerRow.cells[i].textContent || headerRow.cells[i].innerText;
                var option = document.createElement('option');
                option.text = cellText;
                option.value = i;
                columnSelect.appendChild(option);
            }
        }

        function filterTable() {
            var columnIndex = document.getElementById('columnSelect').value;
            var filterValue = document.getElementById('filterInput').value.toUpperCase();
            var table = document.getElementById('dataTable');
            var rows = table.getElementsByTagName('tr');

            for (var i = 1; i < rows.length; i++) {
                var cell = rows[i].getElementsByTagName('td')[columnIndex];

                if (cell) {
                    var cellValue = cell.textContent || cell.innerText;
                    if (cellValue.toUpperCase().indexOf(filterValue) > -1) {
                        rows[i].style.display = '';
                    } else {
                        rows[i].style.display = 'none';
                    }
                }
            }
        }

        // 页面加载完毕后自动生成下拉框选项
        window.onload = function() {
            populateColumnSelect();
        };
    </script>



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