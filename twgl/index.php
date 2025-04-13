<?php
    $pageTitle = "团支部管理"; // 设置页面标题
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
<?php
// Include database configuration file
include_once('../controller/.config');

// Create database connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to fetch class data 查询班级数据
function getClassData($conn) {
    $sql = "SELECT id, username FROM class WHERE password = '未毕业'";
    $result = $conn->query($sql);
    $classData = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $classData[] = $row;
        }
    }
    return $classData;
}

// Function to fetch tzb data
function getTZBData($conn) {
    $sql = "SELECT * FROM tzb";
    $result = $conn->query($sql);
    $tzbData = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $tzbData[$row['classid']] = $row;
        }
    }
    return $tzbData;
}

// Add new TZB
if(isset($_POST['add_tzb'])) {
    $classid = $_POST['classid'];
    $shujiname = $_POST['shujiname'];
    $shujidianhua = $_POST['shujidianhua'];

    // Insert into tzb table
    $insertSql = "INSERT INTO tzb (classid, classname, shujiname, shujidianhua) VALUES ('$classid', (SELECT username FROM class WHERE id = '$classid'), '$shujiname', '$shujidianhua')";
    if ($conn->query($insertSql) === TRUE) {
        // Insert into users table
        $password = $shujidianhua; // Set password as phone number
        $user_type = 5;
        $insertUserSql = "INSERT INTO users (username, password, user_type) VALUES ('$shujiname', '$password', '$user_type')";
        $conn->query($insertUserSql);
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $insertSql . "<br>" . $conn->error;
    }
}

// Delete TZB
if(isset($_GET['delete_tzb'])) {
    $classid = $_GET['delete_tzb'];
    $deleteSql = "DELETE FROM tzb WHERE classid='$classid'";
    if ($conn->query($deleteSql) === TRUE) {
        // Delete from users table
        $deleteUserSql = "DELETE FROM users WHERE username='$shujiname'";
        $conn->query($deleteUserSql);
        header("Location: index.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Update TZB
if(isset($_POST['update_tzb'])) {
    $classid = $_POST['classid'];
    $shujiname = $_POST['shujiname'];
    $shujidianhua = $_POST['shujidianhua'];

    $updateSql = "UPDATE tzb SET shujiname='$shujiname', shujidianhua='$shujidianhua' WHERE classid='$classid'";
    if ($conn->query($updateSql) === TRUE) {
        // Update users table
        $updateUserSql = "UPDATE users SET password='$shujidianhua' WHERE username='$shujiname'";
        $conn->query($updateUserSql);
        header("Location: index.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Fetch data
$classData = getClassData($conn);
$tzbData = getTZBData($conn);
?>

<?php
    $pageTitle = "团支部管理"; // 设置页面标题
    // 其他页面逻辑和内容
    include '..\sub\head.php'; // 包含页眉文件
?>
    <script src="../tabler/dist/js/demo-theme.min.js?1684106062"></script>
    <div class="page">
        <!-- Navbar -->
        <?php
    include '..\sub\bodyhead.php'; 
    include './menu.php'; 
    ?>









<div class="page-wrapper">
        <!-- Page body -->
        <div class="page-body">
          <div class="container-xl">
            <div class="row row-cards">
              <div class="col-lg-8">
                <div class="card card-lg table-responsive">
                <div style="height: 490px; overflow: auto;">
                <table class="table table-vcenter card-table" id="dataTable">
                <thead style="position: sticky; top: 0;">
        <tr>
            <!-- <th>Class ID</th> -->
            <th>班级（团支部）</th>
            <th>团支书姓名</th>
            <th>团支书电话</th>
            <th>操作</th>
        </tr>
    </thead>
        <?php foreach($classData as $class): ?>
            <tr>
                <!-- <td><?php echo $class['id']; ?></td> -->
                <td><?php echo $class['username']; ?></td>
                <?php if(isset($tzbData[$class['id']])): ?>
                    <td><?php echo $tzbData[$class['id']]['shujiname']; ?></td>
                    <td><?php echo $tzbData[$class['id']]['shujidianhua']; ?></td>
                    <td>
                        <button class="btn btn-warning" onclick="editTzb('<?php echo $class['id']; ?>', '<?php echo $tzbData[$class['id']]['shujiname']; ?>', '<?php echo $tzbData[$class['id']]['shujidianhua']; ?>')">修改信息</button>
                        <a class="btn btn-danger" href="?delete_tzb=<?php echo $class['id']; ?>" onclick="return confirm('Are you sure you want to delete this TZB?')">删除信息</a>
                    </td>
                <?php else: ?>
                    <td colspan="2">暂未设置团支书，点击添加按钮添加。</td>
                    <td><button class="btn btn-primary" onclick="addTzb('<?php echo $class['id']; ?>')">添加信息</button></td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </table>
    </div>

                </div>
              </div>
              <div class="col-lg-4 card">




                <div class="card-header">
                  <h3 class="card-title">操作面板</h3>
                </div>
                <div class="card-body">



                <div class="mb-3">
                <div class="input-group mb-2">
                <select id="columnSelect" class="form-select">
                    <!-- 表头选项将由JavaScript生成 -->
                </select>
                <input type="text" id="filterInput" placeholder="输入要筛选的内容" class="form-control">
                <button onclick="filterTable()" class="btn btn-primary">筛选</button>
                            </div>
                  </div>





                
                


    <!-- Add TZB Modal -->
    <div id="addModal" style="display:none;">
        <form method="post">
        <div class="row align-items-center">
                    <div class="col">            
                        <input type="hidden" name="classid" id="classid" class="form-control">
                        <div class="input-group mb-2">
                        <label for="shujiname" class="input-group-text">姓名</label>
                        <input type="text" name="shujiname" id="shujiname" class="form-control"> 
                        </div>
                        <div class="input-group mb-2">
                        <label for="shujidianhua" class="input-group-text">电话</label>
                        <input type="text" name="shujidianhua" id="shujidianhua" class="form-control">
                        </div>
                    </div>
                    <div class="col-auto">
                    <input type="submit" name="add_tzb" value="添加信息" class="btn btn-primary">
                    </div>
                  </div>
        </form>
    </div>

    <!-- Edit TZB Modal -->
    <div id="editModal" style="display:none;">
    <form method="post">
        <div class="row align-items-center">
                    <div class="col">            
                        <input type="hidden" name="classid" id="edit_classid">
                        <div class="input-group mb-2">
                        <label for="shujiname" class="input-group-text">姓名</label>
                        <input type="text" name="shujiname" id="edit_shujiname" class="form-control"> 
                        </div>
                        <div class="input-group mb-2">
                        <label for="shujidianhua" class="input-group-text">电话</label>
                        <input type="text" name="shujidianhua" id="edit_shujidianhua" class="form-control">
                        </div>
                    </div>
                    <div class="col-auto">
                    <input type="submit" name="update_tzb" value="更新信息" class="btn btn-primary">
                    </div>
                  </div>
        </form>
    </div>
                </div>


            </div>
          </div>
        </div>
      </div>

    </div>



    <script>
        function addTzb(classid) {
            document.getElementById('classid').value = classid;
            document.getElementById('addModal').style.display = 'block';
        }

        function editTzb(classid, shujiname, shujidianhua) {
            document.getElementById('edit_classid').value = classid;
            document.getElementById('edit_shujiname').value = shujiname;
            document.getElementById('edit_shujidianhua').value = shujidianhua;
            document.getElementById('editModal').style.display = 'block';
        }
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
    include '..\sub\footer.php'; // 包含页脚文件
    ?>
<?php
// Close database connection
$conn->close();
?>
