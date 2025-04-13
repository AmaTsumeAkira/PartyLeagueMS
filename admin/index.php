<?php
    $pageTitle = "用户管理"; // 设置页面标题
    $qxyq = "1"; // 设置权限
    // 1=超级管理员
    // 2=党务、团务、学生会管理员
    // 3=团务、学生会管理员
    // 4=学生会管理员
    // 5=各级团支书
    // 其他页面逻辑和内容
    include '..\sub\qxpd.php'; // 包含页眉文件
?>
<?php
// admin\index.php

// 导入配置文件
require_once('..\controller\.config');

// 连接数据库
$conn = new mysqli($host, $username, $password, $database);

// 检查连接是否成功
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 添加用户
if (isset($_POST['add_user'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user_type = $_POST['user_type'];

    $stmt = $conn->prepare("INSERT INTO users (username, password, user_type) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $password, $user_type);
    if ($stmt->execute()) {
        echo "用户添加成功。";
    } else {
        echo "添加用户时出错：" . $conn->error;
    }
}

// 删除用户
if (isset($_GET['delete_user'])) {
    $user_id = $_GET['delete_user'];

    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    if ($stmt->execute()) {
        echo "用户删除成功。";
    } else {
        echo "删除用户时出错：" . $conn->error;
    }
}

// 修改用户
if (isset($_POST['update_user'])) {
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user_type = $_POST['user_type'];

    $stmt = $conn->prepare("UPDATE users SET username = ?, password = ?, user_type = ? WHERE id = ?");
    $stmt->bind_param("sssi", $username, $password, $user_type, $user_id);
    if ($stmt->execute()) {
        echo "用户更新成功。";
    } else {
        echo "更新用户时出错：" . $conn->error;
    }
}

// 查找用户
if (isset($_POST['search_user'])) {
    $search_username = $_POST['search_username'];

    $stmt = $conn->prepare("SELECT id, username, user_type FROM users WHERE username LIKE ?");
    $search_username = "%" . $search_username . "%";
    $stmt->bind_param("s", $search_username);
    $stmt->execute();
    $stmt->bind_result($id, $username, $user_type);

    echo "<h2>Search Results:</h2>";
    echo "<ul>";
    while ($stmt->fetch()) {
        echo "<li>User ID: $id, Username: $username, User Type: $user_type</li>";
    }
    echo "</ul>";
}

// 获取所有用户列表
$stmt = $conn->prepare("SELECT id, username, user_type FROM users");
$stmt->execute();
$stmt->bind_result($id, $username, $user_type);
?>

<?php
    $pageTitle = "用户管理"; // 设置页面标题
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
            <!-- Page header -->
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <h2 class="page-title">
                                管理员同志！欢迎您！
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="page-wrapper">
                    <div class="page-body">
                        <div class="container-xl">
                            <div class="row row-deck row-cards">
                                <div class="col-4">


                                    <form class="card" method="post" action="">
                                        <div class="card-header">
                                            <h4 class="card-title">添加用户</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3 row">
                                                <label class="col-3 col-form-label required">用户名</label>
                                                <div class="col">
                                                    <input type="text" name="username" class="form-control">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-3 col-form-label required">密码</label>
                                                <div class="col">
                                                    <input type="password" name="password" class="form-control">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-3 col-form-label required">用户类型</label>
                                                <div class="col">
                                                    <input type="text" name="user_type" class="form-control">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-end">
                                            <button type="submit" class="btn btn-primary" name="add_user"
                                                value="Add User">添加用户</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-4">
                                    <form class="card" method="post" action="">
                                        <div class="card-header">
                                            <h4 class="card-title">修改用户</h4>
                                        </div>
                                        <div class="card-body">
                                        <div class="mb-3 row">
                                                <label class="col-3 col-form-label required">用户ID</label>
                                                <div class="col">
                                                    <input type="text" name="user_id" class="form-control">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-3 col-form-label required">用户名</label>
                                                <div class="col">
                                                    <input type="text" name="username" class="form-control">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-3 col-form-label required">密码</label>
                                                <div class="col">
                                                    <input type="password" name="password" class="form-control">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-3 col-form-label required">用户类型</label>
                                                <div class="col">
                                                    <input type="text" name="user_type" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-end">
                                            <button type="submit" class="btn btn-primary" name="update_user" value="Update User">修改用户</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-4">
                                <div class="card">
                  <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs nav-fill" data-bs-toggle="tabs" role="tablist">
                      <li class="nav-item" role="presentation">
                        <a href="#tabs-home-5" class="nav-link active" data-bs-toggle="tab" aria-selected="true" role="tab">用户类型说明</a>
                      </li>
                      <li class="nav-item" role="presentation">
                        <a href="#tabs-profile-5" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">配置说明</a>
                      </li>
                      <li class="nav-item" role="presentation">
                        <a href="#tabs-activity-5" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">其他</a>
                      </li>
                    </ul>
                  </div>
                  <div class="card-body">
                    <div class="tab-content">
                      <div class="tab-pane active show" id="tabs-home-5" role="tabpanel">
                        <h4>用户类型说明</h4>
                        <div>1=超级管理员<br>2=党务、团务、学生会管理员<br>3=团务、学生会管理员<br>4=学生会管理员<br>5=各级团支书</div>
                      </div>
                      <div class="tab-pane" id="tabs-profile-5" role="tabpanel">
                        <h4>配置说明</h4>
                        <div>0000</div>
                      </div>
                      <div class="tab-pane" id="tabs-activity-5" role="tabpanel">
                        <h4>其他</h4>
                        <div>000</div>
                      </div>
                    </div>
                  </div>
                </div>
                                </div>




                                <div class="col-12">
                                    <div class="card">

                                    <div class="card-header">
                    <h3 class="card-title" _msttexthash="20093437" _msthash="306">用户列表</h3>
                  </div>
                                        <div class="table-responsive">
                                            <table class="table table-vcenter">
                                                <thead>
                                                    <tr>
                                                        <th>用户ID</th>
                                                        <th>用户名</th>
                                                        <th>用户类型</th>
                                                        <th>删除操作</th>
                                                        <th class="w-1"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php while ($stmt->fetch()) { ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo $id; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $username; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $user_type; ?>
                                                            </td>
                                                            <td><a href="?delete_user=<?php echo $id; ?>"
                                                                    class="btn btn-danger">Delete</a></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
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



        <?php
    include '..\sub\footer.php'; // 包含页脚文件
    ?>


<?php
// 关闭数据库连接
$stmt->close();
$conn->close();
?>